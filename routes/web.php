<?php

use Illuminate\Support\Facades\Route;
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
// Charts
Route::get('/popular-destinations', [ChartController::class, 'popularDestinations']);
Route::get('/booking-status-distribution', [ChartController::class, 'bookingStatusDistribution']);

// Admin Routes
Route::middleware(['role:admin', 'auth'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // Transports
    Route::get('/transports', [TransportController::class, 'index'])->name('admin.transports.index');
    Route::get('/transports/create', [TransportController::class, 'create'])->name('admin.transports.create');
    Route::post('/transports', [TransportController::class, 'store'])->name('admin.transports.store');
    Route::put('/transports/{transport_uuid}', [TransportController::class, 'update'])->name('admin.transports.update');
    Route::delete('/transports/{transport_uuid}', [TransportController::class, 'destroy'])->name('admin.transports.destroy');
    // Trips
    Route::get('/trips', [TripController::class, 'index'])->name('admin.trips.index');
    Route::get('/trips/create', [TripController::class, 'create'])->name('admin.trips.create');
    Route::post('/trips', [TripController::class, 'store'])->name('admin.trips.store');
    Route::get('/trips/{trip_uuid}', [TripController::class, 'show'])->name('admin.trips.show');
    Route::get('/trips/{trip_uuid}/edit', [TripController::class, 'edit'])->name('admin.trips.edit');
    Route::put('/trips/{trip_uuid}', [TripController::class, 'update'])->name('admin.trips.update');
    Route::delete('/trips/{trip_uuid}', [TripController::class, 'destroy'])->name('admin.trips.destroy');

    // Admin Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::patch('/password', [ProfileController::class, 'updatePassword'])->name('admin.password.update');
    // Users Management
    Route::get('/users', [ManageUsersController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{user_uuid}', [ManageUsersController::class, 'show'])->where('user', '\d+')->name('admin.users.show');
    // Manage Reviews
    Route::get('/reviews', [ReviewController::class, 'index'])->name('admin.reviews.index');
    Route::delete('/reviews/{review_uuid}', [ReviewController::class, 'destroy'])->where('review', '\d+')->name('admin.reviews.destroy');
    // Manage Bookings
    Route::get('/bookings', [BookingController::class, 'index'])->name('admin.bookings.pending');
    Route::get('/bookings/confirmed', [BookingController::class, 'index'])->name('admin.bookings.confirmed');
    Route::get('/bookings/canceled', [BookingController::class, 'index'])->name('admin.bookings.canceled');
    Route::patch('/bookings/{booking_uuid}', [BookingController::class, 'update'])->where('review', '\d+')->name('admin.bookings.update');

    // Generate Report
    Route::get('/report', [ReportController::class, 'generateReport'])->name('admin.report');

    // Verify QrCode
    Route::get('/bookings/verify', [BookingController::class, 'verify'])->name('admin.bookings.verify');

    // Contact Messages
    Route::get('/contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
});

// Admin Auth Routes
Route::name('admin.')->controller(AuthController::class)->prefix('admin')->group(function() {
    Route::get('/login', 'showLoginForm')->name('loginForm')->middleware('guest');
    Route::post('/login', 'login')->name('login')->middleware('guest');
    
    Route::get('/logout', 'logout')->name('logout')->middleware(['role:admin', 'auth']);
});

require __DIR__.'/user.php';