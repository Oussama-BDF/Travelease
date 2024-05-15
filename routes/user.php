<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\TripController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\BookingController;


// User Routes
Route::middleware(['role:user', 'auth'])->group(function () {
    // User Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Review Routes
    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/', [ReviewController::class, 'store'])->name('reviews.store');

    // Booking Routes
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create/{trip_id}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings/{trip_id}', [BookingController::class, 'store'])->name('bookings.store');
    Route::post('/retry/{booking_id}', [BookingController::class, 'retryPayment'])->name('bookings.retryPayment');

    // Route for handling the Checkout success or cancel actions
    Route::get('/bookings/checkout/success', [BookingController::class, 'checkoutSuccess'])->name('bookings.checkout.success');
    Route::get('/bookings/checkout/cancel', [BookingController::class, 'checkoutCancel'])->name('bookings.checkout.cancel');
});

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');


// User Auth Routes
Route::controller(AuthController::class)->group(function() {
    Route::get('/login', 'showLoginForm')->name('loginForm')->middleware('guest');
    Route::post('/login', 'login')->name('login')->middleware('guest');
    
    Route::get('/register', 'showRegisterForm')->name('registerForm')->middleware('guest');
    Route::post('/register', 'register')->name('register')->middleware('guest');
    
    Route::get('/logout', 'logout')->name('logout')->middleware(['role:user', 'auth']);
});

// Trip Routes
Route::controller(TripController::class)->group(function() {
    Route::get('/trips', [TripController::class, 'index'])->name('trips.index');
    Route::get('/trips/{trip}', [TripController::class, 'show'])->where('trip', '\d+')->name('trips.show');
});