<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\AuthController;

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
    return view('home');
})->name('home');


// Admin Routes
Route::middleware(['role:admin', 'auth'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/', function () {
        return view('pages.admin.dashboard');
    })->name('dashboard');
    // Trips
    Route::resource('transports', TransportController::class);
    // Transports
    Route::resource('trips', TripController::class);
});

// User/Admin Auth
Route::controller(AuthController::class)->group(function() {
    Route::get('/login', 'showLoginForm')->name('loginForm')->middleware('guest');
    Route::post('/login', 'login')->name('login')->middleware('guest');
    
    Route::get('/register', 'showRegisterForm')->name('registerForm')->middleware('guest');
    Route::post('/register', 'register')->name('register')->middleware('guest');
    
    Route::get('/logout', 'logout')->name('logout')->middleware('auth');
});

