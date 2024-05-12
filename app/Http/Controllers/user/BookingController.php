<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Trip;

class BookingController extends Controller
{

    public function index() {
        $bookings = Auth::user()->bookings()->orderBy('id', 'desc')->get();
        return view('pages.user.booking.index', compact('bookings'));
    }

    public function create(Trip $trip) {
        return view('pages.user.booking.create', compact('trip'));
    }

    public function store(Request $request, Trip $trip) {
        // Retrieve the form data
        $formFields = $request->validate([
            'adults_number' => ['required', 'numeric', 'min:1'],
            'children_number' => ['required', 'numeric', 'min:0'],
            'emergency_contact' => ['required', 'string', 'max:25'],
        ]);

        // Check if the user had already booked this trip
        // foreach (Auth::user()->bookings as $booking) {
        //     if ($booking->trip == $trip) {
        //         // dd('You have already booked this trip, do you want to edit it?');
        //         return back()->withErrors([
        //             'error' => 'You have already booked this trip, do you want to edit it?',
        //         ]);
        //     }
        // }

        // Prepare the object booking
        $formFields['total_amount'] = $trip->price * $formFields['adults_number'] + $trip->price*50/100 * $formFields['children_number'];
        $formFields['booking_code'] = uniqid();
        $formFields['user_id'] = Auth::user()->id;
        $formFields['trip_id'] = $trip->id;

        Booking::create($formFields);

        return to_route('trips.index');
    }
}
