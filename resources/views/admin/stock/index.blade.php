@extends('admin.layouts.app')
@section('title', 'Gestion du stock')

@section('breadcrumbs')
    <div class="crumbs">
        <span class="crumb-eyebrow">Catalogue / Stock</span>
        <h1 class="crumb-title">Gestion du stock</h1>
    </div>
@endsection

@section('content')
    <div style="display:grid; grid-template-columns:repeat(4, minmax(0, 1fr)); gap:16px; margin-bottom:24px;">
        <div style="background:#fff; border:1px solid var(--rule); border-radius:14px; padding:18px;">
            <div style="font-family:var(--font-mono); font-size:10px; text-transform:uppercase; letter-spacing:1.6px; color:var(--muted);">Produits</div>
            <div style="font-family:var(--font-display); font-size:34px; margin-top:10px;">{{ $summary['total_products'] }}</div>
        </div>
        <div style="background:#fff; border:1px solid var(--rule); border-radius:14px; padding:18px;">
            <div style="font-family:var(--font-mono); font-size:10px; text-transform:uppercase; letter-spacing:1.6px; color:var(--muted);">Stock faible</div>
            <div style="font-family:var(--font-display); font-size:34px; margin-top:10px; color:var(--accent);">{{ $summary['low_stock'] }}</div>
        </div>
        <div style="background:#fff; border:1px solid var(--rule); border-radius:14px; padding:18px;">
            <div style="font-family:var(--font-mono); font-size:10px; text-transform:uppercase; letter-spacing:1.6px; color:var(--muted);">Rupture</div>
            <div style="font-family:var(--font-display); font-size:34px; margin-top:10px; color:var(--danger);">{{ $summary['out_of_stock'] }}</div>
        </div>
        <div style="background:#fff; border:1px solid var(--rule); border-radius:14px; padding:18px;">
            <div style="font-family:var(--font-mono); font-size:10px; text-transform:uppercase; letter-spacing:1.6px; color:var(--muted);">Unites</div>
            <div style="font-family:var(--font-display); font-size:34px; margin-top:10px;">{{ number_format($summary['total_units'], 0, ',', ' ') }}</div>
        </div>
    </div>

    <div class="toolbar">
        <form method="GET" action="{{ route('admin.stock.index') }}" class="toolbar-filters">
            <div class="field-inline">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round">
                    <circle cx="11" cy="11" r="7" />
                    <path d="m20 20-3.5-3.5" />
                </svg>
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Nom, SKU ou description...">
            </div>

            <select name="category" class="field-select">
                <option value="">Toutes categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('category') == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>

            <select name="filter" class="field-select">
                <option value="">Tous les niveaux</option>
                <option value="available" @selected(request('filter') === 'available')>Disponible</option>
                <option value="low" @selected(request('filter') === 'low')>Stock faible</option>
                <option value="out" @selected(request('filter') === 'out')>Rupture</option>
            </select>

            <button type="submit" class="btn-secondary-sm">Filtrer</button>
            @if(request()->hasAny(['q', 'category', 'filter']))
                <a href="{{ route('admin.stock.index') }}" class="btn-ghost-sm">Reinitialiser</a>
            @endif
        </form>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <a href="{{ route('admin.products.index') }}" class="btn-secondary-sm">Voir les produits</a>
            <a href="{{ route('admin.products.create') }}" class="btn-primary-sm">Ajouter un produit</a>
        </div>
    </div>

    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th style="width:72px">Image</th>
                    <th>Produit</th>
                    <th>Categorie</th>
                    <th class="num">Stock</th>
                    <th>Etat</th>
                    <th>Maj rapide</th>
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
                            <div class="cell-sub">{{ $product->sku ?? 'N/R' }}</div>
                        </td>
                        <td><span class="tag">{{ $product->category->name ?? 'Sans categorie' }}</span></td>
                        <td class="num mono">{{ $product->stock }}</td>
                        <td>
                            @if($product->stock === 0)
                                <span class="pill pill-off"><span class="pill-dot"></span>Rupture</span>
                            @elseif($product->stock <= 10)
                                <span class="pill" style="background:var(--accent-soft); color:var(--accent); border-color:rgba(184, 118, 63, 0.2);"><span class="pill-dot" style="background:var(--accent);"></span>Stock faible</span>
                            @else
                                <span class="pill pill-on"><span class="pill-dot"></span>Disponible</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.stock.update', $product) }}" method="POST" style="display:flex; gap:8px; align-items:center; flex-wrap:wrap;">
                                @csrf
                                @method('PATCH')

                                <select name="mode" style="height:38px; padding:0 12px; border:1px solid var(--rule); border-radius:10px; background:#fff;">
                                    <option value="set">Definir</option>
                                    <option value="add">Ajouter</option>
                                    <option value="remove">Retirer</option>
                                </select>

                                <input type="number" min="0" name="quantity" value="{{ $product->stock }}" style="width:94px; height:38px; padding:0 12px; border:1px solid var(--rule); border-radius:10px;">
                                <button type="submit" class="btn-primary-sm" style="height:38px;">Valider</button>
                            </form>
                        </td>
                        <td class="actions-col">
                            <a href="{{ route('admin.products.edit', $product) }}" class="act" title="Editer le produit">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                    <path d="M18.5 2.5a2.1 2.1 0 0 1 3 3L12 15l-4 1 1-4z" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="table-empty">
                                <h3>Aucun produit trouve</h3>
                                <p>Ajoutez un produit pour commencer a gerer votre stock.</p>
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