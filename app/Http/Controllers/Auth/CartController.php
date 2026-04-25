<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cartItems = Auth::user()
            ->cartItems()
            ->with('product.category')
            ->latest()
            ->get();

        $subtotal = $cartItems->sum(fn ($item) => $item->product->final_price * $item->quantity);
        $tax = $subtotal * 0.1;
        $shipping = $cartItems->isEmpty() ? 0 : 50;
        $total = $subtotal + $tax + $shipping;
        $totalQuantity = (int) $cartItems->sum('quantity');

        return view('cart.index', compact('cartItems', 'subtotal', 'tax', 'shipping', 'total', 'totalQuantity'));
    }

    public function add(Request $request, Product $product)
    {
        $data = $request->validate([
            'quantity' => 'nullable|integer|min:1',
        ]);

        $quantity = (int) ($data['quantity'] ?? 1);

        if (! $product->is_active) {
            return back()->with('error', 'Ce produit nest plus disponible.');
        }

        if ($product->stock < $quantity || $product->stock <= 0) {
            return back()->with('error', 'Stock insuffisant pour ce produit.');
        }

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $quantity;

            if ($newQuantity > $product->stock) {
                return back()->with('error', 'La quantite demandee depasse le stock disponible.');
            }

            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()
            ->route('cart.index')
            ->with('success', $product->name . ' a bien ete ajoute au panier.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $this->authorize('update', $cartItem);

        $data = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($data['quantity'] > $cartItem->product->stock) {
            return back()->with('error', 'La quantite demandee depasse le stock disponible.');
        }

        $cartItem->update(['quantity' => $data['quantity']]);

        return back()->with('success', 'Panier mis a jour.');
    }

    public function remove(CartItem $cartItem)
    {
        $this->authorize('delete', $cartItem);
        $cartItem->delete();

        return back()->with('success', 'Produit supprime du panier.');
    }

    public function clear()
    {
        Auth::user()->cartItems()->delete();

        return back()->with('success', 'Panier vide.');
    }
}