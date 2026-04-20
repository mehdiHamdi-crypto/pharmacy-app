<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ProductController as AdminProducts;
use App\Models\Product;

// ============================================
// Landing page
// ============================================
Route::get('/', function () {
    return view('index');
})->name('index');

// ============================================
// Catalogue public (page produits)
// ============================================
Route::get('/products', function () {
    $products = Product::with('category')
        ->where('is_active', true)
        ->latest()
        ->paginate(12);
    return view('products.index', compact('products'));
})->name('products.index');

// ============================================
// Auth Routes (guest only)
// ============================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// ============================================
// Logout
// ============================================
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ============================================
// Admin Routes
// ============================================
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');

        Route::resource('products', AdminProducts::class)->except(['show']);
        Route::patch('products/{product}/toggle', [AdminProducts::class, 'toggle'])
             ->name('products.toggle');
    });