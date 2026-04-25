@extends('admin.layouts.app')
@section('title', 'Produits')

@section('breadcrumbs')
    <div class="crumbs">
        <span class="crumb-eyebrow">Catalogue</span>
        <h1 class="crumb-title">Produits</h1>
    </div>
@endsection

@section('content')
    <div style="display:grid; grid-template-columns:repeat(5, minmax(0, 1fr)); gap:16px; margin-bottom:24px;">
        <div style="background:#fff; border:1px solid var(--rule); border-radius:14px; padding:18px;">
            <div style="font-family:var(--font-mono); font-size:10px; text-transform:uppercase; letter-spacing:1.6px; color:var(--muted);">Produits</div>
            <div style="font-family:var(--font-display); font-size:34px; margin-top:10px;">{{ $stockStats['total_products'] }}</div>
        </div>
        <div style="background:#fff; border:1px solid var(--rule); border-radius:14px; padding:18px;">
            <div style="font-family:var(--font-mono); font-size:10px; text-transform:uppercase; letter-spacing:1.6px; color:var(--muted);">Actifs</div>
            <div style="font-family:var(--font-display); font-size:34px; margin-top:10px;">{{ $stockStats['active_products'] }}</div>
        </div>
        <div style="background:#fff; border:1px solid var(--rule); border-radius:14px; padding:18px;">
            <div style="font-family:var(--font-mono); font-size:10px; text-transform:uppercase; letter-spacing:1.6px; color:var(--muted);">Stock faible</div>
            <div style="font-family:var(--font-display); font-size:34px; margin-top:10px; color:var(--accent);">{{ $stockStats['low_stock'] }}</div>
        </div>
        <div style="background:#fff; border:1px solid var(--rule); border-radius:14px; padding:18px;">
            <div style="font-family:var(--font-mono); font-size:10px; text-transform:uppercase; letter-spacing:1.6px; color:var(--muted);">Rupture</div>
            <div style="font-family:var(--font-display); font-size:34px; margin-top:10px; color:var(--danger);">{{ $stockStats['out_of_stock'] }}</div>
        </div>
        <div style="background:#fff; border:1px solid var(--rule); border-radius:14px; padding:18px;">
            <div style="font-family:var(--font-mono); font-size:10px; text-transform:uppercase; letter-spacing:1.6px; color:var(--muted);">Unites</div>
            <div style="font-family:var(--font-display); font-size:34px; margin-top:10px;">{{ number_format($stockStats['total_units'], 0, ',', ' ') }}</div>
        </div>
    </div>

    <div class="toolbar">
        <form method="GET" action="{{ route('admin.products.index') }}" class="toolbar-filters">
            <div class="field-inline">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round">
                    <circle cx="11" cy="11" r="7" />
                    <path d="m20 20-3.5-3.5" />
                </svg>
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Rechercher un produit ou SKU...">
            </div>

            <select name="category" class="field-select">
                <option value="">Toutes categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>

            <select name="status" class="field-select">
                <option value="">Tous les statuts</option>
                <option value="active" @selected(request('status') === 'active')>Actifs</option>
                <option value="inactive" @selected(request('status') === 'inactive')>Inactifs</option>
                <option value="low" @selected(request('status') === 'low')>Stock faible</option>
                <option value="out" @selected(request('status') === 'out')>Rupture</option>
            </select>

            <button type="submit" class="btn-secondary-sm">Filtrer</button>
            @if(request()->hasAny(['q', 'category', 'status']))
                <a href="{{ route('admin.products.index') }}" class="btn-ghost-sm">Reinitialiser</a>
            @endif
        </form>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <a href="{{ route('admin.stock.index') }}" class="btn-secondary-sm">Gestion du stock</a>
            <a href="{{ route('admin.products.create') }}" class="btn-primary-sm">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                    <path d="M12 5v14M5 12h14" />
                </svg>
                Nouveau produit
            </a>
        </div>
    </div>

    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th style="width:72px">Image</th>
                    <th>Produit</th>
                    <th>Categorie</th>
                    <th>SKU</th>
                    <th class="num">Prix</th>
                    <th class="num">Stock</th>
                    <th>Statut</th>
                    <th class="actions-col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>
                            <div class="cell-thumb">
                                <img src="{{ $product->imageSrc() }}" alt="{{ $product->name }}">
                            </div>
                        </td>
                        <td>
                            <div class="cell-title">{{ $product->name }}</div>
                            <div class="cell-sub">{{ \Illuminate\Support\Str::limit($product->description, 70) }}</div>
                        </td>
                        <td><span class="tag">{{ $product->category->name ?? 'Sans categorie' }}</span></td>
                        <td class="mono">{{ $product->sku ?? 'N/R' }}</td>
                        <td class="num mono">
                            @if($product->discount_price)
                                <span style="text-decoration:line-through; color:var(--muted); font-size:11px;">{{ number_format($product->price, 2, ',', ' ') }}</span><br>
                                <strong style="color:var(--accent);">{{ number_format($product->discount_price, 2, ',', ' ') }} MAD</strong>
                            @else
                                {{ number_format($product->price, 2, ',', ' ') }} MAD
                            @endif
                        </td>
                        <td class="num mono">
                            @if($product->stock === 0)
                                <span class="stock-low">0</span>
                            @elseif($product->stock <= 10)
                                <span style="color:var(--accent); font-weight:600;">{{ $product->stock }}</span>
                            @else
                                <span>{{ $product->stock }}</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.products.toggle', $product) }}" method="POST" class="inline-form">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="pill {{ $product->is_active ? 'pill-on' : 'pill-off' }}">
                                    <span class="pill-dot"></span>
                                    {{ $product->is_active ? 'Actif' : 'Inactif' }}
                                </button>
                            </form>
                        </td>
                        <td class="actions-col">
                            <a href="{{ route('admin.stock.index', ['q' => $product->name]) }}" class="act" title="Stock">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 7H4M20 12H4M20 17H4" />
                                    <circle cx="8" cy="7" r="1.5" />
                                    <circle cx="16" cy="12" r="1.5" />
                                    <circle cx="10" cy="17" r="1.5" />
                                </svg>
                            </a>
                            <a href="{{ route('admin.products.edit', $product) }}" class="act" title="Editer">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                    <path d="M18.5 2.5a2.1 2.1 0 0 1 3 3L12 15l-4 1 1-4z" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-form" onsubmit="return confirm('Supprimer ce produit ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="act act-danger" title="Supprimer">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            <div class="table-empty">
                                <h3>Aucun produit trouve</h3>
                                <p>Commencez par ajouter votre premier produit au catalogue.</p>
                                <a href="{{ route('admin.products.create') }}" class="btn-primary-sm">Creer un produit</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($products->hasPages())
            <div class="table-foot">{{ $products->links() }}</div>
        @endif
    </div>
@endsection