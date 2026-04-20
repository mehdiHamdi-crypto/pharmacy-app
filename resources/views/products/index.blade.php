@extends('layouts.app')

@section('title', 'Catalogue — PharmaCare')

@section('content')
<section class="products" style="padding: 80px 0;">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Catalogue complet</span>
            <h2 class="section-title">Nos <em>produits</em></h2>
            <p class="section-subtitle">Découvrez l'ensemble de notre sélection pharmaceutique.</p>
        </div>

        <div class="products-grid">
            @forelse($products as $product)
                <article class="product-card">
                    <div class="product-image">
                        @if($product->image_url)
                            <img src="{{ asset('storage/'.$product->image_url) }}" alt="{{ $product->name }}">
                        @endif
                    </div>
                    <span class="product-category">{{ $product->category->name ?? 'Général' }}</span>
                    <h3 class="product-name">{{ $product->name }}</h3>
                    <p class="product-desc">{{ \Illuminate\Support\Str::limit($product->description, 80) }}</p>
                    <div class="product-price">
                        @if($product->discount_price)
                            {{ number_format($product->discount_price, 2, ',', ' ') }}<span class="currency">MAD</span>
                        @else
                            {{ number_format($product->price, 2, ',', ' ') }}<span class="currency">MAD</span>
                        @endif
                    </div>
                    <div class="product-actions">
                        <a href="#" class="btn btn-primary btn-sm btn-full">Ajouter au panier</a>
                    </div>
                </article>
            @empty
                <p style="grid-column: 1/-1; text-align:center; color: var(--muted); padding: 60px 0;">
                    Aucun produit disponible pour l'instant.
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