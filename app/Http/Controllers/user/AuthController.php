<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AuthController extends Controller
{
    public function showLoginForm() {
        return view('pages.user.auth.login');
    }

    public function login(Request $request) {
        $email = $request->email;
        $password = $request->password;
        $auth = Auth::attempt([
            'email' => $email,
            'password' => $password,
        ]);
        if($auth && Auth::user()->hasRole('user')) {
            $request->session()->regenerate();
            return to_route('home');
        } else {
            $request->session()->invalidate();
            return back()->withErrors([
                'email' => 'Email or password incorrecte!',
            ])->onlyInput('email');
        }
    }

    public function showRegisterForm() {
        return view('pages.user.auth.register');
    }

    public function register(UserRequest $request) {
        // Retrieve the form data
        $formFields = $request->validated();
        $formFields['password'] = Hash::make($formFields['password']);

        // Store the profile image in the public disk and retrieve the paths
        if ($request->hasFile('profile_image')) {
            $formFields['profile_image'] = $request->file('profile_image')->store('profile', 'public');
            $formFields['profile_image_thumbnail'] = static::ResizeStoreImage($request->file('profile_image'), 'profile');
        }

        //Insertion
        $user = User::create($formFields);

        // Assign the role 'user' to the user created
        $user->assignRole('user');

        return redirect()->route('loginForm');
    }

    public function logout() {
        Session::flush();
        Auth::logout();
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
}