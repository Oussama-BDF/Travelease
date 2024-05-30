<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Trip;
use App\Models\Transport;
use App\Models\Activity;
use App\Models\Image;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use Illuminate\Http\Request;

class TripController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trip::query()
            ->orderBy('id', 'desc')
            ->paginate(9);

        return view('pages.admin.trip.index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $transports = Transport::all();
        return view('pages.admin.trip.create', compact('transports')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripRequest $request)
    {
        // Retrieve form data
        $formFields = $request->validated();

        // Check if the transport id exist in the db (security)
        if (empty(Transport::find($formFields['transport_id']))) {
            return to_route('admin.trips.index')->with('failed', 'Cannot Create This Trip, Try Again');
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

        // Store the images
        $imagesData = [];
        for ($i=1; $i<=3; $i++) {
            if ($request->hasFile('image'.$i)) {
                // Upload the images in the public disk
                $originalImagePath = $request->file('image'.$i)->store('trip', 'public');
                $thumbnailImagePath = static::ResizeStoreImage($request->file('image'.$i), 'trip');
                // Prepare images data
                $imagesData[] = [
                    'path' => $originalImagePath,
                    'thumbnail' => $thumbnailImagePath,
                ];
            }
        }
        // Create the images in the db
        $trip->images()->createMany($imagesData);
        
        return to_route('admin.trips.index')->with('success', 'Your <strong>Trip</strong> Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($trip_uuid)
    {
        $trip = Trip::where('uuid', $trip_uuid)->firstOrFail();
        return view('pages.admin.trip.show', compact('trip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($trip_uuid)
    {
        $trip = Trip::where('uuid', $trip_uuid)->firstOrFail();
        $transports = Transport::all();
        return view('pages.admin.trip.edit', compact('trip', 'transports')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTripRequest $request, $trip_uuid)
    {
        $trip = Trip::where('uuid', $trip_uuid)->firstOrFail();
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

        // Store the images
        $imagesData = [];
        $deletingCount = 0;
        $tripImages = count($trip->images);
        
        /*ayoub propos*/
        $numberImageUploaded = 0;
        $numberImageDelted = 0;
        if ($request->hasFile('image1')) {
            $numberImageUploaded++;
        }
        if ($request->hasFile('image2')) {
            $numberImageUploaded++;
        }

        if ($request->hasFile('image3')) {
            $numberImageUploaded++;
        }

        if ($request->has('delete_image1')) {
            $numberImageDelted++;
        }
        if ($request->has('delete_image2')) {
            $numberImageDelted++;
        }

        if ($request->has('delete_image3')) {
            $numberImageDelted++;
        }
        /*ayoub propos*/

        for ($i=1; $i<=3; $i++) {
            if ($request->hasFile('image'.$i)) {
                // Upload the new image to the server
                $originalImagePath = $request->file('image'.$i)->store('trip', 'public');
                $thumbnailImagePath = static::ResizeStoreImage($request->file('image'.$i), 'trip');
                // Delete the old image from the server if exist
                if ($image = Image::find($request->{"id$i"})) {
                    static::deleteFile($image->path);
                    static::deleteFile($image->thumbnail);
                }
                // Prepare the new images data to store in the db
                $imagesData[] = [
                    'id' => $request->{"id$i"} ?? null,
                    'path' => $originalImagePath,
                    'thumbnail' => $thumbnailImagePath,
                    'trip_id' => $trip->id,
                ];
            } elseif ($request->has("delete_image".$i)) { // check if the image is need to be deleted
                // Delete the image from the server & from the db
                // Delete in maximum two images
               // if (($image = Image::find($request->{"id$i"})) && $tripImages- $deletingCount > 1) {
                if (($image = Image::find($request->{"id$i"})) && ($numberImageUploaded >= $numberImageDelted  || $tripImages >1) ) {
                    static::deleteFile($image->path);
                    static::deleteFile($image->thumbnail);
                    $image->delete();
                    $deletingCount++;
                }
            }
        }
        // Create or update images in the database
        Image::upsert(
            $imagesData,
            ['id'],
            ['path', 'thumbnail', 'trip_id']
        );

        return to_route('admin.trips.index')->with('success', 'Your <strong>Trip</strong> Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($trip_uuid)
    {
        $trip = Trip::where('uuid', $trip_uuid)->firstOrFail();

        // Delete the images from the server
        foreach ($trip->images as $image) {
            static::deleteFile($image->path);
            static::deleteFile($image->thumbnail);
        }

        // Delete the trip from the db
        $trip->delete();

        return to_route('admin.trips.index')->with('success', 'Your <strong>Trip</strong> Deleted Successfully');
    }
}
