<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;


class ChartController extends Controller
{

    public function popularDestinations()
    {
        $topDestinations = DB::table('trips')
            ->join('bookings', 'trips.id', '=', 'bookings.trip_id')
            ->select('trips.destination', DB::raw('count(bookings.id) as bookings_count'))
            ->groupBy('trips.destination')
            ->orderByDesc('bookings_count')
            ->take(5)
            ->get();
    
        return response()->json($topDestinations);
    }

    public function bookingStatusDistribution()
    {
        // Query the database to count bookings grouped by status
        $bookingStatuses = Booking::select('status', DB::raw('COUNT(*) as status_count'))
            ->groupBy('status')
            ->get();

        return response()->json($bookingStatuses);
    }
    

}
