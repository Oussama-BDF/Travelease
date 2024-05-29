<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\PasswordUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends BaseController
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

        return back()->with('success', 'password-updated');
    }

    /**
     * Delete the account
     */
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
}
