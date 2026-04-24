<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $recentOrders = $user->orders()
            ->withCount('items')
            ->latest()
            ->take(5)
            ->get();

        $stats = [
            'orders_total' => $user->orders()->count(),
            'orders_pending' => $user->orders()->where('status', 'pending')->count(),
            'cart_items' => $user->cartItems()->sum('quantity'),
            'spent_total' => $user->orders()->sum('total_price'),
        ];

        return view('dashboard', compact('recentOrders', 'stats'));
    }
}