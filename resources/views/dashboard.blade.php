@extends('layouts.app')

@section('title', 'Mon compte - PharmaCare')

@section('content')
<section style="padding: 64px 0;">
    <div class="container">
        <div style="display:flex; justify-content:space-between; gap:24px; align-items:flex-end; margin-bottom:32px; flex-wrap:wrap;">
            <div>
                <span style="font-size:12px; text-transform:uppercase; letter-spacing:2px; color:var(--muted);">Espace client</span>
                <h1 style="font-family:var(--font-display); font-size:42px; margin-top:8px;">Bonjour {{ auth()->user()->name }}</h1>
                <p style="color:var(--muted); max-width:700px;">Retrouve ici tes commandes, ton activite recente et des raccourcis vers les actions principales.</p>
            </div>
            <div style="display:flex; gap:12px; flex-wrap:wrap;">
                <a href="{{ route('products.index') }}" class="btn-register">Continuer mes achats</a>
                <a href="{{ route('orders.index') }}" class="btn-login">Voir mes commandes</a>
            </div>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:18px; margin-bottom:32px;">
            <div style="background:#fff; border:1px solid var(--rule); border-radius:18px; padding:24px;">
                <div style="color:var(--muted); font-size:13px;">Commandes totales</div>
                <div style="font-size:34px; font-weight:700; margin-top:8px;">{{ $stats['orders_total'] }}</div>
            </div>
            <div style="background:#fff; border:1px solid var(--rule); border-radius:18px; padding:24px;">
                <div style="color:var(--muted); font-size:13px;">Commandes en attente</div>
                <div style="font-size:34px; font-weight:700; margin-top:8px;">{{ $stats['orders_pending'] }}</div>
            </div>
            <div style="background:#fff; border:1px solid var(--rule); border-radius:18px; padding:24px;">
                <div style="color:var(--muted); font-size:13px;">Articles dans le panier</div>
                <div style="font-size:34px; font-weight:700; margin-top:8px;">{{ $stats['cart_items'] }}</div>
            </div>
            <div style="background:#fff; border:1px solid var(--rule); border-radius:18px; padding:24px;">
                <div style="color:var(--muted); font-size:13px;">Montant depense</div>
                <div style="font-size:34px; font-weight:700; margin-top:8px;">{{ number_format($stats['spent_total'], 2, ',', ' ') }} MAD</div>
            </div>
        </div>

        <div style="background:#fff; border:1px solid var(--rule); border-radius:22px; padding:28px;">
            <div style="display:flex; justify-content:space-between; gap:16px; align-items:center; margin-bottom:20px; flex-wrap:wrap;">
                <div>
                    <h2 style="font-family:var(--font-display); font-size:28px;">Mes dernieres commandes</h2>
                    <p style="color:var(--muted);">Un apercu rapide de ton historique recent.</p>
                </div>
                <a href="{{ route('orders.index') }}" class="btn-login">Tout voir</a>
            </div>

            @if($recentOrders->isEmpty())
                <div style="padding:32px; border:1px dashed var(--rule); border-radius:18px; text-align:center;">
                    <p style="margin-bottom:16px; color:var(--muted);">Tu n as pas encore passe de commande.</p>
                    <a href="{{ route('products.index') }}" class="btn-register">Explorer le catalogue</a>
                </div>
            @else
                <div style="display:grid; gap:14px;">
                    @foreach($recentOrders as $order)
                        <div style="border:1px solid var(--rule); border-radius:16px; padding:18px; display:flex; justify-content:space-between; gap:16px; flex-wrap:wrap;">
                            <div>
                                <div style="font-weight:700;">{{ $order->order_number }}</div>
                                <div style="color:var(--muted); font-size:14px;">{{ $order->created_at->format('d/m/Y H:i') }} · {{ $order->items_count }} article(s)</div>
                            </div>
                            <div style="text-align:right;">
                                <div style="font-weight:700;">{{ number_format($order->total_price, 2, ',', ' ') }} MAD</div>
                                <div style="margin-top:8px;">
                                    <span style="display:inline-block; padding:6px 12px; border-radius:999px; background:#f5ece0; color:#7a4c26; font-size:12px; text-transform:uppercase; letter-spacing:1px;">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                                <div style="margin-top:10px;">
                                    <a href="{{ route('orders.show', $order) }}" style="color:var(--sage); font-weight:600; text-decoration:none;">Voir le detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
@endsection