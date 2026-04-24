@extends('admin.layouts.app')
@section('title', 'Detail commande')

@section('breadcrumbs')
    <div class="crumbs">
        <span class="crumb-eyebrow"><a href="{{ route('admin.orders.index') }}">Commandes</a> / Detail</span>
        <h1 class="crumb-title">{{ $order->order_number }}</h1>
    </div>
@endsection

@section('content')
    <div class="panel-grid">
        <section class="panel">
            <header class="panel-head">
                <div>
                    <span class="eyebrow">Client</span>
                    <h2 class="panel-title">{{ $order->user->name ?? 'Client inconnu' }}</h2>
                </div>
            </header>
            <div class="panel-body">
                <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
                <p><strong>Telephone:</strong> {{ $order->user->phone ?? 'N/A' }}</p>
                <p><strong>Adresse:</strong> {{ $order->shipping_address ?: 'Non renseignee' }}</p>
                <p><strong>Paiement:</strong> {{ str_replace('_', ' ', $order->payment_method ?: 'Non renseigne') }}</p>
            </div>
        </section>

        <section class="panel">
            <header class="panel-head">
                <div>
                    <span class="eyebrow">Suivi</span>
                    <h2 class="panel-title">Statut</h2>
                </div>
            </header>
            <div class="panel-body">
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="field-select" style="width:100%; margin-bottom:12px;">
                        @foreach($statuses as $status)
                            <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn-primary-sm">Mettre a jour</button>
                </form>

                <div style="margin-top:18px;">
                    <p><strong>Total:</strong> {{ number_format($order->total_price, 2, ',', ' ') }} MAD</p>
                    <p><strong>TVA:</strong> {{ number_format($order->tax_amount, 2, ',', ' ') }} MAD</p>
                    <p><strong>Livraison:</strong> {{ number_format($order->shipping_amount, 2, ',', ' ') }} MAD</p>
                </div>
            </div>
        </section>
    </div>

    <section class="panel" style="margin-top:24px;">
        <header class="panel-head">
            <div>
                <span class="eyebrow">Produits</span>
                <h2 class="panel-title">Lignes de commande</h2>
            </div>
        </header>
        <div class="panel-body">
            @foreach($order->items as $item)
                <div class="row-item">
                    <div class="row-main">
                        <div class="row-title">{{ $item->product->name ?? 'Produit supprime' }}</div>
                        <div class="row-meta">Quantite: {{ $item->quantity }} · Prix unitaire: {{ number_format($item->unit_price, 2, ',', ' ') }} MAD</div>
                    </div>
                    <div class="row-price">{{ number_format($item->subtotal, 2, ',', ' ') }} MAD</div>
                </div>
            @endforeach
        </div>
    </section>
@endsection