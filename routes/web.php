<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Landing page
Route::get('/', function () {
    return view('index');
})->name('index');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Protected Routes (exemple)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
use Illuminate\Support\Facades\Auth;

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');