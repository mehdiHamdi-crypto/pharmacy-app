<?php

namespace App\Providers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use App\Policies\CartItemPolicy;
use App\Policies\OrderPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Gate::policy(CartItem::class, CartItemPolicy::class);
        Gate::policy(Order::class, OrderPolicy::class);

        View::composer('layouts.app', function ($view): void {
            $cartItemCount = Auth::check()
                ? (int) Auth::user()->cartItems()->sum('quantity')
                : 0;

            $view->with('cartItemCount', $cartItemCount);
        });

        View::composer('admin.layouts.app', function ($view): void {
            $adminSidebarStats = [
                'low_stock' => 0,
                'pending_orders' => 0,
            ];

            if (Auth::check() && Auth::user()->isAdmin()) {
                $adminSidebarStats['low_stock'] = Product::where('stock', '>', 0)
                    ->lowStock(10)
                    ->count();

                $adminSidebarStats['pending_orders'] = Order::where('status', 'pending')->count();
            }

            $view->with('adminSidebarStats', $adminSidebarStats);
        });
    }
}