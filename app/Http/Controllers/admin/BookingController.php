<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Display a listing of the pending bookings.
     */
    public function index() {
        $bookings = Booking::where('status', 'pending')->orderBy('id', 'desc')->get();
        return view('pages.admin.booking.index', compact('bookings'));
    }

    /**
     * Display a listing of the confirmed bookings.
     */
    public function confirmed() {
        $bookings = Booking::where('status', 'confirmed')->orderBy('id', 'desc')->get();
        return view('pages.admin.booking.index', compact('bookings'));
    }

    /**
     * Display a listing of the canceled bookings.
     */
    public function canceled() {
        $bookings = Booking::where('status', 'canceled')->orderBy('id', 'desc')->get();
        return view('pages.admin.booking.index', compact('bookings'));
    }

    /**
     * Update the status of a specified booking in storage.
     */
    public function update(Request $request, Booking $booking) {
        $formFields = $request->validate([
            'status' => 'required',
        ]);

        // Check if the booking status has the allowed values
        $allowed_values = ['pending', 'confirmed', 'canceled'];
        if (!in_array($formFields['status'], $allowed_values)) {
            return back();
        }

        $booking->fill($formFields)->save();

        return back();
    }
}
