@extends('layouts.app')

@section('title', $order->order_number . ' - PharmaCare')

@section('content')
<section style="padding:40px 0;">
    <div class="container">
        <div style="display:flex; justify-content:space-between; gap:18px; align-items:flex-start; flex-wrap:wrap; margin-bottom:24px;">
            <div>
                <h1 style="font-size:36px; margin-bottom:8px;">Commande {{ $order->order_number }}</h1>
                <p style="color:#6b7280;">Passee le {{ $order->created_at->format('d/m/Y a H:i') }}</p>
            </div>
            <div>
                <span style="display:inline-block; padding:8px 14px; border-radius:999px; background:{{ $order->status === 'pending' ? '#fef3c7' : ($order->status === 'shipped' ? '#dbeafe' : '#d1fae5') }}; font-size:12px; font-weight:700; text-transform:uppercase;">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

        <div style="display:grid; grid-template-columns:2fr 1fr; gap:24px;">
            <div style="background:white; border:1px solid #e5e7eb; border-radius:16px; padding:24px;">
                <h2 style="font-size:24px; margin-bottom:18px;">Produits</h2>

                <div style="display:grid; gap:16px;">
                    @foreach($order->items as $item)
                        <div style="display:flex; justify-content:space-between; gap:16px; border-bottom:1px solid #f1f5f9; padding-bottom:14px;">
                            <div>
                                <div style="font-weight:700;">{{ $item->product->name ?? 'Produit supprime' }}</div>
                                <div style="color:#6b7280; font-size:14px;">Quantite: {{ $item->quantity }} · Prix unitaire: {{ number_format($item->unit_price, 2, ',', ' ') }} MAD</div>
                            </div>
                            <div style="font-weight:700;">{{ number_format($item->subtotal, 2, ',', ' ') }} MAD</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div style="display:grid; gap:18px;">
                <div style="background:#f9fafb; border-radius:16px; padding:24px;">
                    <h3 style="font-size:20px; margin-bottom:14px;">Resume</h3>
                    <div style="display:flex; justify-content:space-between; margin-bottom:10px;"><span>TVA</span><span>{{ number_format($order->tax_amount, 2, ',', ' ') }} MAD</span></div>
                    <div style="display:flex; justify-content:space-between; margin-bottom:10px;"><span>Livraison</span><span>{{ number_format($order->shipping_amount, 2, ',', ' ') }} MAD</span></div>
                    <div style="display:flex; justify-content:space-between; font-weight:700; font-size:18px; padding-top:10px; border-top:1px solid #e5e7eb;"><span>Total</span><span>{{ number_format($order->total_price, 2, ',', ' ') }} MAD</span></div>
                </div>

                <div style="background:white; border:1px solid #e5e7eb; border-radius:16px; padding:24px;">
                    <h3 style="font-size:20px; margin-bottom:14px;">Livraison et paiement</h3>
                    <p style="margin-bottom:10px;"><strong>Adresse:</strong><br>{{ $order->shipping_address ?: 'Non renseignee' }}</p>
                    <p style="margin-bottom:10px;"><strong>Paiement:</strong> {{ str_replace('_', ' ', $order->payment_method ?: 'Non renseigne') }}</p>
                    <p style="margin-bottom:10px;"><strong>Statut paiement:</strong> {{ ucfirst($order->payment_status) }}</p>
                    @if($order->notes)
                        <p><strong>Notes:</strong><br>{{ $order->notes }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection