@extends('admin.layouts.app')
@section('title', 'Tableau de bord')

@section('breadcrumbs')
    <div class="crumbs">
        <span class="crumb-eyebrow">Administration</span>
        <h1 class="crumb-title">Tableau de bord</h1>
    </div>
@endsection

@section('content')
    <div class="kpi-grid">
        <div class="kpi">
            <div class="kpi-head">
                <span class="kpi-label">Chiffre daffaires</span>
                <span class="kpi-trend up">{{ $ordersCount }} commandes</span>
            </div>
            <div class="kpi-value">{{ number_format($revenue, 2, ',', ' ') }} <span class="kpi-unit">MAD</span></div>
            <div class="kpi-foot">Total cumule des commandes</div>
        </div>

        <div class="kpi">
            <div class="kpi-head">
                <span class="kpi-label">Stock total</span>
                <span class="kpi-trend neutral">{{ $stats['products_total'] }} produits</span>
            </div>
            <div class="kpi-value">{{ number_format($stats['stock_units'], 0, ',', ' ') }}</div>
            <div class="kpi-foot">Unites disponibles en stock</div>
        </div>

        <div class="kpi">
            <div class="kpi-head">
                <span class="kpi-label">Alertes stock</span>
                <span class="kpi-trend neutral">{{ $stats['products_out'] }} rupture</span>
            </div>
            <div class="kpi-value">{{ $stats['products_low'] }}</div>
            <div class="kpi-foot">Produits avec stock faible</div>
        </div>

        <div class="kpi">
            <div class="kpi-head">
                <span class="kpi-label">Clients</span>
                <span class="kpi-trend up">{{ $stats['categories_total'] }} categories</span>
            </div>
            <div class="kpi-value">{{ number_format($stats['customers_total'], 0, ',', ' ') }}</div>
            <div class="kpi-foot">Comptes clients enregistres</div>
        </div>
    </div>

    <div style="display:flex; gap:12px; flex-wrap:wrap; margin-bottom:24px;">
        <a href="{{ route('admin.products.create') }}" class="btn-primary-sm">Ajouter un produit</a>
        <a href="{{ route('admin.stock.index') }}" class="btn-secondary-sm">Gerer le stock</a>
        <a href="{{ route('admin.orders.index') }}" class="btn-ghost-sm">Voir les commandes</a>
    </div>

    <div class="panel-grid" style="margin-bottom:24px;">
        <section class="panel">
            <header class="panel-head">
                <div>
                    <span class="eyebrow">Catalogue</span>
                    <h2 class="panel-title">Produits recents</h2>
                </div>
                <a href="{{ route('admin.products.index') }}" class="btn-ghost-sm">Tout voir</a>
            </header>
            <div class="panel-body">
                @forelse($recentProducts as $product)
                    <div class="row-item">
                        <div class="row-thumb">
                            <img src="{{ $product->imageSrc() }}" alt="{{ $product->name }}">
                        </div>
                        <div class="row-main">
                            <div class="row-title">{{ $product->name }}</div>
                            <div class="row-meta">{{ $product->category->name ?? 'Sans categorie' }} · Stock {{ $product->stock }}</div>
                        </div>
                        <div class="row-price">{{ number_format($product->final_price, 2, ',', ' ') }} MAD</div>
                        <a href="{{ route('admin.products.edit', $product) }}" class="row-action" aria-label="Editer">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                <path d="M18.5 2.5a2.1 2.1 0 0 1 3 3L12 15l-4 1 1-4z" />
                            </svg>
                        </a>
                    </div>
                @empty
                    <div class="empty-row">Aucun produit disponible.</div>
                @endforelse
            </div>
        </section>

        <section class="panel">
            <header class="panel-head">
                <div>
                    <span class="eyebrow warn">Stock</span>
                    <h2 class="panel-title">Alertes de stock</h2>
                </div>
                <span class="badge-count">{{ $stats['products_low'] + $stats['products_out'] }}</span>
            </header>
            <div class="panel-body">
                @forelse($lowStockProducts as $product)
                    <div class="row-item">
                        <div class="stock-bar">
                            <div class="stock-fill" style="width: {{ min(100, max(6, $product->stock * 10)) }}%"></div>
                        </div>
                        <div class="row-main">
                            <div class="row-title">{{ $product->name }}</div>
                            <div class="row-meta mono">
                                @if($product->stock === 0)
                                    Rupture de stock
                                @else
                                    Reste {{ $product->stock }} unite(s)
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('admin.stock.index', ['q' => $product->name]) }}" class="btn-ghost-sm">Mettre a jour</a>
                    </div>
                @empty
                    <div class="empty-row">Aucune alerte stock pour le moment.</div>
                @endforelse
            </div>
        </section>
    </div>

    <section class="data-table">
        <table>
            <thead>
                <tr>
                    <th>Commande</th>
                    <th>Client</th>
                    <th>Articles</th>
                    <th class="num">Montant</th>
                    <th>Statut</th>
                    <th class="actions-col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                    <tr>
                        <td>
                            <div class="cell-title">{{ $order->order_number }}</div>
                            <div class="cell-sub">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                        </td>
                        <td>
                            <div class="cell-title">{{ $order->user->name ?? 'Client supprime' }}</div>
                            <div class="cell-sub">{{ $order->user->email ?? 'N/A' }}</div>
                        </td>
                        <td>{{ $order->items_count }}</td>
                        <td class="num mono">{{ number_format($order->total_price, 2, ',', ' ') }} MAD</td>
                        <td>
                            <span class="pill {{ $order->status === 'pending' ? 'pill-off' : 'pill-on' }}">
                                <span class="pill-dot"></span>
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="actions-col">
                            <a href="{{ route('admin.orders.show', $order) }}" class="act" title="Voir">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="table-empty">
                                <h3>Aucune commande recente</h3>
                                <p>Les nouvelles commandes apparaitront ici.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection