<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products_total' => Product::count(),
            'products_active' => Product::where('is_active', true)->count(),
            'products_low' => Product::whereBetween('stock', [1, 10])->count(),
            'products_out' => Product::where('stock', 0)->count(),
            'stock_units' => (int) Product::sum('stock'),
            'customers_total' => User::where('role', 'customer')->count(),
            'categories_total' => Category::count(),
            'orders_pending' => Order::where('status', 'pending')->count(),
        ];

        $revenue = Order::sum('total_price');
        $ordersCount = Order::count();

        $recentProducts = Product::with('category')->latest()->take(6)->get();
        $lowStockProducts = Product::where('stock', '<=', 10)->orderBy('stock')->take(6)->get();
        $recentOrders = Order::with('user')->withCount('items')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'stats',
            'revenue',
            'ordersCount',
            'recentProducts',
            'lowStockProducts',
            'recentOrders'
        ));
    }
}