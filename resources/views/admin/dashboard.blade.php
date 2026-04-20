@extends('admin.layouts.app')
@section('title', 'Tableau de bord')

@section('breadcrumbs')
    <div class="crumbs">
        <span class="crumb-eyebrow">Vue d'ensemble</span>
        <h1 class="crumb-title">Tableau de bord</h1>
    </div>
@endsection

@section('content')

    {{-- STATS --}}
    <div class="kpi-grid">
        <div class="kpi">
            <div class="kpi-head">
                <span class="kpi-label">Chiffre d'affaires</span>
                <span class="kpi-trend up">+12,4%</span>
            </div>
            <div class="kpi-value">{{ number_format($revenue, 2, ',', ' ') }} <span class="kpi-unit">MAD</span></div>
            <div class="kpi-foot">Depuis le début du mois</div>
        </div>

        <div class="kpi">
            <div class="kpi-head">
                <span class="kpi-label">Commandes</span>
                <span class="kpi-trend up">+8,1%</span>
            </div>
            <div class="kpi-value">{{ number_format($ordersCount, 0, ',', ' ') }}</div>
            <div class="kpi-foot">30 derniers jours</div>
        </div>

        <div class="kpi">
            <div class="kpi-head">
                <span class="kpi-label">Produits actifs</span>
                <span class="kpi-trend neutral">{{ $stats['products_active'] }} / {{ $stats['products_total'] }}</span>
            </div>
            <div class="kpi-value">{{ $stats['products_total'] }}</div>
            <div class="kpi-foot">Catalogue complet</div>
        </div>

        <div class="kpi">
            <div class="kpi-head">
                <span class="kpi-label">Clients</span>
                <span class="kpi-trend up">+{{ $stats['customers_total'] }}</span>
            </div>
            <div class="kpi-value">{{ number_format($stats['customers_total'], 0, ',', ' ') }}</div>
            <div class="kpi-foot">Comptes enregistrés</div>
        </div>
    </div>

    {{-- PANELS --}}
    <div class="panel-grid">

        {{-- Recent Products --}}
        <section class="panel">
            <header class="panel-head">
                <div>
                    <span class="eyebrow">Catalogue</span>
                    <h2 class="panel-title">Produits récents</h2>
                </div>
                <a href="{{ route('admin.products.index') }}" class="btn-ghost-sm">
                    Tout voir
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
                </a>
            </header>
            <div class="panel-body">
                @forelse($recentProducts as $product)
                    <div class="row-item">
                        <div class="row-thumb">
                            @if($product->image_url)
    <img src="{{ asset('storage/'.$product->image_url) }}" alt="{{ $product->name }}">
@else
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="m3 16 5-5 4 4 3-3 6 6"/></svg>
                            @endif
                        </div>
                        <div class="row-main">
                            <div class="row-title">{{ $product->name }}</div>
                            <div class="row-meta">{{ $product->category }} · Stock {{ $product->stock }}</div>
                        </div>
                        <div class="row-price">{{ number_format($product->price, 2, ',', ' ') }} MAD</div>
                        <a href="{{ route('admin.products.edit', $product) }}" class="row-action" aria-label="Éditer">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.1 2.1 0 0 1 3 3L12 15l-4 1 1-4z"/></svg>
                        </a>
                    </div>
                @empty
                    <div class="empty-row">Aucun produit pour l'instant.</div>
                @endforelse
            </div>
        </section>

        {{-- Low stock alerts --}}
        <section class="panel">
            <header class="panel-head">
                <div>
                    <span class="eyebrow warn">Alertes stock</span>
                    <h2 class="panel-title">Stock faible</h2>
                </div>
                <span class="badge-count">{{ $stats['products_low'] }}</span>
            </header>
            <div class="panel-body">
                @forelse($lowStockProducts as $product)
                    <div class="row-item">
                        <div class="stock-bar">
                            <div class="stock-fill" style="width: {{ min(100, ($product->stock / 10) * 100) }}%"></div>
                        </div>
                        <div class="row-main">
                            <div class="row-title">{{ $product->name }}</div>
                            <div class="row-meta mono">Restant · {{ $product->stock }} unités</div>
                        </div>
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn-ghost-sm">Réapprovisionner</a>
                    </div>
                @empty
                    <div class="empty-row">Aucune alerte. Tous les stocks sont bons.</div>
                @endforelse
            </div>
        </section>
    </div>

@endsection