@extends('layouts.app')

@section('title', 'Produits - PharmaCare')

@section('content')

<style>
    .products-container {
        padding: 40px 0;
        background: linear-gradient(135deg, #d1fae5 0%, #fff 100%);
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .product-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .product-card:hover {
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        transform: translateY(-5px);
    }

    .product-image {
        width: 100%;
        height: 200px;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
    }

    .product-info {
        padding: 20px;
    }

    .product-name {
        font-size: 18px;
        margin-bottom: 8px;
        color: #1f2937;
        font-weight: bold;
    }

    .product-desc {
        color: #6b7280;
        font-size: 14px;
        margin-bottom: 12px;
    }

    .product-price {
        margin-bottom: 15px;
    }

    .price-current {
        font-size: 20px;
        font-weight: bold;
        color: #10b981;
    }

    .price-old {
        font-size: 12px;
        color: #ef4444;
        text-decoration: line-through;
        margin-right: 8px;
    }

    .stock-info {
        font-size: 14px;
        margin-bottom: 15px;
    }

    .stock-available {
        color: #10b981;
    }

    .stock-unavailable {
        color: #ef4444;
    }

    .product-buttons {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .btn-view {
        padding: 10px;
        background: white;
        color: #10b981;
        border: 2px solid #10b981;
        border-radius: 6px;
        text-align: center;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-add {
        padding: 10px;
        background: #10b981;
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-add:hover {
        background: #059669;
    }

    .btn-add:disabled {
        background: #ccc;
        cursor: not-allowed;
    }

    .filters {
        display: flex;
        gap: 10px;
        margin-bottom: 30px;
        overflow-x: auto;
        padding-bottom: 10px;
    }

    .filter-btn {
        padding: 10px 20px;
        background: #f0f0f0;
        color: #333;
        border: none;
        border-radius: 20px;
        text-decoration: none;
        font-weight: 600;
        white-space: nowrap;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .filter-btn.active {
        background: #10b981;
        color: white;
    }

    .filter-btn:hover {
        background: #10b981;
        color: white;
    }

    .alert {
        padding: 15px 20px;
        background: #d1fae5;
        color: #065f46;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid #a7f3d0;
    }
</style>

<div class="products-container">
    <div class="container">
        <h1 style="font-size: 36px; margin-bottom: 40px; color: #1f2937;">Nos Produits</h1>

        @if(session('success'))
            <div class="alert">
                ✓ {{ session('success') }}
            </div>
        @endif

        <!-- Filtres Catégories -->
        <div class="filters">
            <a href="{{ route('products.index') }}" 
               class="filter-btn {{ !isset($category) ? 'active' : '' }}">
                Tous les Produits
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('products.by-category', $cat) }}" 
                   class="filter-btn {{ isset($category) && $category->id == $cat->id ? 'active' : '' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>

        <!-- Grille Produits -->
        @if($products->isEmpty())
            <div style="text-align: center; padding: 60px 20px; background: #f9fafb; border-radius: 12px;">
                <p style="font-size: 18px; color: #6b7280;">Aucun produit disponible.</p>
            </div>
        @else
            <div class="products-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        <div class="product-image">
                            @php
                                $icon = match($product->category->name) {
                                    'Médicaments' => '💊',
                                    'Beauté & Hygiene' => '🧴',
                                    'Compléments' => '🍃',
                                    'Bébé & Maman' => '👶',
                                    'Équipements' => '⚙️',
                                    'Premiers Secours' => '🩹',
                                    default => '📦'
                                };
                            @endphp
                            {{ $icon }}
                        </div>

                        <div class="product-info">
                            <p class="product-name">{{ $product->name }}</p>
                            <p class="product-desc">{{ Str::limit($product->description, 50) }}</p>

                            <div class="product-price">
                                @if($product->discount_price)
                                    <span class="price-old">{{ number_format($product->price, 2) }} DH</span>
                                    <span class="price-current">{{ number_format($product->discount_price, 2) }} DH</span>
                                @else
                                    <span class="price-current">{{ number_format($product->price, 2) }} DH</span>
                                @endif
                            </div>

                            <p class="stock-info">
                                @if($product->stock > 0)
                                    <span class="stock-available">✓ En stock ({{ $product->stock }})</span>
                                @else
                                    <span class="stock-unavailable">✗ Rupture de stock</span>
                                @endif
                            </p>

                            <div class="product-buttons">
                                <a href="{{ route('products.show', $product) }}" class="btn-view">
                                    Voir
                                </a>
                                @if($product->stock > 0 && Auth::check())
                                    <form action="{{ route('cart.add', $product) }}" method="POST" style="flex: 1;">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn-add" style="width: 100%;">
                                            🛒 Ajouter
                                        </button>
                                    </form>
                                @elseif($product->stock > 0)
                                    <a href="{{ route('login') }}" class="btn-add" style="text-align: center; display: flex; align-items: center; justify-content: center;">
                                        🛒 Ajouter
                                    </a>
                                @else
                                    <button disabled class="btn-add" style="background: #ccc; cursor: not-allowed; color: #999;">
                                        Indisponible
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div style="margin-top: 40px;">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>

@endsection