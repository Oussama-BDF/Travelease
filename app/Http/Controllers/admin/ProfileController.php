<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\PasswordUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends BaseController
{
    /**
     * Display the user's profile form.
     */
    public function edit()
    {
        return view('pages.admin.profile.edit');
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
            $validated['profile_image_thumbnail'] = static::processThumbnail($request->file('profile_image'), 'profile');
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

    /**
     * Update the password
     */
    public function updatePassword(PasswordUpdateRequest $request) {
        $validated = $request->validated();

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Your <strong>Password</strong> Updated Successfully');
    }
}
