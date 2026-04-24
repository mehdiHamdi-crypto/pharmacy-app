@extends('layouts.app')

@section('title', 'PharmaCare — Votre pharmacie de confiance')

@section('content')

{{-- ============ HERO ============ --}}
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <span class="eyebrow">Pharmacie · Conseil · Bien-être</span>
                <h1>Votre santé,<br><em>notre engagement</em> au quotidien.</h1>
                <p>Une sélection rigoureuse de produits pharmaceutiques et un accompagnement humain. PharmaCare réinvente votre expérience en pharmacie.</p>
                <div class="hero-buttons">
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">Découvrir nos produits</a>
                    <a href="#why-us" class="btn btn-secondary btn-lg">En savoir plus</a>
                </div>
            </div>
            <div class="hero-image">
                {{-- ======================================================
                     IMAGE HERO (grande image à droite sur la page d'accueil)
                     Pour changer : remplace l'URL ci-dessous
                     • URL externe  : https://ton-site.com/image.jpg
                     • Image locale : {{ asset('images/hero.jpg') }}
                ====================================================== --}}
                <img src="https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=800&q=80" alt="Pharmacie professionnelle">
            </div>
        </div>

        {{-- STATS --}}
        <div class="stats">
            <div class="stat-item">
                <h3>15K+</h3>
                <p>Clients satisfaits</p>
            </div>
            <div class="stat-item">
                <h3>2 500</h3>
                <p>Produits référencés</p>
            </div>
            <div class="stat-item">
                <h3>24/7</h3>
                <p>Service disponible</p>
            </div>
            <div class="stat-item">
                <h3>98%</h3>
                <p>Taux de satisfaction</p>
            </div>
        </div>
    </div>
</section>

{{-- ============ WHY US — Icônes SVG professionnelles (zéro emoji) ============ --}}
<section id="why-us" class="why-us">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Pourquoi nous choisir</span>
            <h2 class="section-title">L'excellence <em>pharmaceutique</em><br>à portée de main.</h2>
            <p class="section-subtitle">Quatre engagements qui définissent notre approche du soin et de la confiance.</p>
        </div>

        <div class="why-us-grid">
            {{-- 01 — Produits Certifiés --}}
            <div class="why-card">
                <span class="why-number">01 / Qualité</span>
                <div class="why-icon">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        <path d="m9 12 2 2 4-4"/>
                    </svg>
                </div>
                <h3>Produits Certifiés</h3>
                <p>Tous nos produits sont certifiés et contrôlés par les autorités sanitaires marocaines, avec traçabilité complète.</p>
            </div>

            {{-- 02 — Livraison Rapide --}}
            <div class="why-card">
                <span class="why-number">02 / Logistique</span>
                <div class="why-icon">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 17h-2v-11a1 1 0 0 1 1-1h11v12m-12 0a2 2 0 1 0 4 0m-4 0a2 2 0 1 1 4 0m11 0h-7m7 0a2 2 0 1 0 4 0m-4 0a2 2 0 1 1 4 0m0 0h2v-6h-8m0-5h5l3 5"/>
                    </svg>
                </div>
                <h3>Livraison Rapide</h3>
                <p>Livraison en 24 à 48 heures partout au Maroc, avec suivi en temps réel et emballage sécurisé adapté.</p>
            </div>

            {{-- 03 — Conseil Gratuit --}}
            <div class="why-card">
                <span class="why-number">03 / Accompagnement</span>
                <div class="why-icon">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        <path d="M8 10h.01M12 10h.01M16 10h.01"/>
                    </svg>
                </div>
                <h3>Conseil Pharmacien</h3>
                <p>Nos pharmaciens diplômés sont à votre écoute par chat, téléphone ou en visio pour un conseil personnalisé.</p>
            </div>

            {{-- 04 — Paiement Sécurisé --}}
            <div class="why-card">
                <span class="why-number">04 / Sécurité</span>
                <div class="why-icon">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        <circle cx="12" cy="16" r="1"/>
                    </svg>
                </div>
                <h3>Paiement Sécurisé</h3>
                <p>Transactions chiffrées en SSL 256 bits, protection totale de vos données personnelles et bancaires.</p>
            </div>
        </div>
    </div>
</section>

{{-- ============ PRODUITS PHARES ============ --}}
<section id="services" class="products">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Sélection</span>
            <h2 class="section-title">Nos <em>essentiels</em><br>du moment.</h2>
            <p class="section-subtitle">Une curation soignée des produits les plus appréciés par notre communauté.</p>
        </div>

        <div class="products-grid">

            {{-- ======================================================
                 PRODUITS PHARES — IMAGES HARDCODÉES
                 Pour changer une image : remplace l'URL dans src="..."
                 Tu peux utiliser :
                   • Une URL externe  : https://example.com/image.jpg
                   • Une image locale : {{ asset('images/vitamine-d3.jpg') }}
                     (mettre le fichier dans public/images/)
            ====================================================== --}}

            {{-- PRODUIT 1 — Vitamine D3 --}}
            <article class="product-card">
                <div class="product-image">
                    {{-- CHANGER L'IMAGE ICI ↓ --}}
                    <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=600&q=80" alt="Vitamines D3" style="width:100%; height:100%; object-fit:cover; display:block;">
                </div>
                <span class="product-category">Compléments</span>
                <h3 class="product-name">Vitamine D3 Premium</h3>
                <p class="product-desc">Renforce le système immunitaire et la santé osseuse.</p>
                <div class="product-price">120<span class="currency">MAD</span></div>
                <div class="product-actions">
                    <a href="#" class="btn btn-primary btn-sm btn-full">Ajouter au panier</a>
                </div>
            </article>

            {{-- PRODUIT 2 — Crème hydratante --}}
            <article class="product-card">
                <div class="product-image">
                    {{-- CHANGER L'IMAGE ICI ↓ --}}
                    <img src="https://images.unsplash.com/photo-1626516127753-66af50b9d7d4?w=600&q=80" alt="Crème hydratante" style="width:100%; height:100%; object-fit:cover; display:block;">
                </div>
                <span class="product-category">Dermo-cosmétique</span>
                <h3 class="product-name">Crème Hydratante Apaisante</h3>
                <p class="product-desc">Soin quotidien pour peaux sensibles et réactives.</p>
                <div class="product-price">185<span class="currency">MAD</span></div>
                <div class="product-actions">
                    <a href="#" class="btn btn-primary btn-sm btn-full">Ajouter au panier</a>
                </div>
            </article>

            {{-- PRODUIT 3 — Probiotiques --}}
            <article class="product-card">
                <div class="product-image">
                    {{-- CHANGER L'IMAGE ICI ↓ --}}
                    <img src="https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=600&q=80" alt="Probiotiques" style="width:100%; height:100%; object-fit:cover; display:block;">
                </div>
                <span class="product-category">Digestion</span>
                <h3 class="product-name">Probiotiques Flore+</h3>
                <p class="product-desc">Équilibre intestinal et digestion harmonieuse.</p>
                <div class="product-price">240<span class="currency">MAD</span></div>
                <div class="product-actions">
                    <a href="#" class="btn btn-primary btn-sm btn-full">Ajouter au panier</a>
                </div>
            </article>

            {{-- PRODUIT 4 — Huile essentielle --}}
            <article class="product-card">
                <div class="product-image">
                    {{-- CHANGER L'IMAGE ICI ↓ --}}
                    <img src="https://images.unsplash.com/photo-1559757175-5700dde675bc?w=600&q=80" alt="Huile essentielle" style="width:100%; height:100%; object-fit:cover; display:block;">
                </div>
                <span class="product-category">Aromathérapie</span>
                <h3 class="product-name">Huile Essentielle Lavande</h3>
                <p class="product-desc">Apaisante, favorise le sommeil et la détente.</p>
                <div class="product-price">95<span class="currency">MAD</span></div>
                <div class="product-actions">
                    <a href="#" class="btn btn-primary btn-sm btn-full">Ajouter au panier</a>
                </div>
            </article>

        </div>
    </div>
</section>

{{-- ============ CTA ============ --}}
<section class="cta">
    <div class="container">
        <span class="eyebrow">Rejoignez-nous</span>
        <h2>Prenez soin de vous,<br><em>nous nous occupons</em> du reste.</h2>
        <p>Créez votre compte gratuitement et profitez d'un suivi personnalisé, de promotions exclusives et d'un accès direct à nos pharmaciens.</p>
        @guest
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Créer mon compte</a>
        @else
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">Explorer le catalogue</a>
        @endguest
    </div>
</section>

@endsection
