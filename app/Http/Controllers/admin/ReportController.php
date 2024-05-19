<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Models\Booking;
use App\Models\Trip;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function generateReport(Request $request)
    {
        // Earning Monthly
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;
        $earningMonthly = Booking::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->sum('total_amount');

        // Earning Annual
        $earningAnnual = Booking::whereYear('created_at', $year)
            ->sum('total_amount');

        // Pending payments
        $pendingPayments = Booking::where('payment_status', 'unpaid')->count();

        // New User (Monthly)
        $newUsers = User::role('user')->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        // Bookings (Monthly)
        $bookingsMonthly = Booking::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();

        // Top five destinations
        $topDestinations = DB::table('trips')
            ->join('bookings', 'trips.id', '=', 'bookings.trip_id')
            ->select('trips.destination', DB::raw('count(bookings.id) as bookings_count'))
            ->groupBy('trips.destination')
            ->orderByDesc('bookings_count')
            ->take(5)
            ->get();

        $bookingStatuses = Booking::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->select('status', DB::raw('COUNT(*) as status_count'))
            ->groupBy('status')
            ->get();

        // Pass data to the view
        $data = [
            'earningMonthly' => $earningMonthly,
            'earningAnnual' => $earningAnnual,
            'pendingPayments' => $pendingPayments,
            'bookingsMonthly' => $bookingsMonthly,
            'newUsers' => $newUsers,
            'topDestinations' => $topDestinations,
            'bookingStatuses' => $bookingStatuses,
            'generatedOn' => now()->format('Y-m-d'),
        ];

        // Load the view and convert it to PDF
        $pdf = PDF::loadView('pages.admin.report', $data);

        // Download the PDF
        return $pdf->download('report.pdf');
    }
}
