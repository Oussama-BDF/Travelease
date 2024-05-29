<?php

use App\Http\Controllers\Admin\TransportController;
use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ManageUsersController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Admin Auth Routes
Route::prefix('admin')->name('admin.')->controller(AuthController::class)->group(function() {
    Route::get('/login', 'showLoginForm')->name('loginForm')->middleware('guest');
    Route::post('/login', 'login')->name('login')->middleware('guest');
    Route::get('/logout', 'logout')->name('logout')->middleware(['role:admin', 'auth']);
});

// Charts
Route::get('/popular-destinations', [ChartController::class, 'popularDestinations'])->middleware(['role:admin', 'auth']);
Route::get('/booking-status-distribution', [ChartController::class, 'bookingStatusDistribution'])->middleware(['role:admin', 'auth']);

// Admin Routes (required auth)
Route::middleware(['role:admin', 'auth'])->name('admin.')->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Transports
    Route::prefix('transports')->name('transports.')->controller(TransportController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::put('/{transport_uuid}', 'update')->name('update');
        Route::delete('/{transport_uuid}', 'destroy')->name('destroy');
    });

    // Trips
    Route::prefix('trips')->name('trips.')->controller(TripController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{trip_uuid}', 'show')->name('show');
        Route::get('/{trip_uuid}/edit', 'edit')->name('edit');
        Route::put('/{trip_uuid}', 'update')->name('update');
        Route::delete('/{trip_uuid}', 'destroy')->name('destroy');
    });

    // Profile
    Route::prefix('profile')->name('profile.')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::patch('/password', 'updatePassword')->name('password.update');
    });

    // Users Management
    Route::prefix('users')->name('users.')->controller(ManageUsersController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{user_uuid}', 'show')->name('show');
    });

    // Manage Reviews
    Route::prefix('reviews')->name('reviews.')->controller(ReviewController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::delete('/{review_uuid}', 'destroy')->name('destroy');
    });

    // Manage Bookings
    Route::prefix('bookings')->name('bookings.')->controller(BookingController::class)->group(function () {
        Route::get('/', 'index')->name('pending');
        Route::get('/confirmed', 'index')->name('confirmed');
        Route::get('/canceled', 'index')->name('canceled');
        Route::patch('/{booking_uuid}', 'update')->name('update');
        Route::get('/verify', 'verify')->name('verify'); // Verify QrCode
    });

    // Generate Report
    Route::get('/report', [ReportController::class, 'generateReport'])->name('report');

    // Contact Messages
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
});