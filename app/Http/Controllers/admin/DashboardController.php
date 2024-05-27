<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Trip;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index() {
        // Pending Bookings
        $pendingBookings = Booking::where('status', 'pending')->count();
        
        // Earning Monthly
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;
        $earningMonthly = Booking::where('payment_status', 'paid')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->sum('total_amount');

        // Earning Annual
        $earningAnnual = Booking::where('payment_status', 'paid')
            ->whereYear('created_at', $year)
            ->sum('total_amount');

        // Activated Trips
        $activatedTrips = Trip::where('start_at', '>', $now)
            ->orWhere('end_at', '>', $now);
        $activatedTripsCount = $activatedTrips->count();

        // Bookings of activated trips
        $tripIds = $activatedTrips->pluck('id');
        $activatedBookingsCount = Booking::whereIn('trip_id', $tripIds)->count();

        // Pending payments
        $pendingPayments = Booking::where('payment_status', 'unpaid')->count();

        // New User (Monthly)
        $newUsers = User::role('user')->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        // $activatedTrips = Trip::where(function ($query) use ($now) {
        //     $query->where('start_at', '>', $now)
        //         ->orWhere(function ($query) use ($now) {
        //             $query->where('start_at', '<=', $now)
        //                     ->where('end_at', '>', $now);
        //         });
        // })->get();

        // Bookings (Monthly)
        $BookingsMonthly = Booking::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();

        return view('pages.admin.dashboard', compact(
            'pendingBookings',
            'earningMonthly',
            'earningAnnual',
            'activatedTripsCount',
            'activatedBookingsCount',
            'pendingPayments',
            'BookingsMonthly',
            'newUsers',
        ));
    }
}
