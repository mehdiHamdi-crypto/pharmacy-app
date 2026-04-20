<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products_total'   => Product::count(),
            'products_active'  => Product::where('is_active', true)->count(),
            'products_low'     => Product::lowStock(10)->count(),
            'customers_total'  => User::where('role', 'customer')->count(),
            'categories_total' => Category::count(),
        ];

        // Valeurs factices en attendant un module commandes — remplace par Orders::sum(...) quand prêt
        $revenue = 128430.50;
        $ordersCount = 247;

        $recentProducts   = Product::with('category')->latest()->take(6)->get();
        $lowStockProducts = Product::lowStock(10)->orderBy('stock')->take(5)->get();

        return view('admin.dashboard', compact(
            'stats', 'revenue', 'ordersCount', 'recentProducts', 'lowStockProducts'
        ));
    }
}