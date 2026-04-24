<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Auth::user()->orders()
            ->withCount('items')
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        $order->load(['items.product', 'user']);

        return view('orders.show', compact('order'));
    }

    public function checkout()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        ['subtotal' => $subtotal, 'tax' => $tax, 'shipping' => $shipping, 'total' => $total] = $this->calculateTotals($cartItems);

        return view('orders.checkout', compact('cartItems', 'subtotal', 'tax', 'shipping', 'total'));
    }

    public function store(Request $request)
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        $data = $request->validate([
            'shipping_address' => 'required|string|max:1000',
            'payment_method' => 'required|in:cash_on_delivery,bank_transfer',
            'notes' => 'nullable|string|max:1000',
        ]);

        foreach ($cartItems as $item) {
            if ($item->quantity > $item->product->stock) {
                return redirect()->route('cart.index')->with('error', 'Un produit de votre panier n est plus assez en stock.');
            }
        }

        try {
            DB::beginTransaction();

            ['tax' => $tax, 'shipping' => $shipping, 'total' => $total] = $this->calculateTotals($cartItems);

            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'CMD-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(4)),
                'total_price' => $total,
                'tax_amount' => $tax,
                'shipping_amount' => $shipping,
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'payment_method' => $data['payment_method'],
                'shipping_address' => $data['shipping_address'],
                'notes' => $data['notes'] ?? null,
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

            return redirect()->route('orders.show', $order)->with('success', 'Commande creee avec succes.');
        } catch (\Throwable $exception) {
            DB::rollBack();

            return back()->with('error', 'Erreur lors de la creation de la commande.');
        }
    }

    private function calculateTotals($cartItems): array
    {
        $subtotal = $cartItems->sum(fn ($item) => $item->product->final_price * $item->quantity);
        $tax = $subtotal * 0.1;
        $shipping = 50;
        $total = $subtotal + $tax + $shipping;

        return compact('subtotal', 'tax', 'shipping', 'total');
    }
}