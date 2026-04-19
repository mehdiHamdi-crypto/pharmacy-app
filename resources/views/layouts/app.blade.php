<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PharmaCare - Votre Pharmacie en Ligne')</title>
    
    <!-- FONTS STARTUP MODIFIÉ -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Montserrat:wght@600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/pharmacy.css') }}">
    
    <style>
        :root {
            /* Couleurs STARTUP MODIFIÉES */
            --primary-color: #2563eb;           /* Bleu tech */
            --primary-dark: #1e40af;
            --primary-light: #eff6ff;
            --secondary-color: #059669;         /* Vert frais */
            --secondary-dark: #047857;
            --secondary-light: #ecfdf5;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --text-muted: #9ca3af;
            --border-color: #e5e7eb;
            --bg-light: #f9fafb;
            --white: #ffffff;
            --danger: #dc2626;
            --warning: #f59e0b;
            --success: #10b981;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            /* FONTS MODIFIÉES */
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: var(--white);
            letter-spacing: -0.2px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* =============================
           HEADER STARTUP
           ============================= */

        .header {
            background: var(--white);
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .navbar {
            padding: 16px 0;
        }

        .nav-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        /* LOGO MODIFIÉ */
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Montserrat', sans-serif;
            font-size: 24px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            letter-spacing: -0.5px;
            transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .logo:hover {
            opacity: 0.8;
        }

        .logo img {
            height: 40px;
            width: 40px;
            object-fit: contain;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .logo:hover img {
            transform: scale(1.05);
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 40px;
            flex: 1;
            justify-content: center;
        }

        .nav-menu a {
            font-family: 'Inter', sans-serif;
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            padding-bottom: 4px;
        }

        .nav-menu a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-menu a:hover {
            color: var(--primary-color);
        }

        .nav-menu a:hover::after {
            width: 100%;
        }

        .nav-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-search {
            background: var(--bg-light);
            border: 1px solid var(--border-color);
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
        }

        .btn-search:hover {
            background: var(--primary-light);
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .btn-cart {
            position: relative;
            background: var(--bg-light);
            border: 1px solid var(--border-color);
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            text-decoration: none;
        }

        .btn-cart:hover {
            background: var(--secondary-light);
            border-color: var(--secondary-color);
            color: var(--secondary-color);
        }

        .cart-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--white);
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            font-family: 'Montserrat', sans-serif;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
        }

        .btn-login {
            background: transparent;
            color: var(--primary-color);
            border: 1.5px solid var(--primary-color);
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-block;
        }

        .btn-login:hover {
            background: var(--primary-light);
            border-color: var(--primary-dark);
        }

        .btn-register {
            background: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-block;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.15);
        }

        .btn-register:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(37, 99, 235, 0.3);
        }

        .user-menu {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.2);
        }

        .user-avatar:hover {
            transform: scale(1.05);
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            background: var(--white);
            min-width: 220px;
            box-shadow: 0 10px 32px rgba(0, 0, 0, 0.12);
            z-index: 10;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            margin-top: 12px;
            overflow: hidden;
            animation: slideDown 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-menu a {
            color: var(--text-dark);
            padding: 12px 20px;
            text-decoration: none;
            display: block;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 14px;
            border-bottom: 1px solid var(--border-color);
            font-family: 'Inter', sans-serif;
        }

        .dropdown-menu a:last-child {
            border-bottom: none;
        }

        .dropdown-menu a:hover {
            background: var(--primary-light);
            color: var(--primary-color);
            padding-left: 24px;
        }

        .dropdown-menu form {
            padding: 0;
        }

        .dropdown-menu button {
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            color: var(--danger);
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
        }

        .dropdown-menu button:hover {
            background: #fee2e2;
            padding-left: 24px;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        /* =============================
           ALERTS
           ============================= */

        .alert {
            padding: 16px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
            font-size: 14px;
            font-weight: 500;
            animation: slideDown 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .alert-success {
            background: var(--secondary-light);
            color: var(--secondary-dark);
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .alert-warning {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }

        .alert-icon {
            font-size: 16px;
            flex-shrink: 0;
        }

        /* =============================
           MAIN CONTENT
           ============================= */

        main {
            min-height: calc(100vh - 200px);
        }

        /* =============================
           FOOTER STARTUP
           ============================= */

        .footer {
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            color: rgba(255, 255, 255, 0.8);
            padding: 64px 0 24px;
            margin-top: 80px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 48px;
            margin-bottom: 48px;
        }

        .footer-column h4 {
            font-family: 'Montserrat', sans-serif;
            color: var(--white);
            margin-bottom: 24px;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column ul li {
            margin-bottom: 14px;
        }

        .footer-column a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 13px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: 'Inter', sans-serif;
        }

        .footer-column a:hover {
            color: var(--primary-color);
            padding-left: 4px;
        }

        .footer-column p {
            font-size: 13px;
            margin-bottom: 12px;
            line-height: 1.8;
            font-family: 'Inter', sans-serif;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 32px;
            text-align: center;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.6);
            font-family: 'Inter', sans-serif;
        }

        /* =============================
           RESPONSIVE
           ============================= */

        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }

            .nav-wrapper {
                flex-wrap: wrap;
                gap: 12px;
            }

            .logo {
                font-size: 20px;
            }

            .logo img {
                height: 36px;
                width: 36px;
            }

            .nav-actions {
                gap: 10px;
                flex-wrap: wrap;
            }

            .container {
                padding: 0 16px;
            }

            .footer-grid {
                gap: 32px;
            }
        }

        @media (max-width: 480px) {
            .logo {
                font-size: 18px;
                gap: 8px;
            }

            .logo img {
                height: 32px;
                width: 32px;
            }

            .nav-actions {
                gap: 8px;
            }

            .btn-login, .btn-register {
                padding: 8px 16px;
                font-size: 12px;
            }

            .dropdown-menu {
                min-width: 180px;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }

            .container {
                padding: 0 12px;
            }
        }

        /* =============================
           ANIMATIONS
           ============================= */

        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <header class="header">
        <nav class="navbar">
            <div class="container">
                <div class="nav-wrapper">
                    <!-- LOGO MODIFIÉ -->
                    <a href="{{ route('index') }}" class="logo">
                        <img src="{{ asset('images/logo-startup.svg') }}" alt="PharmaCare" title="PharmaCare - Accueil">
                        <span>PharmaCare</span>
                    </a>

                    <!-- NAVIGATION MENU -->
                    <ul class="nav-menu">
                        <li><a href="{{ route('index') }}">Accueil</a></li>
                        <li><a href="{{ route('products.index') }}">Produits</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>

                    <!-- NAV ACTIONS -->
                    <div class="nav-actions">
                        <button class="btn-search" title="Rechercher les produits">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                            </svg>
                        </button>

                        <button class="btn-cart" title="Voir votre panier">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                            </svg>
                            <span class="cart-badge">0</span>
                        </button>

                        @if(Auth::check())
                            <!-- USER AUTHENTICATED -->
                            <div class="user-menu">
                                <div class="dropdown">
                                    <div class="user-avatar" title="Menu utilisateur">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('dashboard') }}">Mon Compte</a>
                                        <a href="{{ route('orders.index') }}">Mes Commandes</a>
                                        <a href="#">Favoris</a>
                                        <a href="#">Paramètres</a>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit">Déconnexion</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- NOT AUTHENTICATED -->
                            <a href="{{ route('login') }}" class="btn-login">Connexion</a>
                            <a href="{{ route('register') }}" class="btn-register">Inscription</a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- ALERTS -->
    @if ($errors->any())
        <div class="container" style="padding-top: 20px;">
            @foreach ($errors->all() as $error)
                <div class="alert alert-error">
                    <span class="alert-icon">!</span>
                    <span>{{ $error }}</span>
                </div>
            @endforeach
        </div>
    @endif

    @if (session('success'))
        <div class="container" style="padding-top: 20px;">
            <div class="alert alert-success">
                <span class="alert-icon">✓</span>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="container" style="padding-top: 20px;">
            <div class="alert alert-error">
                <span class="alert-icon">!</span>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- MAIN CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer id="contact" class="footer">
        <div class="container">
            <div class="footer-grid">
                <!-- À PROPOS -->
                <div class="footer-column">
                    <h4>À Propos</h4>
                    <ul>
                        <li><a href="#">Qui sommes-nous</a></li>
                        <li><a href="#">Notre mission</a></li>
                        <li><a href="#">Nos pharmaciens</a></li>
                        <li><a href="#">Carrières</a></li>
                        <li><a href="#">Partenaires</a></li>
                    </ul>
                </div>

                <!-- AIDE & SUPPORT -->
                <div class="footer-column">
                    <h4>Aide</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Suivi commande</a></li>
                        <li><a href="#">Retours & Échanges</a></li>
                        <li><a href="#">Support client</a></li>
                        <li><a href="#">Contacter nous</a></li>
                    </ul>
                </div>

                <!-- LÉGAL -->
                <div class="footer-column">
                    <h4>Légal</h4>
                    <ul>
                        <li><a href="#">Conditions générales</a></li>
                        <li><a href="#">Politique confidentialité</a></li>
                        <li><a href="#">Gestion cookies</a></li>
                        <li><a href="#">Mentions légales</a></li>
                        <li><a href="#">Accessibilité</a></li>
                    </ul>
                </div>

                <!-- CONTACT -->
                <div class="footer-column">
                    <h4>Contact</h4>
                    <p><strong>Téléphone :</strong> +212 5XX XXX XXX</p>
                    <p><strong>Email :</strong> contact@pharmacare.ma</p>
                    <p><strong>Adresse :</strong> FES, Maroc</p>
                    <p><strong>Horaires :</strong> Lun-Dim 8h-20h</p>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2024 PharmaCare. Tous droits réservés. Votre pharmacie en ligne de confiance.</p>
            </div>
        </div>
    </footer>

    <!-- SCRIPTS -->
    <script src="{{ asset('js/pharmacy.js') }}"></script>
    @yield('scripts')
</body>
</html>
