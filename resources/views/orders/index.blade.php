@extends('layouts.app')

@section('title', 'Mes commandes - PharmaCare')

@section('content')
<div style="padding: 40px 0;">
    <div class="container">
        <h1 style="font-size: 36px; margin-bottom: 30px;">Mes commandes</h1>

        @if($orders->isEmpty())
            <div style="text-align: center; padding: 60px 20px; background: #f9fafb; border-radius: 12px;">
                <p style="font-size: 18px; color: #6b7280; margin-bottom: 20px;">Aucune commande pour le moment.</p>
                <a href="{{ route('products.index') }}" class="btn-register">Commencer a acheter</a>
            </div>
        @else
            <div style="display:grid; gap:16px;">
                @foreach($orders as $order)
                    <div style="background:white; border:1px solid #e5e7eb; border-radius:16px; padding:20px; display:flex; justify-content:space-between; gap:18px; flex-wrap:wrap;">
                        <div>
                            <div style="font-weight:700; font-size:18px;">{{ $order->order_number }}</div>
                            <div style="color:#6b7280; margin-top:6px;">{{ $order->created_at->format('d/m/Y H:i') }} · {{ $order->items_count }} article(s)</div>
                        </div>
                        <div style="text-align:right;">
                            <div style="font-weight:700;">{{ number_format($order->total_price, 2, ',', ' ') }} MAD</div>
                            <div style="margin-top:8px;">
                                <span style="padding:6px 12px; background:{{ $order->status === 'pending' ? '#fef3c7' : ($order->status === 'shipped' ? '#dbeafe' : '#d1fae5') }}; border-radius:20px; font-size:12px; font-weight:600;">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                            <div style="margin-top:10px;">
                                <a href="{{ route('orders.show', $order) }}" style="color:#10b981; font-weight:600; text-decoration:none;">Voir le detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="margin-top:24px;">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
@endsection