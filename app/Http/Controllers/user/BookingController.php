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


class BookingController extends Controller
{

    public function index() {
        $bookings = Auth::user()->bookings()->orderBy('id', 'desc')->get();
        return view('pages.user.booking.index', compact('bookings'));
    }

    public function create($trip_id) {
        // Check if the trip is exist
        if (!Trip::where('id', $trip_id)->exists())
            return abort('404');

        return view('pages.user.booking.create', compact('trip_id'));
    }

    
    public function store(Request $request, $trip_id) {

        // Retrive the price of the trip if exist
        $trip = Trip::findOrFail($trip_id, ['price']);

        // Retrieve the form data (Validate form data)
        $formFields = $request->validate([
            'adults_number' => ['required', 'numeric', 'min:1'],
            'children_number' => ['required', 'numeric', 'min:0'],
            'emergency_contact' => ['required', 'string', 'max:25'],
        ]);
        
        // Create a new booking
        $booking = new Booking();
        $booking->adults_number = $formFields['adults_number'];
        $booking->children_number = $formFields['children_number'];
        $booking->emergency_contact = $formFields['emergency_contact'];
        $booking->total_amount = $booking->calculateTotalAmount($trip->price); // $booking->trip->price
        $booking->trip_id = $trip_id;
        $booking->user_id = Auth::user()->id;
        
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

        // Set the payment_token and save the booking object inthe database
        $booking->payment_token = $session->id;
        $booking->save();

        return redirect()->away($session->url);
    }

    public function checkoutSuccess(Request $request)
    {
        // Check if there is a session id in the url
        if (!isset($request->session_id)) {
            return abort('404');
        }

        // Retrive the booking object if exist
        $booking = Booking::where('payment_token', $request->session_id)->firstOrFail();

        // Check if the booking code equal the session id from the url
        if (!($booking->payment_token === $request->session_id && $booking->payment_status == 'unpaid'))
            return abort('404');

        // Handle successful payment, update payment status to "paid".
        // Todo : send confirmation email
        $booking->update(['payment_status' => 'paid']);
        return view('pages.user.booking.success');
    }

    public function checkoutCancel(Request $request)
    {
        return 'faild';
        $bookingId = $request->query('booking_id');
        $booking = Booking::findOrFail($bookingId);

        // Inform the user about the canceled payment and provide an option to retry the payment
        return redirect()->route('bookings.retry', ['booking_id' => $bookingId])->with('status', 'Payment was canceled. Please retry the payment.');
        
        // Handle canceled payment, redirect back to booking form with a message
        return to_route('bookings.create')->with('status', 'Payment was canceled.');
    }


    public function retryPayment(Request $request, $booking_id)
    {
        $booking = Booking::findOrFail($booking_id);

        // return 404 if the booking is paid
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

        $booking->payment_token = $session->id;
        $booking->update();

        return redirect()->away($session->url);
    }
}