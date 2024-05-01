<?php

namespace App\Http\Controllers;

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
    public function store(StoreTripRequest $request)
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

        // Store the images
        $imagesData = [];
        for ($i=1; $i<=3; $i++) {
            if ($request->hasFile('image'.$i)) {
                // Upload the images
                $originalImagePath = $request->file('image'.$i)->store('trip', 'public');
                $thumbnailImagePath = static::ResizeStoreImage($request->file('image'.$i), 'thumbnails');
                // Prepare images data
                $imagesData[] = [
                    'path' => $originalImagePath,
                    'thumbnail' => $thumbnailImagePath,
                ];
            }
        }
        // Create the images in the db
        $trip->images()->createMany($imagesData);
        
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
    public function update(UpdateTripRequest $request, Trip $trip)
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

        // Store the images
        // Todo : Allow the admin to delete an image.
        $imagesData = [];
        for ($i=1; $i<=3; $i++) {
            if ($request->hasFile('image'.$i)) {
                // Upload the new image to the server
                $originalImagePath = $request->file('image'.$i)->store('trip', 'public');
                $thumbnailImagePath = static::ResizeStoreImage($request->file('image'.$i), 'thumbnails');
                // Delete the old image from the server & from the db if exist
                if ($image = Image::find($request->{"id$i"})) {
                    static::deleteFile($image->path);
                    static::deleteFile($image->thumbnail);
                    $image->delete();
                }
                // Prepare the new images data to store in the db
                $imagesData[] = [
                    'id' => $request->{"id$i"} ?? null,
                    'path' => $originalImagePath,
                    'thumbnail' => $thumbnailImagePath,
                    'trip_id' => $trip->id,
                ];
            }
        }
        // Create or update images in the database
        Image::upsert(
            $imagesData,
            ['id'],
            ['path', 'thumbnail', 'trip_id']
        );

        return to_route('trips.index')->with('success', 'Your <strong>Trip</strong> Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        // Delete the images from the server
        foreach ($trip->images as $image) {
            $fileToDelete = $image->path;
            static::deleteFile($image->path);
            static::deleteFile($image->thumbnail);
        }

        // Delete the trip from the db
        $trip->delete();

        return to_route('trips.index')->with('success', 'Your <strong>Trip</strong> Deleted Successfully');
    }

    public static function ResizeStoreImage($OriginalImage, $place) {
        // create image manager with desired driver
        $manager = new ImageManager(new Driver());

        // Generate unique file name for the thumbnail image
        $thumbnailImageName = time() . '.' . $OriginalImage->getClientOriginalExtension();

        // read image from file system
        $image = $manager->read($OriginalImage);

        // resize image
        $image->scale(width: 100);

        $thumbnailImagePath = $place . '/' . $thumbnailImageName;

        // save modified image in new format 
        $image->toPng()->save('storage/' . $thumbnailImagePath);

        // Return the file path
        return $thumbnailImagePath;
    }

    public static function deleteFile($fileToDelete) {
        // Check if the file exists before attempting to delete it
        if (Storage::disk('public')->exists($fileToDelete)) {
            // Delete the file
            Storage::disk('public')->delete($fileToDelete);
        }
    }
}
