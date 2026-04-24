@extends('layouts.app')

@section('title', 'Confirmation - PharmaCare')

@section('content')
<div style="padding: 40px 0;">
    <div class="container">
        <h1 style="font-size: 36px; margin-bottom: 30px;">Confirmation de commande</h1>

        <form action="{{ route('orders.store') }}" method="POST" style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
            @csrf

            <div>
                <h2 style="font-size: 22px; margin-bottom: 20px; font-weight: bold;">Articles</h2>
                @foreach($cartItems as $item)
                    <div style="padding: 15px; background: white; border: 1px solid #e5e7eb; border-radius: 8px; margin-bottom: 10px; display: flex; justify-content: space-between;">
                        <div>
                            <p style="font-weight: bold;">{{ $item->product->name }}</p>
                            <p style="color: #6b7280; font-size: 14px;">Qty: {{ $item->quantity }}</p>
                        </div>
                        <p style="font-weight: bold;">{{ number_format($item->product->final_price * $item->quantity, 2, ',', ' ') }} MAD</p>
                    </div>
                @endforeach

                <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px; margin-top:20px;">
                    <div style="margin-bottom:14px;">
                        <label for="shipping_address" style="display:block; font-weight:600; margin-bottom:8px;">Adresse de livraison</label>
                        <textarea id="shipping_address" name="shipping_address" rows="4" required style="width:100%; padding:12px 14px; border:1px solid #d1d5db; border-radius:10px;">{{ old('shipping_address', auth()->user()->address) }}</textarea>
                    </div>

                    <div style="margin-bottom:14px;">
                        <label for="payment_method" style="display:block; font-weight:600; margin-bottom:8px;">Mode de paiement</label>
                        <select id="payment_method" name="payment_method" required style="width:100%; padding:12px 14px; border:1px solid #d1d5db; border-radius:10px;">
                            <option value="cash_on_delivery" @selected(old('payment_method') === 'cash_on_delivery')>Paiement a la livraison</option>
                            <option value="bank_transfer" @selected(old('payment_method') === 'bank_transfer')>Virement bancaire</option>
                        </select>
                    </div>

                    <div>
                        <label for="notes" style="display:block; font-weight:600; margin-bottom:8px;">Notes</label>
                        <textarea id="notes" name="notes" rows="3" style="width:100%; padding:12px 14px; border:1px solid #d1d5db; border-radius:10px;">{{ old('notes') }}</textarea>
                    </div>
                </div>
            </div>

            <div style="background: #f9fafb; padding: 25px; border-radius: 12px; height: fit-content;">
                <h3 style="font-size: 18px; margin-bottom: 15px; font-weight: bold;">Total</h3>
                <div style="margin-bottom: 10px; display: flex; justify-content: space-between;">
                    <span>Sous-total:</span>
                    <span>{{ number_format($subtotal, 2, ',', ' ') }} MAD</span>
                </div>
                <div style="margin-bottom: 10px; display: flex; justify-content: space-between;">
                    <span>TVA (10%):</span>
                    <span>{{ number_format($tax, 2, ',', ' ') }} MAD</span>
                </div>
                <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between;">
                    <span>Livraison:</span>
                    <span>{{ number_format($shipping, 2, ',', ' ') }} MAD</span>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 18px; font-weight: bold; margin-bottom: 20px;">
                    <span>Total:</span>
                    <span style="color: #10b981;">{{ number_format($total, 2, ',', ' ') }} MAD</span>
                </div>

                <button type="submit" class="btn-register" style="width:100%; border:none;">Confirmer la commande</button>
                <a href="{{ route('cart.index') }}" class="btn-login" style="display:block; text-align:center; margin-top:10px;">Retour au panier</a>
            </div>
        </form>
    </div>
</div>
@endsection