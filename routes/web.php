<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategories;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\OrderController as AdminOrders;
use App\Http\Controllers\Admin\ProductController as AdminProducts;
use App\Http\Controllers\Admin\UserController as AdminUsers;
use App\Http\Controllers\Auth\CartController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OrderController;
use App\Http\Controllers\Auth\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');

        Route::resource('products', AdminProducts::class)->except(['show']);
        Route::patch('products/{product}/toggle', [AdminProducts::class, 'toggle'])->name('products.toggle');

        Route::resource('categories', AdminCategories::class)->except(['show']);

        Route::get('orders', [AdminOrders::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [AdminOrders::class, 'show'])->name('orders.show');
        Route::patch('orders/{order}/status', [AdminOrders::class, 'updateStatus'])->name('orders.update-status');

        Route::resource('users', AdminUsers::class)->only(['index', 'edit', 'update', 'destroy']);
    });