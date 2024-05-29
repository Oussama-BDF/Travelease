<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\TripController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ContactController;


// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// About Us Route
Route::get('/about-us', function() {
    return view('pages.user.about_us');
})->name('about_us');

// Contact Us Routes
Route::prefix('contact-us')->name('contact.')->controller(ContactController::class)->group(function () {
    Route::get('/', 'create')->name('create');
    Route::post('/', 'store')->name('store');
});

// Trips Routes
Route::prefix('trips')->name('trips.')->controller(TripController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/{trip_uuid}', 'show')->name('show');
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

// User Routes (required auth)
Route::middleware(['role:user', 'auth'])->group(function () {
    // User Profile
    Route::prefix('profile')->name('profile.')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::patch('/password', 'updatePassword')->name('password.update');
        Route::delete('/', 'destroy')->name('destroy');
    });

    // Review Routes
    Route::prefix('reviews')->name('reviews.')->controller(ReviewController::class)->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
    });

    // Booking Routes
    Route::prefix('bookings')->name('bookings.')->controller(BookingController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/{trip_uuid}', 'create')->name('create');
        Route::post('/{trip_uuid}', 'store')->name('store');
        Route::get('/checkout/success', 'checkoutSuccess')->name('checkout.success');
        Route::get('/checkout/cancel', 'checkoutCancel')->name('checkout.cancel');
        Route::post('/retry/{booking_uuid}', 'retryPayment')->name('retryPayment');
        Route::get('/ticket/{booking_uuid}', 'getTicket')->name('ticket');
    });
});