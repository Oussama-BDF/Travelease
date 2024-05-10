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
    public function showLoginForm() {
        return view('pages.admin.auth.login');
    }

    public function login(Request $request) {
        $email = $request->email;
        $password = $request->password;
        $auth = Auth::attempt([
            'email' => $email,
            'password' => $password,
        ]);
        if($auth && Auth::user()->hasRole('admin')) {
            $request->session()->regenerate();
            return to_route('dashboard');
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