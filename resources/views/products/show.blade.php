@extends('layouts.app')

@section('title', $product->name . ' - PharmaCare')

@section('content')
<section style="padding:80px 0;">
    <div class="container">
        <div style="display:grid; grid-template-columns:1.1fr 1fr; gap:36px; align-items:start;">
            <div style="background:#fff; border:1px solid var(--rule); border-radius:24px; padding:28px; min-height:420px; display:flex; align-items:center; justify-content:center; overflow:hidden;">
                <img
                    src="{{ $product->imageSrc() }}"
                    alt="{{ $product->name }}"
                    style="max-width:100%; width:100%; max-height:420px; height:420px; object-fit:cover; border-radius:18px;"
                    onerror="this.onerror=null;this.src='{{ $product->defaultImageUrl() }}';"
                >
            </div>

            <div>
                <span style="display:inline-block; padding:8px 14px; border-radius:999px; background:var(--sage-light); color:var(--sage-dark); font-size:12px; letter-spacing:1px; text-transform:uppercase;">{{ $product->category->name ?? 'General' }}</span>
                <h1 style="font-family:var(--font-display); font-size:48px; line-height:1.05; margin:18px 0 16px;">{{ $product->name }}</h1>
                <p style="font-size:16px; color:var(--muted); margin-bottom:18px;">{{ $product->description ?: 'Description a venir.' }}</p>

                <div style="display:flex; gap:16px; align-items:flex-end; margin-bottom:18px;">
                    <div style="font-size:34px; font-weight:700; color:var(--sage-dark);">{{ number_format($product->final_price, 2, ',', ' ') }} MAD</div>
                    @if($product->discount_price)
                        <div style="text-decoration:line-through; color:var(--muted); padding-bottom:5px;">{{ number_format($product->price, 2, ',', ' ') }} MAD</div>
                    @endif
                </div>

                <div style="display:grid; grid-template-columns:repeat(2, minmax(0, 1fr)); gap:14px; margin-bottom:24px;">
                    <div style="background:#fff; border:1px solid var(--rule); border-radius:16px; padding:16px;">
                        <div style="font-size:12px; color:var(--muted); text-transform:uppercase; letter-spacing:1px;">SKU</div>
                        <div style="font-weight:700; margin-top:6px;">{{ $product->sku ?: 'Non renseigne' }}</div>
                    </div>
                    <div style="background:#fff; border:1px solid var(--rule); border-radius:16px; padding:16px;">
                        <div style="font-size:12px; color:var(--muted); text-transform:uppercase; letter-spacing:1px;">Stock</div>
                        <div style="font-weight:700; margin-top:6px;">{{ $product->stock }} unite(s)</div>
                    </div>
                </div>

                @auth
                    <form action="{{ route('cart.add', $product) }}" method="POST" style="display:flex; gap:12px; flex-wrap:wrap; align-items:center;">
                        @csrf
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" style="width:110px; padding:12px 14px; border:1px solid var(--rule); border-radius:12px;">
                        <button type="submit" class="btn-register" style="border:none;">Ajouter au panier</button>
                        <a href="{{ route('products.index') }}" class="btn-login">Retour au catalogue</a>
                    </form>
                @else
                    <div style="display:flex; gap:12px; flex-wrap:wrap;">
                        <a href="{{ route('login') }}" class="btn-register">Se connecter pour acheter</a>
                        <a href="{{ route('products.index') }}" class="btn-login">Retour au catalogue</a>
                    </div>
                @endauth
            </div>
        </div>

        @if($relatedProducts->isNotEmpty())
            <div style="margin-top:60px;">
                <div class="section-head" style="margin-bottom:24px;">
                    <span class="eyebrow">Selection</span>
                    <h2 class="section-title">Produits <em>similaires</em></h2>
                </div>

                <div class="products-grid">
                    @foreach($relatedProducts as $relatedProduct)
                        <article class="product-card">
                            <div class="product-image" style="display:flex; align-items:center; justify-content:center; min-height:260px; overflow:hidden;">
                                <img
                                    src="{{ $relatedProduct->imageSrc() }}"
                                    alt="{{ $relatedProduct->name }}"
                                    style="width:100%; height:260px; object-fit:cover;"
                                    onerror="this.onerror=null;this.src='{{ $relatedProduct->defaultImageUrl() }}';"
                                >
                            </div>
                            <span class="product-category">{{ $relatedProduct->category->name ?? 'General' }}</span>
                            <h3 class="product-name">{{ $relatedProduct->name }}</h3>
                            <div class="product-price">{{ number_format($relatedProduct->final_price, 2, ',', ' ') }}<span class="currency">MAD</span></div>
                            <div class="product-actions">
                                <a href="{{ route('products.show', $relatedProduct) }}" class="btn btn-primary btn-sm btn-full">Voir la fiche</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
