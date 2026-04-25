<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0f1a14">
    <title>@yield('title', 'PharmaCare - Votre pharmacie de confiance')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700;9..144,800&family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/pharmacy.css') }}">

    <style>
        .header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(250, 247, 242, 0.92);
            backdrop-filter: saturate(180%) blur(12px);
            border-bottom: 1px solid var(--rule);
        }

        .navbar {
            padding: 18px 0;
        }

        .nav-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 14px;
            color: var(--ink);
        }

        .logo-mark {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 1.5px solid var(--ink);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-mark svg {
            width: 20px;
            height: 20px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.7;
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
            letter-spacing: -0.4px;
        }

        .logo-text .tag {
            margin-top: 4px;
            font-family: var(--font-mono);
            font-size: 9px;
            color: var(--muted);
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 32px;
            list-style: none;
            flex: 1;
            justify-content: center;
        }

        .nav-menu a {
            color: var(--ink);
            font-size: 14px;
            font-weight: 500;
            position: relative;
            padding-bottom: 6px;
        }

        .nav-menu a::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 0;
            height: 1px;
            background: var(--ink);
            transition: width var(--dur) var(--ease);
            transform: translateX(-50%);
        }

        .nav-menu a:hover::after {
            width: 100%;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .icon-btn {
            position: relative;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 1px solid var(--rule);
            background: transparent;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ink);
            transition: all var(--dur) var(--ease);
        }

        .icon-btn:hover {
            background: var(--ink);
            color: var(--paper);
            border-color: var(--ink);
        }

        .icon-btn svg {
            width: 17px;
            height: 17px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.8;
        }

        .cart-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            min-width: 20px;
            height: 20px;
            padding: 0 5px;
            border-radius: 999px;
            background: var(--accent);
            color: var(--paper);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-mono);
            font-size: 10px;
            font-weight: 600;
            border: 2px solid var(--paper);
        }

        .btn-login,
        .btn-register {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 42px;
            padding: 0 20px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 500;
            transition: all var(--dur) var(--ease);
            border: 1px solid var(--ink);
        }

        .btn-login {
            color: var(--ink);
            background: transparent;
        }

        .btn-login:hover {
            background: var(--ink);
            color: var(--paper);
        }

        .btn-register {
            color: var(--paper);
            background: var(--ink);
        }

        .btn-register:hover {
            background: var(--sage-dark);
            border-color: var(--sage-dark);
            color: var(--paper);
        }

        .dropdown {
            position: relative;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--ink);
            color: var(--paper);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-display);
            font-weight: 600;
            border: 1px solid var(--ink);
        }

        .dropdown-menu {
            position: absolute;
            right: 0;
            top: calc(100% + 10px);
            min-width: 240px;
            background: var(--paper);
            border: 1px solid var(--rule);
            border-radius: 14px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            display: none;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu a,
        .dropdown-menu button {
            width: 100%;
            padding: 14px 18px;
            border: none;
            border-bottom: 1px solid var(--rule);
            background: transparent;
            text-align: left;
            font-size: 13.5px;
            font-weight: 500;
            color: var(--ink);
        }

        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            background: var(--paper-warm);
            color: var(--ink);
        }

        .dropdown-menu form:last-child button,
        .dropdown-menu a:last-child {
            border-bottom: none;
        }

        .alert {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 22px;
            padding: 15px 18px;
            border-radius: 12px;
            border: 1px solid;
            font-size: 14px;
            font-weight: 500;
        }

        .alert svg {
            width: 18px;
            height: 18px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            flex-shrink: 0;
        }

        .alert-success {
            background: var(--sage-light);
            color: var(--sage-dark);
            border-color: #c4d7ca;
        }

        .alert-error {
            background: #faebeb;
            color: var(--danger);
            border-color: #e9c8c8;
        }

        main {
            min-height: calc(100vh - 320px);
        }

        .footer {
            margin-top: 96px;
            background: var(--ink);
            color: rgba(250, 247, 242, 0.75);
            padding: 72px 0 30px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.4fr repeat(3, 1fr);
            gap: 36px;
            padding-bottom: 36px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .footer-brand h3 {
            font-family: var(--font-display);
            font-size: 30px;
            color: var(--paper);
            margin-bottom: 14px;
        }

        .footer h4 {
            font-family: var(--font-mono);
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--paper);
            margin-bottom: 18px;
        }

        .footer ul {
            list-style: none;
        }

        .footer li + li {
            margin-top: 10px;
        }

        .footer a {
            color: rgba(250, 247, 242, 0.75);
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding-top: 22px;
            font-family: var(--font-mono);
            font-size: 11px;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        @media (max-width: 960px) {
            .nav-wrapper {
                flex-wrap: wrap;
            }

            .nav-menu {
                order: 3;
                width: 100%;
                justify-content: flex-start;
                gap: 18px;
                overflow-x: auto;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 640px) {
            .container {
                padding: 0 20px;
            }

            .nav-actions {
                width: 100%;
                justify-content: flex-end;
                flex-wrap: wrap;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }

            .footer-bottom {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <div class="container">
                <div class="nav-wrapper">
                    <a href="{{ route('index') }}" class="logo">
                        <span class="logo-mark">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 3v18M3 12h18" stroke-linecap="round" />
                                <circle cx="12" cy="12" r="9" />
                            </svg>
                        </span>
                        <span class="logo-text">
                            <span class="name">PharmaCare</span>
                            <span class="tag">Catalogue et commande</span>
                        </span>
                    </a>

                    <ul class="nav-menu">
                        <li><a href="{{ route('index') }}">Accueil</a></li>
                        <li><a href="{{ route('products.index') }}">Produits</a></li>
                        @auth
                            <li><a href="{{ route('dashboard') }}">Mon compte</a></li>
                            <li><a href="{{ route('orders.index') }}">Mes commandes</a></li>
                        @endauth
                    </ul>

                    <div class="nav-actions">
                        <a href="{{ route('products.index') }}" class="icon-btn" title="Catalogue" aria-label="Catalogue">
                            <svg viewBox="0 0 24 24">
                                <path d="M4 6h16M4 12h16M4 18h10" stroke-linecap="round" />
                            </svg>
                        </a>

                        <a href="{{ route('cart.index') }}" class="icon-btn" title="Panier" aria-label="Panier">
                            <svg viewBox="0 0 24 24">
                                <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4zM3 6h18M16 10a4 4 0 0 1-8 0" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            @if(($cartItemCount ?? 0) > 0)
                                <span class="cart-badge">{{ $cartItemCount }}</span>
                            @endif
                        </a>

                        @auth
                            <div class="dropdown">
                                <div class="user-avatar" title="Menu utilisateur">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div class="dropdown-menu">
                                    <a href="{{ route('dashboard') }}">Mon compte</a>
                                    <a href="{{ route('cart.index') }}">Mon panier</a>
                                    <a href="{{ route('orders.index') }}">Mes commandes</a>
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('admin.dashboard') }}">Administration</a>
                                    @endif
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit">Deconnexion</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="btn-login">Connexion</a>
                            <a href="{{ route('register') }}" class="btn-register">Inscription</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-error">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 8v4M12 16h.01" stroke-linecap="round" />
                    </svg>
                    <span>{{ $error }}</span>
                </div>
            @endforeach
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                <svg viewBox="0 0 24 24">
                    <path d="M20 6 9 17l-5-5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M12 8v4M12 16h.01" stroke-linecap="round" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif
    </div>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <h3>PharmaCare</h3>
                    <p>Votre pharmacie de confiance pour commander vos produits, suivre vos achats et acceder a un catalogue clair et moderne.</p>
                </div>

                <div>
                    <h4>Navigation</h4>
                    <ul>
                        <li><a href="{{ route('index') }}">Accueil</a></li>
                        <li><a href="{{ route('products.index') }}">Produits</a></li>
                        <li><a href="{{ route('cart.index') }}">Panier</a></li>
                        <li><a href="{{ route('orders.index') }}">Commandes</a></li>
                    </ul>
                </div>

                <div>
                    <h4>Compte</h4>
                    <ul>
                        <li><a href="{{ route('login') }}">Connexion</a></li>
                        <li><a href="{{ route('register') }}">Inscription</a></li>
                        <li><a href="{{ route('dashboard') }}">Espace client</a></li>
                    </ul>
                </div>

                <div>
                    <h4>Contact</h4>
                    <ul>
                        <li>Telephone : +212 5XX XXX XXX</li>
                        <li>Email : contact@pharmacare.ma</li>
                        <li>Ville : Fes, Maroc</li>
                        <li>Horaires : 8h00 - 20h00</li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <span>PharmaCare 2026</span>
                <span>Tous droits reserves</span>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>