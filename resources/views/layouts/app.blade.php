<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PharmaCare - Votre Pharmacie en Ligne')</title>
    <link rel="stylesheet" href="{{ asset('css/pharmacy.css') }}">
    <style>
        :root {
            --primary-color: #10b981;
            --primary-dark: #059669;
            --primary-light: #d1fae5;
            --secondary-color: #3b82f6;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --border-color: #e5e7eb;
            --bg-light: #f9fafb;
            --white: #ffffff;
            --danger: #ef4444;
            --success: #10b981;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: var(--white);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* HEADER */
        .header {
            background: var(--white);
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .navbar {
            padding: 15px 0;
        }

        .nav-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
        }

        .logo-icon {
            font-size: 28px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 40px;
        }

        .nav-menu a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-menu a:hover {
            color: var(--primary-color);
        }

        .nav-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .btn-search {
            background: var(--bg-light);
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            transition: background 0.3s ease;
        }

        .btn-search:hover {
            background: var(--border-color);
        }

        .btn-cart {
            position: relative;
            background: var(--bg-light);
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            transition: background 0.3s ease;
        }

        .btn-cart:hover {
            background: var(--border-color);
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--danger);
            color: var(--white);
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        .btn-login, .btn-register {
            background: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.3s ease;
            display: inline-block;
        }

        .btn-login:hover, .btn-register:hover {
            background: var(--primary-dark);
        }

        .user-menu {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-color);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
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
            min-width: 200px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            z-index: 1;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            margin-top: 10px;
        }

        .dropdown-menu a, .dropdown-menu form {
            color: var(--text-dark);
            padding: 12px 20px;
            text-decoration: none;
            display: block;
            transition: background 0.3s ease;
        }

        .dropdown-menu a:hover {
            background: var(--bg-light);
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        /* ALERTS */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
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

        /* FOOTER */
        .footer {
            background: var(--text-dark);
            color: rgba(255, 255, 255, 0.8);
            padding: 60px 0 20px;
            margin-top: 60px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-column h4 {
            color: var(--white);
            margin-bottom: 20px;
            font-size: 16px;
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column ul li {
            margin-bottom: 12px;
        }

        .footer-column a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-column a:hover {
            color: var(--primary-color);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 30px;
            text-align: center;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .nav-menu {
                gap: 20px;
            }

            .nav-actions {
                flex-direction: column;
                gap: 10px;
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
                    <a href="{{ route('index') }}" class="logo">
                        <span class="logo-icon">⚕️</span>
                        <span>PharmaCare</span>
                    </a>
                    <ul class="nav-menu">
                        <li><a href="{{ route('index') }}">Accueil</a></li>
                        <li><a href="#produits">Produits</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                    <div class="nav-actions">
                        <button class="btn-search">🔍</button>
                        <button class="btn-cart">🛒 <span class="cart-badge">0</span></button>
                        
                        @if(Auth::check())
                            <div class="dropdown">
                                <div class="user-avatar">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div class="dropdown-menu">
                                    <a href="#">📊 Mon Compte</a>
                                    <a href="#">📦 Mes Commandes</a>
                                    <a href="#">❤️ Favoris</a>
                                    <a href="#">⚙️ Paramètres</a>
                                    <form action="{{ route('logout') }}" method="POST" style="padding: 0;">
                                        @csrf
                                        <button type="submit" style="width: 100%; text-align: left; background: none; border: none; padding: 12px 20px; cursor: pointer;">🚪 Déconnexion</button>
                                    </form>
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

    <!-- MAIN CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer id="contact" class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-column">
                    <h4>À Propos</h4>
                    <ul>
                        <li><a href="#">Qui sommes-nous</a></li>
                        <li><a href="#">Notre mission</a></li>
                        <li><a href="#">Nos pharmaciens</a></li>
                        <li><a href="#">Carrières</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Aide</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Suivi commande</a></li>
                        <li><a href="#">Retours</a></li>
                        <li><a href="#">Support client</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Légal</h4>
                    <ul>
                        <li><a href="#">Conditions générales</a></li>
                        <li><a href="#">Politique confidentialité</a></li>
                        <li><a href="#">Gestion cookies</a></li>
                        <li><a href="#">Mentions légales</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Contact</h4>
                    <p>📞 +212 5XX XXX XXX</p>
                    <p>📧 contact@pharmacare.ma</p>
                    <p>📍 FES, Morocco</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 PharmaCare. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/pharmacy.js') }}"></script>
    @yield('scripts')
</body>
</html>