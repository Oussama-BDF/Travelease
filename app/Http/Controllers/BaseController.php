<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BaseController extends Controller
{
    /**
     * Resize and store the image and return it path
     */
    public static function processThumbnail($OriginalImage, $destinationDirectory) {
        // create image manager with desired driver
        $manager = new ImageManager(new Driver());

        // Generate unique file name for the thumbnail image
        $thumbnailImageName = uniqid() . '.' . $OriginalImage->getClientOriginalExtension();

        // read image from file system
        $image = $manager->read($OriginalImage);

        // resize image
        $image->scale(width: 100);

        // Check if the directories exist, if not, create them
        if (!Storage::disk('public')->exists($destinationDirectory)) {
            Storage::disk('public')->makeDirectory($destinationDirectory);
        }
        if (!Storage::disk('public')->exists("{$destinationDirectory}/thumbnails")) {
            Storage::disk('public')->makeDirectory("{$destinationDirectory}/thumbnails");
        }

        // $thumbnailImagePath = 'thumbnails/' . $destinationDirectory . '/' . $thumbnailImageName;
        $thumbnailImagePath = "$destinationDirectory/thumbnails/$thumbnailImageName";

        // save modified image in the public disk
        $image->save(storage_path('app/public/' . $thumbnailImagePath));

        // Return the file path
        return $thumbnailImagePath;
    }

    /**
     * Delete an image
     */
    public static function deleteFile($fileToDelete) {
        // Check if the file exists before attempting to delete it
        if (Storage::disk('public')->exists($fileToDelete)) {
            // Delete the file
            Storage::disk('public')->delete($fileToDelete);
        }
    }
}
