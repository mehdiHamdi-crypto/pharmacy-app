@extends('layouts.app')

@section('title', 'Confirmation - PharmaCare')

@section('content')
<section style="padding: 56px 0 80px;">
    <div class="container">
        <div style="display:flex; justify-content:space-between; gap:18px; align-items:flex-end; flex-wrap:wrap; margin-bottom:28px;">
            <div>
                <span class="eyebrow">Validation</span>
                <h1 style="font-family:var(--font-display); font-size:42px; margin-top:12px;">Confirmation de commande</h1>
                <p style="color:var(--muted); margin-top:10px; max-width:720px;">Verifiez vos produits, renseignez ladresse de livraison et confirmez le mode de paiement.</p>
            </div>
            <a href="{{ route('cart.index') }}" class="btn-login">Retour au panier</a>
        </div>

        <form action="{{ route('orders.store') }}" method="POST" style="display:grid; grid-template-columns:minmax(0, 2fr) 360px; gap:24px; align-items:start;">
            @csrf

            <div style="display:grid; gap:18px;">
                <div style="background:#fff; border:1px solid var(--rule); border-radius:24px; padding:22px;">
                    <h2 style="font-family:var(--font-display); font-size:30px; margin-bottom:18px;">Articles</h2>

                    <div style="display:grid; gap:14px;">
                        @foreach($cartItems as $item)
                            <article style="display:grid; grid-template-columns:88px minmax(0, 1fr) auto; gap:14px; align-items:center; padding:14px 0; border-bottom:1px solid var(--rule);">
                                <div style="width:88px; height:88px; border-radius:16px; overflow:hidden; border:1px solid var(--rule); background:var(--paper-warm);">
                                    <img
                                        src="{{ $item->product->imageSrc() }}"
                                        alt="{{ $item->product->name }}"
                                        style="width:100%; height:100%; object-fit:cover;"
                                        onerror="this.onerror=null;this.src='{{ $item->product->defaultImageUrl() }}';"
                                    >
                                </div>
                                <div>
                                    <div style="font-weight:700;">{{ $item->product->name }}</div>
                                    <div style="color:var(--muted); font-size:14px;">Quantite : {{ $item->quantity }}</div>
                                    <div style="color:var(--muted); font-size:14px;">Prix unitaire : {{ number_format($item->product->final_price, 2, ',', ' ') }} MAD</div>
                                </div>
                                <div style="font-weight:700; white-space:nowrap;">{{ number_format($item->product->final_price * $item->quantity, 2, ',', ' ') }} MAD</div>
                            </article>
                        @endforeach
                    </div>
                </div>

                <div style="background:#fff; border:1px solid var(--rule); border-radius:24px; padding:22px;">
                    <h2 style="font-family:var(--font-display); font-size:30px; margin-bottom:18px;">Livraison et paiement</h2>

                    <div style="display:grid; gap:18px;">
                        <div>
                            <label for="shipping_address" style="display:block; font-family:var(--font-mono); font-size:11px; text-transform:uppercase; letter-spacing:1.6px; color:var(--muted); margin-bottom:8px;">Adresse de livraison</label>
                            <textarea id="shipping_address" name="shipping_address" rows="4" required style="width:100%; padding:14px 16px; border:1px solid var(--rule); border-radius:14px; background:var(--paper);">{{ old('shipping_address', auth()->user()->address) }}</textarea>
                        </div>

                        <div>
                            <label for="payment_method" style="display:block; font-family:var(--font-mono); font-size:11px; text-transform:uppercase; letter-spacing:1.6px; color:var(--muted); margin-bottom:8px;">Mode de paiement</label>
                            <select id="payment_method" name="payment_method" required style="width:100%; padding:14px 16px; border:1px solid var(--rule); border-radius:14px; background:var(--paper);">
                                <option value="cash_on_delivery" @selected(old('payment_method') === 'cash_on_delivery')>Paiement a la livraison</option>
                                <option value="bank_transfer" @selected(old('payment_method') === 'bank_transfer')>Virement bancaire</option>
                            </select>
                        </div>

                        <div>
                            <label for="notes" style="display:block; font-family:var(--font-mono); font-size:11px; text-transform:uppercase; letter-spacing:1.6px; color:var(--muted); margin-bottom:8px;">Notes</label>
                            <textarea id="notes" name="notes" rows="3" style="width:100%; padding:14px 16px; border:1px solid var(--rule); border-radius:14px; background:var(--paper);">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <aside style="background:#fff; border:1px solid var(--rule); border-radius:24px; padding:24px; position:sticky; top:120px;">
                <span class="eyebrow">Total</span>
                <h2 style="font-family:var(--font-display); font-size:32px; margin:14px 0 18px;">Resume</h2>

                <div style="display:grid; gap:12px; margin-bottom:18px;">
                    <div style="display:flex; justify-content:space-between;">
                        <span style="color:var(--muted);">Sous-total</span>
                        <strong>{{ number_format($subtotal, 2, ',', ' ') }} MAD</strong>
                    </div>
                    <div style="display:flex; justify-content:space-between;">
                        <span style="color:var(--muted);">TVA (10%)</span>
                        <strong>{{ number_format($tax, 2, ',', ' ') }} MAD</strong>
                    </div>
                    <div style="display:flex; justify-content:space-between;">
                        <span style="color:var(--muted);">Livraison</span>
                        <strong>{{ number_format($shipping, 2, ',', ' ') }} MAD</strong>
                    </div>
                </div>

                <div style="display:flex; justify-content:space-between; align-items:center; padding:16px 0; border-top:1px solid var(--rule); border-bottom:1px solid var(--rule); margin-bottom:18px;">
                    <span style="font-size:18px; font-weight:600;">Total</span>
                    <span style="font-family:var(--font-display); font-size:32px; color:var(--sage-dark);">{{ number_format($total, 2, ',', ' ') }} MAD</span>
                </div>

                <button type="submit" class="btn-register" style="width:100%; border:none;">Confirmer la commande</button>
            </aside>
        </form>
    </div>
</section>
@endsection