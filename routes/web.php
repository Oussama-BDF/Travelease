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
    // Trips
    Route::name('admin')->resource('transports', TransportController::class)->except(['edit', 'show']);
    // Transports
    Route::name('admin')->resource('trips', TripController::class);
    // Admin Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::patch('/password', [ProfileController::class, 'updatePassword'])->name('admin.password.update');
    // Users Management
    Route::get('/users', [ManageUsersController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{user}', [ManageUsersController::class, 'show'])->where('user', '\d+')->name('admin.users.show');
    // Manage Reviews
    Route::get('/reviews', [ReviewController::class, 'index'])->name('admin.reviews.index');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->where('review', '\d+')->name('admin.reviews.destroy');
    // Manage Bookings
    Route::get('/bookings', [BookingController::class, 'index'])->name('admin.bookings.pending');
    Route::get('/bookings/confirmed', [BookingController::class, 'index'])->name('admin.bookings.confirmed');
    Route::get('/bookings/canceled', [BookingController::class, 'index'])->name('admin.bookings.canceled');
    Route::patch('/bookings/{booking}', [BookingController::class, 'update'])->where('review', '\d+')->name('admin.bookings.update');
    // Route for canceling a booking
    // Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');

    // Generate Report
    Route::get('/report', [ReportController::class, 'generateReport'])->name('admin.report');

});

// Admin Auth Routes
Route::name('admin.')->controller(AuthController::class)->prefix('admin')->group(function() {
    Route::get('/login', 'showLoginForm')->name('loginForm')->middleware('guest');
    Route::post('/login', 'login')->name('login')->middleware('guest');
    
    Route::get('/logout', 'logout')->name('logout')->middleware(['role:admin', 'auth']);
});

require __DIR__.'/user.php';