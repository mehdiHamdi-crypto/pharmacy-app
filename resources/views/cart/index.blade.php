@extends('layouts.app')

@section('title', 'Panier - PharmaCare')

@section('content')
<section style="padding: 56px 0 80px;">
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:flex-end; gap:18px; flex-wrap:wrap; margin-bottom:28px;">
            <div>
                <span class="eyebrow">Commande</span>
                <h1 style="font-family:var(--font-display); font-size:44px; margin-top:12px;">Mon panier</h1>
                <p style="color:var(--muted); max-width:720px; margin-top:12px;">
                    Retrouvez ici tous les produits ajoutes a votre panier, mettez a jour les quantites et passez a la confirmation.
                </p>
            </div>

            @if($cartItems->isNotEmpty())
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-login">Vider le panier</button>
                </form>
            @endif
        </div>

        @if($cartItems->isEmpty())
            <div style="background:#fff; border:1px dashed var(--rule); border-radius:24px; padding:56px 24px; text-align:center;">
                <div style="font-family:var(--font-display); font-size:34px; margin-bottom:12px;">Votre panier est vide</div>
                <p style="color:var(--muted); margin-bottom:22px;">Ajoutez un produit depuis le catalogue pour le retrouver ici.</p>
                <a href="{{ route('products.index') }}" class="btn-register">Voir le catalogue</a>
            </div>
        @else
            <div style="display:grid; grid-template-columns:minmax(0, 2fr) 360px; gap:24px; align-items:start;">
                <div style="display:grid; gap:18px;">
                    @foreach($cartItems as $item)
                        <article style="background:#fff; border:1px solid var(--rule); border-radius:24px; padding:20px; display:grid; grid-template-columns:120px minmax(0, 1fr) 230px; gap:18px; align-items:start;">
                            <div style="width:120px; height:120px; border-radius:18px; overflow:hidden; border:1px solid var(--rule); background:var(--paper-warm);">
                                <img
                                    src="{{ $item->product->imageSrc() }}"
                                    alt="{{ $item->product->name }}"
                                    style="width:100%; height:100%; object-fit:cover;"
                                    onerror="this.onerror=null;this.src='{{ $item->product->defaultImageUrl() }}';"
                                >
                            </div>

                            <div>
                                <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap; margin-bottom:10px;">
                                    <span style="display:inline-flex; align-items:center; gap:6px; padding:6px 12px; border-radius:999px; background:var(--accent-soft); color:var(--accent); font-family:var(--font-mono); font-size:11px; letter-spacing:1.3px; text-transform:uppercase;">
                                        {{ $item->product->category->name ?? 'Catalogue' }}
                                    </span>

                                    @if($item->product->stock === 0)
                                        <span style="display:inline-flex; padding:6px 12px; border-radius:999px; background:#faebeb; color:var(--danger); font-size:12px; font-weight:600;">Rupture</span>
                                    @elseif($item->product->stock <= 10)
                                        <span style="display:inline-flex; padding:6px 12px; border-radius:999px; background:var(--accent-soft); color:var(--accent); font-size:12px; font-weight:600;">Stock faible</span>
                                    @else
                                        <span style="display:inline-flex; padding:6px 12px; border-radius:999px; background:var(--sage-light); color:var(--sage-dark); font-size:12px; font-weight:600;">Disponible</span>
                                    @endif
                                </div>

                                <h2 style="font-family:var(--font-display); font-size:28px; margin-bottom:10px; line-height:1.1;">{{ $item->product->name }}</h2>
                                <p style="color:var(--muted); margin-bottom:14px;">{{ \Illuminate\Support\Str::limit($item->product->description, 130) }}</p>

                                <div style="display:flex; gap:18px; flex-wrap:wrap; color:var(--muted); font-size:13px;">
                                    <span>SKU : <strong style="color:var(--ink);">{{ $item->product->sku ?? 'N/R' }}</strong></span>
                                    <span>Stock restant : <strong style="color:var(--ink);">{{ $item->product->stock }}</strong></span>
                                    <span>Prix unitaire : <strong style="color:var(--ink);">{{ number_format($item->product->final_price, 2, ',', ' ') }} MAD</strong></span>
                                </div>
                            </div>

                            <div style="background:var(--paper); border:1px solid var(--rule); border-radius:18px; padding:16px;">
                                <form action="{{ route('cart.update', $item) }}" method="POST" style="display:grid; grid-template-columns:1fr auto; gap:10px; margin-bottom:14px;">
                                    @csrf
                                    @method('PATCH')
                                    <input
                                        type="number"
                                        name="quantity"
                                        value="{{ $item->quantity }}"
                                        min="1"
                                        max="{{ max($item->product->stock, $item->quantity) }}"
                                        style="width:100%; padding:12px 14px; border:1px solid var(--rule); border-radius:12px; background:#fff;"
                                    >
                                    <button type="submit" class="btn-register" style="border:none;">OK</button>
                                </form>

                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                                    <span style="color:var(--muted);">Sous-total</span>
                                    <strong style="font-size:18px;">{{ number_format($item->product->final_price * $item->quantity, 2, ',', ' ') }} MAD</strong>
                                </div>

                                <form action="{{ route('cart.remove', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-login" style="width:100%; color:var(--danger); border-color:#e7c9c9;">Supprimer</button>
                                </form>
                            </div>
                        </article>
                    @endforeach
                </div>

                <aside style="background:#fff; border:1px solid var(--rule); border-radius:24px; padding:24px; position:sticky; top:120px;">
                    <span class="eyebrow">Resume</span>
                    <h2 style="font-family:var(--font-display); font-size:32px; margin:14px 0 18px;">Votre commande</h2>

                    <div style="display:grid; gap:12px; margin-bottom:18px;">
                        <div style="display:flex; justify-content:space-between; gap:16px;">
                            <span style="color:var(--muted);">Articles</span>
                            <strong>{{ $totalQuantity }}</strong>
                        </div>
                        <div style="display:flex; justify-content:space-between; gap:16px;">
                            <span style="color:var(--muted);">Sous-total</span>
                            <strong>{{ number_format($subtotal, 2, ',', ' ') }} MAD</strong>
                        </div>
                        <div style="display:flex; justify-content:space-between; gap:16px;">
                            <span style="color:var(--muted);">TVA (10%)</span>
                            <strong>{{ number_format($tax, 2, ',', ' ') }} MAD</strong>
                        </div>
                        <div style="display:flex; justify-content:space-between; gap:16px;">
                            <span style="color:var(--muted);">Livraison</span>
                            <strong>{{ number_format($shipping, 2, ',', ' ') }} MAD</strong>
                        </div>
                    </div>

                    <div style="display:flex; justify-content:space-between; align-items:center; padding:16px 0; border-top:1px solid var(--rule); border-bottom:1px solid var(--rule); margin-bottom:18px;">
                        <span style="font-size:18px; font-weight:600;">Total</span>
                        <span style="font-family:var(--font-display); font-size:32px; color:var(--sage-dark);">{{ number_format($total, 2, ',', ' ') }} MAD</span>
                    </div>

                    <div style="display:grid; gap:10px;">
                        <a href="{{ route('checkout') }}" class="btn-register" style="width:100%;">Passer la commande</a>
                        <a href="{{ route('products.index') }}" class="btn-login" style="width:100%;">Continuer les achats</a>
                    </div>
                </aside>
            </div>
        @endif
    </div>
</section>
@endsection