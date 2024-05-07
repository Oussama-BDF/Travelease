<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TransportController;
use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ManageUsersController;

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

Route::get('/', function () {
    return view('user.home');
})->name('home');


// Admin Routes
Route::middleware(['role:admin', 'auth'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    // Trips
    Route::resource('transports', TransportController::class);
    // Transports
    Route::resource('trips', TripController::class);
    // Admin Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::patch('/password', [ProfileController::class, 'updatePassword'])->name('admin.password.update');
    // Users Management
    Route::get('/users', [ManageUsersController::class, 'index'])->name('admin.users.index');
});

// Admin Auth
Route::name('admin.')->controller(AuthController::class)->prefix('admin')->group(function() {
    Route::get('/login', 'showLoginForm')->name('loginForm')->middleware('guest');
    Route::post('/login', 'login')->name('login')->middleware('guest');
    
    Route::get('/logout', 'logout')->name('logout')->middleware(['role:admin', 'auth']);
});

require __DIR__.'/user.php';
