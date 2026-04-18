@extends('layouts.app')

@section('title', $product->name . ' - PharmaCare')

@section('content')

<div style="padding: 40px 0;">
    <div class="container">
        <a href="{{ route('products.index') }}" style="color: #10b981; text-decoration: none; margin-bottom: 20px;">← Retour aux produits</a>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; background: white; padding: 30px; border-radius: 12px;">
            
            <!-- Image -->
            <div style="background: #f0f0f0; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 120px;">
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

            <!-- Info -->
            <div>
                <p style="color: #10b981; font-weight: bold; margin-bottom: 10px;">{{ $product->category->name }}</p>
                <h1 style="font-size: 32px; margin-bottom: 15px;">{{ $product->name }}</h1>
                <p style="color: #6b7280; line-height: 1.7; margin-bottom: 20px;">{{ $product->description }}</p>

                <!-- Prix -->
                <div style="margin-bottom: 20px;">
                    @if($product->discount_price)
                        <p style="font-size: 14px; color: #ef4444; text-decoration: line-through;">{{ number_format($product->price, 2) }} DH</p>
                        <p style="font-size: 36px; font-weight: bold; color: #10b981;">{{ number_format($product->discount_price, 2) }} DH</p>
                    @else
                        <p style="font-size: 36px; font-weight: bold; color: #10b981;">{{ number_format($product->price, 2) }} DH</p>
                    @endif
                </div>

                <!-- Stock -->
                <p style="margin-bottom: 25px; font-size: 16px;">
                    @if($product->stock > 0)
                        <span style="color: #10b981;">✓ En stock - {{ $product->stock }} unités disponibles</span>
                    @else
                        <span style="color: #ef4444;">✗ Rupture de stock</span>
                    @endif
                </p>

                <!-- Ajouter au panier -->
                @if($product->stock > 0 && Auth::check())
                    <form action="{{ route('cart.add', $product) }}" method="POST" style="margin-bottom: 20px;">
                        @csrf
                        <div style="display: flex; gap: 15px; margin-bottom: 20px;">
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" style="width: 80px; padding: 10px; border: 1px solid #e5e7eb; border-radius: 6px; font-size: 16px;">
                            <button type="submit" style="flex: 1; padding: 12px; background: #10b981; color: white; border: none; border-radius: 8px; font-weight: 600; font-size: 16px; cursor: pointer;">
                                🛒 Ajouter au Panier
                            </button>
                        </div>
                    </form>
                @elseif($product->stock > 0)
                    <a href="{{ route('login') }}" style="display: block; padding: 12px; background: #10b981; color: white; text-align: center; border-radius: 8px; text-decoration: none; font-weight: 600; margin-bottom: 20px;">
                        🛒 Connectez-vous pour acheter
                    </a>
                @else
                    <button disabled style="width: 100%; padding: 12px; background: #ccc; color: #999; border: none; border-radius: 8px; font-weight: 600; cursor: not-allowed; margin-bottom: 20px;">
                        Indisponible
                    </button>
                @endif

                <a href="{{ route('products.index') }}" style="display: block; padding: 12px; background: white; color: #10b981; border: 2px solid #10b981; text-align: center; border-radius: 8px; text-decoration: none; font-weight: 600;">
                    ← Continuer les achats
                </a>
            </div>
        </div>
    </div>
</div>

@endsection