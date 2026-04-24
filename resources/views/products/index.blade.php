@extends('layouts.app')

@section('title', 'Catalogue - PharmaCare')

@section('content')
<section class="products" style="padding: 80px 0;">
    <div class="container">
        <div class="section-head" style="margin-bottom:32px;">
            <span class="eyebrow">Catalogue complet</span>
            <h2 class="section-title">Nos <em>produits</em></h2>
            <p class="section-subtitle">Recherche, filtre par categorie et intervalle de prix pour trouver plus vite le bon produit.</p>
        </div>

        <form method="GET" action="{{ route('products.index') }}" style="display:grid; grid-template-columns:2fr 1fr 1fr 1fr auto; gap:12px; margin-bottom:30px; background:#fff; border:1px solid var(--rule); border-radius:20px; padding:18px;">
            <input type="search" name="q" value="{{ request('q') }}" placeholder="Nom, description ou SKU..." style="padding:12px 14px; border:1px solid var(--rule); border-radius:12px;">
            <select name="category" style="padding:12px 14px; border:1px solid var(--rule); border-radius:12px;">
                <option value="">Toutes categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('category') == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            <input type="number" step="0.01" min="0" name="min_price" value="{{ request('min_price') }}" placeholder="Prix min" style="padding:12px 14px; border:1px solid var(--rule); border-radius:12px;">
            <input type="number" step="0.01" min="0" name="max_price" value="{{ request('max_price') }}" placeholder="Prix max" style="padding:12px 14px; border:1px solid var(--rule); border-radius:12px;">
            <button type="submit" class="btn-register" style="border:none;">Filtrer</button>
        </form>

        <div class="products-grid">
            @forelse($products as $product)
                <article class="product-card">
                    <div class="product-image" style="display:flex; align-items:center; justify-content:center; min-height:260px; overflow:hidden;">
                        <img
                            src="{{ $product->imageSrc() }}"
                            alt="{{ $product->name }}"
                            style="width:100%; height:260px; object-fit:cover;"
                            onerror="this.onerror=null;this.src='{{ $product->defaultImageUrl() }}';"
                        >
                    </div>

                    <span class="product-category">{{ $product->category->name ?? 'General' }}</span>
                    <h3 class="product-name">{{ $product->name }}</h3>
                    <p class="product-desc">{{ \Illuminate\Support\Str::limit($product->description, 90) }}</p>

                    <div class="product-price">
                        @if($product->discount_price)
                            <span style="text-decoration:line-through; color:var(--muted); font-size:14px;">{{ number_format($product->price, 2, ',', ' ') }} MAD</span><br>
                        @endif
                        {{ number_format($product->final_price, 2, ',', ' ') }}<span class="currency">MAD</span>
                    </div>

                    <div class="product-actions" style="display:grid; gap:10px;">
                        <a href="{{ route('products.show', $product) }}" class="btn btn-login btn-full">Voir la fiche</a>

                        @auth
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm btn-full" style="width:100%; border:none;">Ajouter au panier</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-sm btn-full">Se connecter pour acheter</a>
                        @endauth
                    </div>
                </article>
            @empty
                <p style="grid-column: 1/-1; text-align:center; color: var(--muted); padding: 60px 0;">
                    Aucun produit ne correspond a tes filtres.
                </p>
            @endforelse
        </div>

        @if($products->hasPages())
            <div style="margin-top: 48px; display: flex; justify-content: center;">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
