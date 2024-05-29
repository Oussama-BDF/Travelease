<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UserRequest;

class AuthController extends BaseController
{
    /**
     * Show the form for creating a new user.
     */
    public function showRegisterForm() {
        return view('pages.user.auth.register');
    }

    /**
     * Store a newly created user in storage.
     */
    public function register(UserRequest $request) {
        // Retrieve the form data
        $formFields = $request->validated();
        $formFields['password'] = Hash::make($formFields['password']);

        // Store the profile image in the public disk and retrieve the paths
        if ($request->hasFile('profile_image')) {
            $formFields['profile_image'] = $request->file('profile_image')->store('profile', 'public');
            $formFields['profile_image_thumbnail'] = static::processThumbnail($request->file('profile_image'), 'profile');
        }

        //Insertion
        $user = User::create($formFields);

        // Assign the role 'user' to the user created
        $user->assignRole('user');

        return redirect()->route('loginForm');
    }

    /**
     * Show the form for login
     */
    public function showLoginForm() {
        return view('pages.user.auth.login');
    }

    public function login(Request $request) {
        // Retrive form data
        $email = $request->email;
        $password = $request->password;
        $remember = $request->has('remember');
        
        // Verify credential data
        $auth = Auth::attempt([
            'email' => $email,
            'password' => $password,
        ], $remember);

        if($auth && Auth::user()->hasRole('user')) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        } else {
            $request->session()->invalidate();
            return back()->withErrors([
                'email' => 'Email or password incorrecte!',
            ])->onlyInput('email');
        }
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return to_route('home');
    }
}