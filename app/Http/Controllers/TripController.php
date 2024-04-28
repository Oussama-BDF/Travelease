<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Transport;
use App\Http\Requests\TripRequest;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Use "with" to avoid the duplication of queries on the table transports
        $trips = Trip::query()->with('transport')->paginate(10);
        return view('pages.trip.index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $transports = Transport::all();
        return view('pages.trip.create', compact('transports')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TripRequest $request)
    {
        // Retrieve form data
        $formFields = $request->post();
        // Check if the transport id exist in the db (security)
        if (empty(Transport::find($formFields['transport_id']))) {
            return to_route('trips.index')->with('failed', 'Cannot Create This Trip, Try Again');
        }
        // Create the trip
        $trip = Trip::create($formFields);
        return to_route('trips.index')->with('success', 'Your <strong>Trip</strong> Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        return view('pages.trip.show', compact('trip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        $transports = Transport::all();
        return view('pages.trip.edit', compact('trip', 'transports')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TripRequest $request, Trip $trip)
    {
        // Retrieve form data
        $formFields = $request->post();
        // Fill the trip object
        $trip->fill($formFields);
        // Check if there is an update in the object
        if ($trip->isDirty()) {
            $trip->save();
            return to_route('trips.index')->with('success', 'Your <strong>Trip</strong> Updated Successfully');
        } else {
            return to_route('trips.index')->with('warning', 'No changes were made to the Trip');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        $trip->delete();
        return to_route('trips.index')->with('success', 'Your <strong>Trip</strong> Deleted Successfully');
    }
}
