@extends('layouts.app')

@section('title', 'Panier - PharmaCare')

@section('content')
<div style="padding: 40px 0;">
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap; margin-bottom:30px;">
            <h1 style="font-size: 36px;">Mon panier</h1>
            @if($cartItems->isNotEmpty())
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-login" style="background:white;">Vider le panier</button>
                </form>
            @endif
        </div>

        @if($cartItems->isEmpty())
            <div style="text-align: center; padding: 60px 20px; background: #f9fafb; border-radius: 12px;">
                <p style="font-size: 18px; color: #6b7280; margin-bottom: 20px;">Votre panier est vide.</p>
                <a href="{{ route('products.index') }}" class="btn-register">Continuer les achats</a>
            </div>
        @else
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
                <div>
                    @foreach($cartItems as $item)
                        <div style="display: flex; gap: 20px; padding: 20px; background: white; border: 1px solid #e5e7eb; border-radius: 12px; margin-bottom: 15px;">
                            <div style="flex: 1;">
                                <h3 style="font-size: 18px; margin-bottom: 10px; font-weight: bold;">{{ $item->product->name }}</h3>
                                <p style="color: #6b7280; font-size: 14px; margin-bottom: 10px;">{{ \Illuminate\Support\Str::limit($item->product->description, 80) }}</p>
                                <p style="font-size: 16px; font-weight: bold; color: #10b981;">{{ number_format($item->product->final_price, 2, ',', ' ') }} MAD</p>
                            </div>

                            <div style="text-align: right; min-width:180px;">
                                <form action="{{ route('cart.update', $item) }}" method="POST" style="display: flex; gap: 5px; margin-bottom: 10px; justify-content:flex-end;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" style="width: 70px; padding: 8px; border: 1px solid #e5e7eb; border-radius: 6px;">
                                    <button type="submit" style="padding: 8px 15px; background: #10b981; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;">
                                        OK
                                    </button>
                                </form>
                                <p style="font-size: 18px; font-weight: bold; color: #1f2937; margin-bottom: 10px;">{{ number_format($item->product->final_price * $item->quantity, 2, ',', ' ') }} MAD</p>
                                <form action="{{ route('cart.remove', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="padding: 6px 12px; background: #ef4444; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 12px;">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="background: #f9fafb; padding: 25px; border-radius: 12px; height: fit-content;">
                    <h3 style="font-size: 20px; margin-bottom: 20px; font-weight: bold;">Resume</h3>
                    <div style="border-bottom: 1px solid #e5e7eb; padding-bottom: 15px; margin-bottom: 15px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <span>Sous-total</span>
                            <span>{{ number_format($total, 2, ',', ' ') }} MAD</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <span>TVA (10%)</span>
                            <span>{{ number_format($total * 0.1, 2, ',', ' ') }} MAD</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span>Livraison</span>
                            <span>50,00 MAD</span>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 20px; font-weight: bold; margin-bottom: 20px;">
                        <span>Total</span>
                        <span style="color: #10b981;">{{ number_format($total + ($total * 0.1) + 50, 2, ',', ' ') }} MAD</span>
                    </div>
                    <a href="{{ route('checkout') }}" class="btn-register" style="display:block; text-align:center;">Passer la commande</a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection