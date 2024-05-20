<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\PasswordUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit()
    {
        return view('pages.user.profile.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileUpdateRequest $request)
    {
        // Retrieve the form data
        $validated = $request->validated();

        // Check if the user want to change the image
        if ($request->hasFile('profile_image')) {
            // Delete the old image if exist
            if ($request->user()->profile_image) {
                static::deleteFile($request->user()->profile_image);
                static::deleteFile($request->user()->profile_image_thumbnail);
            }
            // Store the new image in the public disk and retrieve the paths
            $validated['profile_image'] = $request->file('profile_image')->store('profile', 'public');
            $validated['profile_image_thumbnail'] = static::ResizeStoreImage($request->file('profile_image'), 'profile');
        }

        // Check if the user want to delete the old profile image
        if ($request->input('delete_image')) {
            // Delete the image form the server and from the db
            if ($request->user()->profile_image) {
                static::deleteFile($request->user()->profile_image);
                static::deleteFile($request->user()->profile_image_thumbnail);
                $request->user()->profile_image = null;
                $request->user()->profile_image_thumbnail = null;
            }
        }

        $request->user()->fill($validated)->save();

        return back()->with('success', 'Your <strong>Profile</strong> Added Successfully');
    }

    public function updatePassword(PasswordUpdateRequest $request) {
        $validated = $request->validated();

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'password-updated');
    }

    public function destroy(Request $request) {
        $request->validate([
            'your_password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Delete the profile image if exist
        if($user->profile_image) {
            static::deleteFile($user->profile_image);
            static::deleteFile($user->profile_image_thumbnail);
        }

        // Logout and delete the account
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('home');
    }

    public static function ResizeStoreImage($OriginalImage, $destinationDirectory) {
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

    public static function deleteFile($fileToDelete) {
        // Check if the file exists before attempting to delete it
        if (Storage::disk('public')->exists($fileToDelete)) {
            // Delete the file
            Storage::disk('public')->delete($fileToDelete);
        }
    }
}
