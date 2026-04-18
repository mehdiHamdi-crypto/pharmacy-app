@extends('layouts.app')

@section('title', 'Mes Commandes - PharmaCare')

@section('content')

<div style="padding: 40px 0;">
    <div class="container">
        <h1 style="font-size: 36px; margin-bottom: 30px;">Mes Commandes</h1>

        @if($orders->isEmpty())
            <div style="text-align: center; padding: 60px 20px; background: #f9fafb; border-radius: 12px;">
                <p style="font-size: 18px; color: #6b7280; margin-bottom: 20px;">Aucune commande 📦</p>
                <a href="{{ route('products.index') }}" style="display: inline-block; padding: 12px 30px; background: #10b981; color: white; border-radius: 8px; text-decoration: none; font-weight: 600;">
                    Commencer à acheter
                </a>
            </div>
        @else
            <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 12px; overflow: hidden;">
                <thead>
                    <tr style="background: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                        <th style="padding: 15px; text-align: left; font-weight: bold;">Commande</th>
                        <th style="padding: 15px; text-align: left; font-weight: bold;">Date</th>
                        <th style="padding: 15px; text-align: left; font-weight: bold;">Articles</th>
                        <th style="padding: 15px; text-align: left; font-weight: bold;">Montant</th>
                        <th style="padding: 15px; text-align: left; font-weight: bold;">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 15px;"><strong>{{ $order->order_number }}</strong></td>
                            <td style="padding: 15px;">{{ $order->created_at->format('d/m/Y') }}</td>
                            <td style="padding: 15px;">{{ $order->items->count() }} article(s)</td>
                            <td style="padding: 15px; font-weight: bold;">{{ number_format($order->total_price, 2) }} DH</td>
                            <td style="padding: 15px;">
                                <span style="padding: 6px 12px; background: {{ $order->status == 'pending' ? '#fef3c7' : '#d1fae5' }}; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $orders->links() }}
        @endif
    </div>
</div>

@endsection