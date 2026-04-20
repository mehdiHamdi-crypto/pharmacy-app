@extends('admin.layouts.app')
@section('title', 'Produits')

@section('breadcrumbs')
    <div class="crumbs">
        <span class="crumb-eyebrow">Catalogue</span>
        <h1 class="crumb-title">Produits</h1>
    </div>
@endsection

@section('content')

    <div class="toolbar">
        <form method="GET" action="{{ route('admin.products.index') }}" class="toolbar-filters">
            <div class="field-inline">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Rechercher un produit ou SKU...">
            </div>

            <select name="category" class="field-select">
                <option value="">Toutes catégories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>

            <select name="status" class="field-select">
                <option value="">Tous les statuts</option>
                <option value="active" @selected(request('status') === 'active')>Actifs</option>
                <option value="inactive" @selected(request('status') === 'inactive')>Inactifs</option>
            </select>

            <button type="submit" class="btn-secondary-sm">Filtrer</button>
            @if(request()->hasAny(['q', 'category', 'status']))
                <a href="{{ route('admin.products.index') }}" class="btn-ghost-sm">Réinitialiser</a>
            @endif
        </form>

        <a href="{{ route('admin.products.create') }}" class="btn-primary-sm">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
            Nouveau produit
        </a>
    </div>

    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th style="width:72px">Image</th>
                    <th>Produit</th>
                    <th>Catégorie</th>
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
                                @if($product->image_url)
                                    <img src="{{ asset('storage/'.$product->image_url) }}" alt="">
                                @else
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="m3 16 5-5 4 4 3-3 6 6"/></svg>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="cell-title">{{ $product->name }}</div>
                            <div class="cell-sub">{{ \Illuminate\Support\Str::limit($product->description, 60) }}</div>
                        </td>
                        <td><span class="tag">{{ $product->category->name ?? '—' }}</span></td>
                        <td class="mono">{{ $product->sku ?? '—' }}</td>
                        <td class="num mono">
                            @if($product->discount_price)
                                <span style="text-decoration: line-through; color: var(--muted); font-size: 11px;">
                                    {{ number_format($product->price, 2, ',', ' ') }}
                                </span><br>
                                <strong style="color: var(--accent);">{{ number_format($product->discount_price, 2, ',', ' ') }} MAD</strong>
                            @else
                                {{ number_format($product->price, 2, ',', ' ') }} MAD
                            @endif
                        </td>
                        <td class="num mono">
                            <span class="{{ $product->stock <= 10 ? 'stock-low' : '' }}">{{ $product->stock }}</span>
                        </td>
                        <td>
                            <form action="{{ route('admin.products.toggle', $product) }}" method="POST" class="inline-form">
                                @csrf @method('PATCH')
                                <button type="submit" class="pill {{ $product->is_active ? 'pill-on' : 'pill-off' }}">
                                    <span class="pill-dot"></span>
                                    {{ $product->is_active ? 'Actif' : 'Inactif' }}
                                </button>
                            </form>
                        </td>
                        <td class="actions-col">
                            <a href="{{ route('admin.products.edit', $product) }}" class="act" title="Éditer">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.1 2.1 0 0 1 3 3L12 15l-4 1 1-4z"/></svg>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-form" onsubmit="return confirm('Supprimer ce produit ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="act act-danger" title="Supprimer">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            <div class="table-empty">
                                <h3>Aucun produit trouvé</h3>
                                <p>Commencez par ajouter votre premier produit au catalogue.</p>
                                <a href="{{ route('admin.products.create') }}" class="btn-primary-sm">Créer un produit</a>
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