<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0f1a14">
    <title>@yield('title', 'PharmaCare — Votre pharmacie de confiance')</title>

    {{-- FONTS PROFESSIONNELLES : Fraunces (serif éditorial) + Inter (body) + JetBrains Mono (labels) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700;9..144,800&family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/pharmacy.css') }}">

    <style>
        :root {
            /* PALETTE UNIQUE — Éditorial Pharmacie */
            --ink:          #0f1a14;   /* Noir forestier */
            --ink-soft:     #2a332d;
            --paper:        #faf7f2;   /* Crème chaud */
            --paper-warm:   #f2ede3;
            --sage:         #3d6b56;   /* Vert sauge primary */
            --sage-dark:    #264738;
            --sage-light:   #e8f0ea;
            --accent:       #b8763f;   /* Terracotta */
            --accent-soft:  #f5ece0;
            --rule:         #d9d2c3;   /* Lignes / bordures */
            --muted:        #6b6b60;
            --danger:       #a13838;
            --success:      #3d6b56;

            /* TYPOGRAPHIE */
            --font-display: 'Fraunces', 'Georgia', serif;
            --font-body:    'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            --font-mono:    'JetBrains Mono', 'Courier New', monospace;

            /* MOTION */
            --ease: cubic-bezier(0.2, 0.8, 0.2, 1);
            --dur:  400ms;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html {
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            background: var(--paper);
        }

        body {
            font-family: var(--font-body);
            font-size: 15px;
            line-height: 1.65;
            color: var(--ink);
            background: var(--paper);
            font-feature-settings: "ss01", "cv11";
        }

        .container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 32px;
        }

        /* =============================
           HEADER — Éditorial
           ============================= */
        .header {
            background: var(--paper);
            border-bottom: 1px solid var(--rule);
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: saturate(180%) blur(12px);
            background-color: rgba(250, 247, 242, 0.88);
        }

        .navbar { padding: 20px 0; }

        .nav-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 32px;
        }

        /* LOGO */
        .logo {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            transition: opacity var(--dur) var(--ease);
        }

        .logo:hover { opacity: 0.75; }

        .logo-mark {
            width: 42px;
            height: 42px;
            border: 1.5px solid var(--ink);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--paper);
        }

        .logo-mark svg {
            width: 22px;
            height: 22px;
            stroke: var(--ink);
            fill: none;
            stroke-width: 1.6;
        }

        .logo-text {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }

        .logo-text .name {
            font-family: var(--font-display);
            font-size: 22px;
            font-weight: 600;
            font-variation-settings: "opsz" 144;
            color: var(--ink);
            letter-spacing: -0.5px;
        }

        .logo-text .tag {
            font-family: var(--font-mono);
            font-size: 9px;
            font-weight: 500;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 4px;
        }

        /* NAV MENU */
        .nav-menu {
            display: flex;
            list-style: none;
            gap: 36px;
            flex: 1;
            justify-content: center;
        }

        .nav-menu a {
            font-family: var(--font-body);
            text-decoration: none;
            color: var(--ink);
            font-weight: 500;
            font-size: 14px;
            position: relative;
            padding: 6px 0;
            transition: color var(--dur) var(--ease);
        }

        .nav-menu a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 1px;
            background: var(--ink);
            transition: all var(--dur) var(--ease);
            transform: translateX(-50%);
        }

        .nav-menu a:hover { color: var(--sage-dark); }
        .nav-menu a:hover::after { width: 100%; }

        /* NAV ACTIONS */
        .nav-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .icon-btn {
            background: transparent;
            border: 1px solid var(--rule);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--ink);
            text-decoration: none;
            position: relative;
            transition: all var(--dur) var(--ease);
        }

        .icon-btn:hover {
            background: var(--ink);
            color: var(--paper);
            border-color: var(--ink);
        }

        .icon-btn svg {
            width: 16px;
            height: 16px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.8;
        }

        .cart-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: var(--accent);
            color: var(--paper);
            min-width: 20px;
            height: 20px;
            padding: 0 5px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-mono);
            font-size: 10px;
            font-weight: 600;
            border: 2px solid var(--paper);
        }

        .btn-login {
            background: transparent;
            color: var(--ink);
            border: 1px solid var(--ink);
            padding: 10px 22px;
            border-radius: 999px;
            cursor: pointer;
            font-family: var(--font-body);
            font-weight: 500;
            font-size: 13px;
            text-decoration: none;
            transition: all var(--dur) var(--ease);
            letter-spacing: 0.2px;
        }

        .btn-login:hover {
            background: var(--ink);
            color: var(--paper);
        }

        .btn-register {
            background: var(--ink);
            color: var(--paper);
            border: 1px solid var(--ink);
            padding: 10px 22px;
            border-radius: 999px;
            cursor: pointer;
            font-family: var(--font-body);
            font-weight: 500;
            font-size: 13px;
            text-decoration: none;
            transition: all var(--dur) var(--ease);
            letter-spacing: 0.2px;
        }

        .btn-register:hover {
            background: var(--sage-dark);
            border-color: var(--sage-dark);
            transform: translateY(-1px);
        }

        /* USER MENU */
        .user-menu { display: flex; gap: 12px; align-items: center; }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--ink);
            color: var(--paper);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-display);
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all var(--dur) var(--ease);
            border: 1.5px solid var(--ink);
        }

        .user-avatar:hover {
            background: var(--sage-dark);
            border-color: var(--sage-dark);
        }

        .dropdown { position: relative; display: inline-block; }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            background: var(--paper);
            min-width: 240px;
            box-shadow: 0 20px 60px rgba(15, 26, 20, 0.12);
            border: 1px solid var(--rule);
            z-index: 10;
            border-radius: 14px;
            margin-top: 12px;
            overflow: hidden;
            animation: slideDown 0.35s var(--ease);
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .dropdown-menu a,
        .dropdown-menu button {
            color: var(--ink);
            padding: 14px 20px;
            text-decoration: none;
            display: block;
            font-family: var(--font-body);
            font-size: 13.5px;
            font-weight: 500;
            border-bottom: 1px solid var(--rule);
            transition: all var(--dur) var(--ease);
            width: 100%;
            text-align: left;
            background: none;
            border-top: none;
            border-left: none;
            border-right: none;
            cursor: pointer;
        }

        .dropdown-menu a:last-child,
        .dropdown-menu form:last-child button { border-bottom: none; }

        .dropdown-menu a:hover {
            background: var(--paper-warm);
            padding-left: 26px;
        }

        .dropdown-menu button { color: var(--danger); }
        .dropdown-menu button:hover {
            background: #faebeb;
            padding-left: 26px;
        }

        .dropdown:hover .dropdown-menu { display: block; }

        /* =============================
           ALERTS
           ============================= */
        .alert {
            padding: 16px 20px;
            border-radius: 10px;
            margin-bottom: 16px;
            display: flex;
            gap: 12px;
            align-items: center;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid;
            font-family: var(--font-body);
        }

        .alert-success {
            background: var(--sage-light);
            color: var(--sage-dark);
            border-color: #c4d7ca;
        }

        .alert-error {
            background: #faebeb;
            color: var(--danger);
            border-color: #eacaca;
        }

        .alert svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
        }

        main { min-height: calc(100vh - 280px); }

        /* =============================
           FOOTER — Éditorial sombre
           ============================= */
        .footer {
            background: var(--ink);
            color: rgba(250, 247, 242, 0.7);
            padding: 80px 0 32px;
            margin-top: 120px;
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--accent), transparent);
        }

        .footer-top {
            display: grid;
            grid-template-columns: 1.5fr repeat(3, 1fr);
            gap: 56px;
            margin-bottom: 64px;
            padding-bottom: 56px;
            border-bottom: 1px solid rgba(250, 247, 242, 0.1);
        }

        .footer-brand .brand-name {
            font-family: var(--font-display);
            font-size: 32px;
            font-weight: 600;
            color: var(--paper);
            margin-bottom: 16px;
            letter-spacing: -1px;
            font-variation-settings: "opsz" 144;
        }

        .footer-brand p {
            font-size: 14px;
            line-height: 1.7;
            max-width: 320px;
            margin-bottom: 24px;
        }

        .footer-column h4 {
            font-family: var(--font-mono);
            color: var(--paper);
            margin-bottom: 24px;
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .footer-column ul { list-style: none; }
        .footer-column ul li { margin-bottom: 12px; }

        .footer-column a {
            color: rgba(250, 247, 242, 0.7);
            text-decoration: none;
            font-size: 13.5px;
            transition: all var(--dur) var(--ease);
            font-family: var(--font-body);
        }

        .footer-column a:hover {
            color: var(--accent);
            padding-left: 6px;
        }

        .footer-column p {
            font-size: 13.5px;
            margin-bottom: 10px;
            line-height: 1.7;
        }

        .footer-column p strong {
            color: var(--paper);
            font-weight: 500;
            display: block;
            font-family: var(--font-mono);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 2px;
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: rgba(250, 247, 242, 0.5);
            font-family: var(--font-mono);
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .nav-menu { gap: 24px; }
            .footer-top { grid-template-columns: 1fr 1fr; gap: 40px; }
        }

        @media (max-width: 768px) {
            .nav-menu { display: none; }
            .nav-wrapper { flex-wrap: wrap; gap: 12px; }
            .container { padding: 0 20px; }
            .footer-top { grid-template-columns: 1fr; gap: 32px; }
            .footer-bottom { flex-direction: column; gap: 12px; text-align: center; }
        }

        @media (max-width: 480px) {
            .logo-text .name { font-size: 18px; }
            .btn-login, .btn-register { padding: 8px 16px; font-size: 12px; }
        }

        @media (prefers-reduced-motion: reduce) {
            * { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; }
        }
    </style>
</head>
<body>
    {{-- HEADER --}}
    <header class="header">
        <nav class="navbar">
            <div class="container">
                <div class="nav-wrapper">
                    {{-- LOGO --}}
                    <a href="{{ route('index') }}" class="logo">
                        <span class="logo-mark">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 3v18M3 12h18" stroke-linecap="round"/>
                                <circle cx="12" cy="12" r="9"/>
                            </svg>
                        </span>
                        <span class="logo-text">
                            <span class="name">PharmaCare</span>
                            <span class="tag">Depuis 2024 · Fès</span>
                        </span>
                    </a>

                    {{-- NAV MENU --}}
                    <ul class="nav-menu">
                        <li><a href="{{ route('index') }}">Accueil</a></li>
                        <li><a href="{{ route('products.index') }}">Produits</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>

                    {{-- ACTIONS --}}
                    <div class="nav-actions">
                        <button class="icon-btn" title="Rechercher" aria-label="Rechercher">
                            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5" stroke-linecap="round"/></svg>
                        </button>

                        <a href="#" class="icon-btn" title="Panier" aria-label="Panier">
                            <svg viewBox="0 0 24 24"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4zM3 6h18M16 10a4 4 0 0 1-8 0" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <span class="cart-badge">0</span>
                        </a>

                        @if(Auth::check())
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
                            <a href="{{ route('login') }}" class="btn-login">Connexion</a>
                            <a href="{{ route('register') }}" class="btn-register">Inscription</a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    </header>

    {{-- ALERTS --}}
    @if ($errors->any())
        <div class="container" style="padding-top: 24px;">
            @foreach ($errors->all() as $error)
                <div class="alert alert-error">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01" stroke-linecap="round"/></svg>
                    <span>{{ $error }}</span>
                </div>
            @endforeach
        </div>
    @endif

    @if (session('success'))
        <div class="container" style="padding-top: 24px;">
            <div class="alert alert-success">
                <svg viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="container" style="padding-top: 24px;">
            <div class="alert alert-error">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01" stroke-linecap="round"/></svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    {{-- MAIN --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer id="contact" class="footer">
        <div class="container">
            <div class="footer-top">
                <div class="footer-brand">
                    <div class="brand-name">PharmaCare</div>
                    <p>Votre pharmacie de confiance, pensée pour vous accompagner dans votre santé au quotidien. Conseils experts et produits sélectionnés.</p>
                </div>

                <div class="footer-column">
                    <h4>Navigation</h4>
                    <ul>
                        <li><a href="#">Qui sommes-nous</a></li>
                        <li><a href="#">Notre mission</a></li>
                        <li><a href="#">Nos pharmaciens</a></li>
                        <li><a href="#">Carrières</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Suivi commande</a></li>
                        <li><a href="#">Retours</a></li>
                        <li><a href="#">Nous contacter</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4>Contact</h4>
                    <p><strong>Téléphone</strong>+212 5XX XXX XXX</p>
                    <p><strong>Email</strong>contact@pharmacare.ma</p>
                    <p><strong>Adresse</strong>Fès, Maroc</p>
                    <p><strong>Horaires</strong>Lun–Dim · 8h–20h</p>
                </div>
            </div>

            <div class="footer-bottom">
                <span>© 2026 PharmaCare</span>
                <span>Tous droits réservés</span>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/pharmacy.js') }}"></script>
    @yield('scripts')
</body>
</html>