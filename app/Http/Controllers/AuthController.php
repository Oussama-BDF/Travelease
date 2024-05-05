<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showLoginForm() {
        return view('pages.auth.login');
    }

    public function login(Request $request) {
        $email = $request->email;
        $password = $request->password;
        $auth = Auth::attempt([
            'email' => $email,
            'password' => $password,
        ]);
        if($auth) {
            $request->session()->regenerate();
            return to_route(Auth::user()->getRedirectRoute()); // Redirect based on account type (admin/user)
        } else {
            return back()->withErrors([
                'email' => 'Email or password incorrecte!',
            ])->onlyInput('email');
        }
    }

    public function showRegisterForm() {
        return view('pages.auth.register');
    }

    public function register(UserRequest $request) {
        $name = $request->name;
        $email = $request->email;
        $password = Hash::make($request->password);
        $repassword = $request->password_confirmation;

        //Insertion
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
        // Assign the role 'user' to the user created
        $user->assignRole('user');

        return redirect()->route('loginForm');
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return to_route('home');
    }
}