<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\Transport;
use App\Models\Activity;
use App\Models\Image;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Use "with" to avoid the duplication of queries on the table transports
        $trips = Trip::query()->with('transport')->paginate(10);
        return view('pages.user.trip.index', compact('trips'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        return view('pages.user.trip.show', compact('trip'));
    }
    
}
