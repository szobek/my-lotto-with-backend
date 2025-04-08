<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LottoController;
use Illuminate\Support\Facades\Auth;


Route::get('/', [HomeController::class,'index']);
// Show login form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Handle login
Route::post('/login', [AuthController::class, 'login']);

// Show registration form
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

// Handle registration
Route::post('/register', [AuthController::class, 'register']);

// Handle logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected route (example)
Route::get('/dashboard', function () {
    return 'Welcome to the dashboard!';
})->middleware('auth');
Auth::routes([
    "verify" => true
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/lotto', [LottoController::class, 'index'])->middleware('auth')->middleware("verified")->name('lotto');