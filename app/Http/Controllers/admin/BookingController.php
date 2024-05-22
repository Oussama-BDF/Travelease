<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Trip;
use App\Models\BaseModel;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Display a listing of the bookings based on the status.
     */
    public function index() {
        // Get the current route name
        $currentRouteName = Route::currentRouteName();
        // Get the status value
        $status = Str::afterLast($currentRouteName, '.');
        // Retrieve the data base on the status
        $bookings = Booking::where('status', $status)->orderBy('id', 'desc')->get();
        return view('pages.admin.booking.index', compact('bookings', 'status'));
    }

    /**
     * Update the status of a specified booking in storage.
     */
    public function update(Request $request, $booking_uuid) {
        $formFields = $request->validate([
            'status' => 'required',
        ]);

        $booking = Booking::where('uuid', $booking_uuid)->firstOrFail();

        // Check if the booking status has the allowed values
        $allowed_values = ['pending', 'confirmed', 'canceled'];
        if (!in_array($formFields['status'], $allowed_values)) {
            return back();
        }

        // Change the number of travelers in the trip based on the status
        if ($formFields['status'] == "canceled") {
            $trip = Trip::find($booking->trip->id);
            $trip->current_travelers -= ($booking->adults_number + $booking->children_number);
            $trip->save();
        } elseif ($booking->status == "canceled") {
            // ! check the available places
            $trip = Trip::find($booking->trip->id);
            $trip->current_travelers += ($booking->adults_number + $booking->children_number);
            $trip->save();
        }

        $booking->fill($formFields)->save();

        return back();
    }

    public function verify(Request $request) {
        $booking = Booking::where('uuid', $request->input('token'))->first();
        if ($booking) {
            return view('pages.admin.booking.valide');
        } else {
            return view('pages.admin.booking.notValide');
        }
    }
}
