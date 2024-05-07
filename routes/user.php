<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ProfileController;


// User Routes
Route::middleware(['role:user', 'auth'])->group(function () {
    // User Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User Auth
Route::controller(AuthController::class)->group(function() {
    Route::get('/login', 'showLoginForm')->name('loginForm')->middleware('guest');
    Route::post('/login', 'login')->name('login')->middleware('guest');
    
    Route::get('/register', 'showRegisterForm')->name('registerForm')->middleware('guest');
    Route::post('/register', 'register')->name('register')->middleware('guest');
    
    Route::get('/logout', 'logout')->name('logout')->middleware(['role:user', 'auth']);
});