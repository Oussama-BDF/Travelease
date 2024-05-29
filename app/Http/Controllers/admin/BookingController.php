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
        // Retrieve the data base on the status, Use "with" to avoid the duplication of queries
        $bookings = Booking::where('status', $status)
            ->with('user', 'trip')
            ->orderBy('id', 'desc')
            ->get();
        return view('pages.admin.booking.index', compact('bookings', 'status'));
    }

    /**
     * Update the status of a specified booking in storage.
     */
    public function update(Request $request, $booking_uuid) {
        $booking = Booking::where('uuid', $booking_uuid)->firstOrFail();

        $formFields = $request->validate([
            'status' => 'required',
        ]);

        // Check if the booking status has the allowed values
        $allowed_values = ['pending', 'confirmed', 'canceled'];
        if (!in_array($formFields['status'], $allowed_values)) {
            return back()->with('failed', 'Cannot Update This Booking, Try Again');
        }

        // Change the number of travelers in the trip based on the status
        $total_travelers= $booking->adults_number + $booking->children_number;
        if ($formFields['status'] == "canceled") {
            $trip = Trip::find($booking->trip->id);
            $trip->current_travelers -= $total_travelers;
            $trip->save();
        } elseif ($booking->status == "canceled") {
            $trip = Trip::find($booking->trip->id);
            if (($total_travelers + $trip->current_travelers) > $trip->max_travelers) {
                return back()->with('failed', 'The total number of travelers exceeds the maximum allowed for this trip!');
            }
            $trip->current_travelers += $total_travelers;
            $trip->save();
        }

        $booking->fill($formFields)->save();

        return back();
    }

    /**
     * Verify the ticket by checking the uuid
     */
    public function verify(Request $request) {
        if (Booking::where('uuid', $request->input('token'))->first()) {
            return view('pages.admin.booking.verify', ['validated' => true]);
        } else {
            return view('pages.admin.booking.verify', ['validated' => false]);
        }
    }
}
