<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Trip;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;

class BookingController extends Controller
{
    /**
     * Display a listing of the user bookings.
     */
    public function index() {
        $bookings = Auth::user()
            ->bookings()
            ->with('trip')
            ->orderBy('id', 'desc')
            ->get();
        return view('pages.user.booking.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new booking.
     */
    public function create($trip_uuid) {
        // Check if the trip is exist
        $trip = Trip::where('uuid', $trip_uuid)->firstOrFail();

        // And check if the trip is available
        if(!$trip->status['availability']) {
            return abort('404');
        }

        return view('pages.user.booking.create', compact('trip'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request, $trip_uuid) {
        // Retrive the trip if exist
        $trip = Trip::where('uuid', $trip_uuid)->firstOrFail();

        // Validate the form data
        $formFields = $request->validate([
            'adults_number' => ['required', 'numeric', 'min:1'],
            'children_number' => ['required', 'numeric', 'min:0'],
            'emergency_contact' => ['required', 'string', 'max:25','regex:/^(\+212|0)([ \-]?[0-9]){9}$/'],
        ]);

        // Validate the number of travelers (check for places availability)
        $new_travelers = $formFields['adults_number'] + $formFields['children_number'];
        $total_travelers = $trip->current_travelers + $new_travelers;
        if ($total_travelers > $trip->max_travelers) {
            return back()->withErrors(['adults_number' => 'The total number of travelers exceeds the maximum allowed for this trip!']);
        }
        
        // Create a new booking
        $booking = new Booking();
        $booking->adults_number = $formFields['adults_number'];
        $booking->children_number = $formFields['children_number'];
        $booking->emergency_contact = $formFields['emergency_contact'];
        $booking->total_amount = $booking->calculateTotalAmount($trip->price); // $booking->trip->price
        $booking->trip_id = $trip->id;
        $booking->user_id = Auth::user()->id;
        
        // Increment the number of travelers in the trip
        $trip->current_travelers += ($booking->adults_number + $booking->children_number);
        $trip->save();
        
        // Create a new Stripe Checkout session
        Stripe::setApiKey(config('stripe.test.sk'));

        $session = Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'mad',
                        'product_data' => [
                            'name' => 'Trip',
                        ],
                        'unit_amount'  => $booking->total_amount*100,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('bookings.checkout.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('bookings.checkout.cancel'),
        ]);

        // Set the payment_token (which equal the session id) and save the booking object in the database
        $booking->payment_token = $session->id;
        $booking->save();

        return redirect()->away($session->url);
    }

    /**
     * Show the view of booking success
     */
    public function checkoutSuccess(Request $request)
    {
        // Check if there is a session id in the url
        if (!isset($request->session_id)) {
            return abort('404');
        }

        // Retrive the booking object if exist
        $booking = Booking::where('payment_token', $request->session_id)->firstOrFail();

        // Check if the payment status is paid
        if ($booking->payment_status == 'paid')
            return abort('404');

        // Handle successful payment: update payment status to "paid" and generate QrCode.
        // Generate the QR code data
        $qrData = route('admin.bookings.verify', ['token' => $booking->uuid]);
        $qrCode = base64_encode(QrCode::format('png')->size(100)->generate($qrData));

        // Todo : send confirmation email
        $booking->update(['payment_status' => 'paid']);
        return view('pages.user.booking.success', compact('qrCode', 'booking'));
    }

    /**
     * Show the view of booking canceled
     */
    public function checkoutCancel(Request $request)
    {
        return view('pages.user.booking.cancel');
    }

    /**
     * retry the payment
     */
    public function retryPayment(Request $request, $booking_uuid)
    {
        $booking = Booking::where('uuid', $booking_uuid)->firstOrFail();

        // Check if the booking is paid
        if($booking->payment_status == "paid") {
            return abort('404');
        }

        // Create a new Stripe Checkout session
        Stripe::setApiKey(config('stripe.test.sk'));

        $session = Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'mad',
                        'product_data' => [
                            'name' => 'Trip',
                        ],
                        'unit_amount'  => $booking->total_amount*100,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('bookings.checkout.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('bookings.checkout.cancel'),
        ]);

        // Change the payment_token by the new session id and update the booking
        $booking->payment_token = $session->id;
        $booking->update();

        return redirect()->away($session->url);
    }

    /**
     * Get the ticket of the booking
     */
    public function getTicket($booking_uuid)
    {
        $booking = Booking::where('uuid', $booking_uuid)->firstOrFail();

        // Check the user and the payment status
        if(!($booking->user_id == Auth::user()->id) || $booking->payment_status == "unpaid") {
            return abort('404');
        }

        // Generate the QrCode
        $qrData = route('admin.bookings.verify', ['token' => $booking_uuid]);
        $qrCode = base64_encode(QrCode::format('png')->size(100)->generate($qrData));
        
        // Pass data to the view
        $data = [
            'qrCode' => $qrCode,
            'booking' => $booking,
        ];

        // Load the view and convert it to PDF
        $pdf = PDF::loadView('pages.user.ticket', $data);

        // Download the PDF
        return $pdf->download('ticket.pdf');
    }
}