<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UserRequest;

class AuthController extends Controller
{
    /**
     * Show the form for login
     */
    public function showLoginForm() {
        return view('pages.admin.auth.login');
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

        if($auth && Auth::user()->hasRole('admin')) {
            $request->session()->regenerate();
            return redirect()->intended('admin');
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