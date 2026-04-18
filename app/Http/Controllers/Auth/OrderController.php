<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Auth::user()->orders()->latest()->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);

        return view('orders.show', compact('order'));
    }

    public function checkout()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->product->final_price * $item->quantity);
        $tax = $subtotal * 0.1; // 10% TVA
        $shipping = 50; // Frais fixes
        $total = $subtotal + $tax + $shipping;

        return view('orders.checkout', compact('cartItems', 'subtotal', 'tax', 'shipping', 'total'));
    }

    public function store()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        try {
            DB::beginTransaction();

            $subtotal = $cartItems->sum(fn($item) => $item->product->final_price * $item->quantity);
            $tax = $subtotal * 0.1;
            $shipping = 50;
            $total = $subtotal + $tax + $shipping;

            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'CMD-' . time(),
                'total_price' => $total,
                'tax_amount' => $tax,
                'shipping_amount' => $shipping,
                'status' => 'pending',
                'payment_status' => 'unpaid',
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->product->final_price,
                    'subtotal' => $item->product->final_price * $item->quantity,
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            Auth::user()->cartItems()->delete();

            DB::commit();

            return redirect()->route('orders.show', $order)->with('success', 'Commande créée avec succès!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors de la création de la commande.');
        }
    }
}