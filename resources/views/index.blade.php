@extends('layouts.app')

@section('title', 'PharmaCare - Votre Pharmacie en Ligne de Confiance')

@section('content')

<style>
    .hero {
        padding: 80px 0;
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--white) 100%);
    }

    .hero .container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
    }

    .hero-content h1 {
        font-size: 48px;
        margin-bottom: 20px;
        color: var(--text-dark);
        font-weight: 700;
        line-height: 1.2;
    }

    .hero-content p {
        font-size: 18px;
        color: var(--text-light);
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .hero-buttons {
        display: flex;
        gap: 20px;
    }

    .btn {
        padding: 12px 32px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary {
        background: var(--primary-color);
        color: var(--white);
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);
    }

    .btn-secondary {
        background: var(--white);
        color: var(--primary-color);
        border: 2px solid var(--primary-color);
    }

    .btn-secondary:hover {
        background: var(--primary-light);
    }

    .image-placeholder {
        font-size: 120px;
        text-align: center;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }

    /* BENEFITS */
    .benefits {
        padding: 80px 0;
        background: var(--white);
    }

    .benefits-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
    }

    .benefit-card {
        text-align: center;
        padding: 30px;
        background: var(--bg-light);
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .benefit-card:hover {
        background: var(--white);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transform: translateY(-5px);
    }

    .benefit-icon {
        font-size: 48px;
        margin-bottom: 15px;
    }

    .benefit-card h3 {
        font-size: 20px;
        margin-bottom: 10px;
        color: var(--text-dark);
    }

    .benefit-card p {
        color: var(--text-light);
        font-size: 15px;
    }

    /* PRODUCTS */
    .products {
        padding: 80px 0;
        background: var(--bg-light);
    }

    .products h2 {
        font-size: 36px;
        margin-bottom: 50px;
        text-align: center;
        color: var(--text-dark);
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
    }

    .product-category {
        background: var(--white);
        padding: 40px 30px;
        border-radius: 12px;
        text-align: center;
        border: 2px solid transparent;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .product-category:hover {
        border-color: var(--primary-color);
        box-shadow: 0 15px 40px rgba(16, 185, 129, 0.1);
        transform: translateY(-5px);
    }

    .category-icon {
        font-size: 56px;
        margin-bottom: 20px;
    }

    .product-category h3 {
        font-size: 20px;
        margin-bottom: 10px;
        color: var(--text-dark);
    }

    .product-category p {
        color: var(--text-light);
        margin-bottom: 20px;
    }

    .link-arrow {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .link-arrow:hover {
        transform: translateX(5px);
    }

    /* SERVICES */
    .services {
        padding: 80px 0;
        background: var(--white);
    }

    .services h2 {
        font-size: 36px;
        margin-bottom: 50px;
        text-align: center;
        color: var(--text-dark);
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 50px;
    }

    .service-item {
        position: relative;
        padding-left: 80px;
    }

    .service-number {
        position: absolute;
        left: 0;
        top: 0;
        font-size: 48px;
        font-weight: 700;
        color: var(--primary-light);
    }

    .service-item h3 {
        font-size: 22px;
        margin-bottom: 15px;
        color: var(--text-dark);
    }

    .service-item p {
        color: var(--text-light);
        line-height: 1.7;
    }

    /* TESTIMONIALS */
    .testimonials {
        padding: 80px 0;
        background: var(--bg-light);
    }

    .testimonials h2 {
        font-size: 36px;
        margin-bottom: 50px;
        text-align: center;
        color: var(--text-dark);
    }

    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .testimonial-card {
        background: var(--white);
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .testimonial-card:hover {
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        transform: translateY(-5px);
    }

    .stars {
        font-size: 18px;
        margin-bottom: 15px;
    }

    .testimonial-text {
        color: var(--text-dark);
        margin-bottom: 20px;
        line-height: 1.7;
        font-size: 15px;
    }

    .testimonial-author {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .author-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: var(--primary-color);
        color: var(--white);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
    }

    .testimonial-author strong {
        display: block;
        color: var(--text-dark);
    }

    .testimonial-author span {
        display: block;
        font-size: 13px;
        color: var(--text-light);
    }

    /* CTA */
    .cta {
        padding: 80px 0;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: var(--white);
        text-align: center;
    }

    .cta h2 {
        font-size: 40px;
        margin-bottom: 20px;
        color: var(--white);
    }

    .cta p {
        font-size: 18px;
        margin-bottom: 30px;
        color: rgba(255, 255, 255, 0.9);
    }

    .cta .btn-primary {
        background: var(--white);
        color: var(--primary-color);
        font-weight: 700;
        padding: 16px 48px;
        font-size: 18px;
    }

    .cta .btn-primary:hover {
        background: var(--primary-light);
    }

    @media (max-width: 768px) {
        .hero .container {
            grid-template-columns: 1fr;
        }

        .hero-content h1 {
            font-size: 32px;
        }

        .image-placeholder {
            font-size: 80px;
        }

        .hero-buttons {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<!-- HERO SECTION -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1>Votre Santé, Notre Priorité</h1>
            <p>Découvrez notre large gamme de produits pharmaceutiques et de bien-être livrés directement à votre porte</p>
            <div class="hero-buttons">
                @if(Auth::check())
                    <a href="#produits" class="btn btn-primary">Commencer les achats</a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-primary">Créer un compte</a>
                @endif
                <a href="#services" class="btn btn-secondary">En savoir plus</a>
            </div>
        </div>
        <div class="hero-image">
            <div class="image-placeholder">📦</div>
        </div>
    </div>
</section>

<!-- BENEFITS -->
<section class="benefits">
    <div class="container">
        <div class="benefits-grid">
            <div class="benefit-card">
                <div class="benefit-icon">💊</div>
                <h3>Produits Certifiés</h3>
                <p>Tous nos produits sont certifiés et contrôlés par les autorités sanitaires</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">🚚</div>
                <h3>Livraison Rapide</h3>
                <p>Livraison en 24-48h partout dans le pays avec suivi en temps réel</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">👨‍⚕️</div>
                <h3>Conseil Gratuit</h3>
                <p>Nos pharmaciens sont disponibles pour vous conseiller gratuitement</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">🔒</div>
                <h3>Paiement Sécurisé</h3>
                <p>Transactions 100% sécurisées avec SSL et protection des données</p>
            </div>
        </div>
    </div>
</section>

<!-- PRODUCTS -->
<section id="produits" class="products">
    <div class="container">
        <h2>Nos Catégories</h2>
        <div class="products-grid">
            <div class="product-category">
                <div class="category-icon">💊</div>
                <h3>Médicaments</h3>
                <p>Médicaments sur ordonnance et sans ordonnance</p>
                <a href="#" class="link-arrow">Voir plus →</a>
            </div>
            <div class="product-category">
                <div class="category-icon">🧴</div>
                <h3>Beauté & Hygiene</h3>
                <p>Produits de beauté et d'hygiène personnelle</p>
                <a href="#" class="link-arrow">Voir plus →</a>
            </div>
            <div class="product-category">
                <div class="category-icon">🍃</div>
                <h3>Compléments</h3>
                <p>Vitamines et compléments alimentaires naturels</p>
                <a href="#" class="link-arrow">Voir plus →</a>
            </div>
            <div class="product-category">
                <div class="category-icon">👶</div>
                <h3>Bébé & Maman</h3>
                <p>Produits spécialisés pour bébés et femmes enceintes</p>
                <a href="#" class="link-arrow">Voir plus →</a>
            </div>
            <div class="product-category">
                <div class="category-icon">⚙️</div>
                <h3>Équipements</h3>
                <p>Tensiomètres, thermomètres et appareils médicaux</p>
                <a href="#" class="link-arrow">Voir plus →</a>
            </div>
            <div class="product-category">
                <div class="category-icon">🩹</div>
                <h3>Premiers Secours</h3>
                <p>Pansements, désinfectants et produits d'urgence</p>
                <a href="#" class="link-arrow">Voir plus →</a>
            </div>
        </div>
    </div>
</section>

<!-- SERVICES -->
<section id="services" class="services">
    <div class="container">
        <h2>Nos Services Professionnels</h2>
        <div class="services-grid">
            <div class="service-item">
                <div class="service-number">01</div>
                <h3>Consultation Pharmacien</h3>
                <p>Consultez nos pharmaciens diplômés en ligne pour vos questions de santé et médicaments.</p>
            </div>
            <div class="service-item">
                <div class="service-number">02</div>
                <h3>Renouvellement Ordonnance</h3>
                <p>Renouvelez vos ordonnances facilement depuis votre espace personnel en quelques clics.</p>
            </div>
            <div class="service-item">
                <div class="service-number">03</div>
                <h3>Programme Fidélité</h3>
                <p>Gagnez des points à chaque achat et profitez de réductions exclusives en tant que client fidèle.</p>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
<section class="testimonials">
    <div class="container">
        <h2>Ce que Disent Nos Clients</h2>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="stars">⭐⭐⭐⭐⭐</div>
                <p class="testimonial-text">"Excellente plateforme, livraison rapide et service client réactif. Je recommande vivement!"</p>
                <div class="testimonial-author">
                    <div class="author-avatar">AM</div>
                    <div>
                        <strong>Amina M.</strong>
                        <span>Client depuis 2023</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="stars">⭐⭐⭐⭐⭐</div>
                <p class="testimonial-text">"Les produits sont authentiques et les prix sont compétitifs. Très satisfait de mon achat!"</p>
                <div class="testimonial-author">
                    <div class="author-avatar">KH</div>
                    <div>
                        <strong>Khalid H.</strong>
                        <span>Client depuis 2023</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="stars">⭐⭐⭐⭐⭐</div>
                <p class="testimonial-text">"Les pharmaciens m'ont aidé à choisir le meilleur produit pour ma situation. Service de qualité!"</p>
                <div class="testimonial-author">
                    <div class="author-avatar">SR</div>
                    <div>
                        <strong>Sara R.</strong>
                        <span>Client depuis 2024</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta">
    <div class="container">
        <h2>Prêt à Commander?</h2>
        <p>Rejoignez des milliers de clients satisfaits et commencez vos achats aujourd'hui</p>
        @if(Auth::check())
            <a href="#produits" class="btn btn-primary">Continuer les achats</a>
        @else
            <a href="{{ route('register') }}" class="btn btn-primary">Créer un compte gratuit</a>
        @endif
    </div>
</section>

@endsection