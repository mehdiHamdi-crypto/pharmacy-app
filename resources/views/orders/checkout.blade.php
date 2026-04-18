@extends('layouts.app')

@section('title', 'Confirmation - PharmaCare')

@section('content')

<div style="padding: 40px 0;">
    <div class="container">
        <h1 style="font-size: 36px; margin-bottom: 30px;">Confirmation Commande</h1>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
            
            <div>
                <h2 style="font-size: 22px; margin-bottom: 20px; font-weight: bold;">Articles</h2>
                @foreach($cartItems as $item)
                    <div style="padding: 15px; background: white; border: 1px solid #e5e7eb; border-radius: 8px; margin-bottom: 10px; display: flex; justify-content: space-between;">
                        <div>
                            <p style="font-weight: bold;">{{ $item->product->name }}</p>
                            <p style="color: #6b7280; font-size: 14px;">Qty: {{ $item->quantity }}</p>
                        </div>
                        <p style="font-weight: bold;">{{ number_format($item->product->final_price * $item->quantity, 2) }} DH</p>
                    </div>
                @endforeach
            </div>

            <div style="background: #f9fafb; padding: 25px; border-radius: 12px; height: fit-content;">
                <h3 style="font-size: 18px; margin-bottom: 15px; font-weight: bold;">Total</h3>
                <div style="margin-bottom: 10px; display: flex; justify-content: space-between;">
                    <span>Sous-total:</span>
                    <span>{{ number_format($subtotal, 2) }} DH</span>
                </div>
                <div style="margin-bottom: 10px; display: flex; justify-content: space-between;">
                    <span>TVA (10%):</span>
                    <span>{{ number_format($tax, 2) }} DH</span>
                </div>
                <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between;">
                    <span>Livraison:</span>
                    <span>{{ number_format($shipping, 2) }} DH</span>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 18px; font-weight: bold; margin-bottom: 20px;">
                    <span>Total:</span>
                    <span style="color: #10b981;">{{ number_format($total, 2) }} DH</span>
                </div>

                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <button type="submit" style="width: 100%; padding: 12px; background: #10b981; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 16px; margin-bottom: 10px;">
                        ✓ Confirmer
                    </button>
                </form>
                <a href="{{ route('cart.index') }}" style="display: block; padding: 12px; background: white; color: #10b981; border: 2px solid #10b981; text-align: center; text-decoration: none; border-radius: 8px; font-weight: 600;">
                    ← Retour
                </a>
            </div>
        </div>
    </div>
</div>

@endsection