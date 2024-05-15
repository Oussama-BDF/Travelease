<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
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
