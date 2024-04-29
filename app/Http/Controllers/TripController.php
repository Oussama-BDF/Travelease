<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Transport;
use App\Models\Activity;
use App\Http\Requests\TripRequest;
use Illuminate\Http\Request;

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
        $formFields = $request->validated();

        // Check if the transport id exist in the db (security)
        if (empty(Transport::find($formFields['transport_id']))) {
            return to_route('trips.index')->with('failed', 'Cannot Create This Trip, Try Again');
        }

        // Create the trip
        $trip = Trip::create($formFields);

        // Store the activities
        if ($request->has('activity_price') && $request->has('activity_name')) {
            // Prepare activities data
            $activitiesData = [];
            foreach ($request->activity_name as $key => $activity_name) {
                $activitiesData[] = [
                    'name' => $activity_name,
                    'price' => $request->activity_price[$key],
                ];
            }
            // Create activities in the db
            $trip->activities()->createMany($activitiesData);
        }
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
        $formFields = $request->validated();
        // Fill the trip object
        $trip->fill($formFields);
        // Check if there is an update in the trip object
        if ($trip->isDirty()) {
            $trip->save();
        }
        
        // Delete activities related to the trip
        $trip->activities()->delete();
        // Update or create activities
        if ($request->has('activity_name') && $request->has('activity_price')) {
            foreach ($request->activity_name as $key => $activity_name) {
                $activitiesData[] = [
                    'name' => $activity_name,
                    'price' => $request->activity_price[$key],
                ];
            }
            // Create the activities
            $trip->activities()->createMany($activitiesData);
        }

        return to_route('trips.index')->with('success', 'Your <strong>Trip</strong> Updated Successfully');
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
