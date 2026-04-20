<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0f1a14">
    <title>@yield('title', 'Administration') — PharmaCare</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div class="admin-shell">

    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <span class="brand-mark">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                    <circle cx="12" cy="12" r="9"/>
                    <path d="M12 3v18M3 12h18" stroke-linecap="round"/>
                </svg>
            </span>
            <span class="brand-text">
                <span class="brand-name">PharmaCare</span>
                <span class="brand-tag">Back-office</span>
            </span>
        </a>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <span class="nav-label">Général</span>
                <ul>
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                           class="{{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/>
                                <rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/>
                            </svg>
                            Tableau de bord
                        </a>
                    </li>
                </ul>
            </div>

            <div class="nav-section">
                <span class="nav-label">Catalogue</span>
                <ul>
                    <li>
                        <a href="{{ route('admin.products.index') }}"
                           class="{{ request()->routeIs('admin.products.*') ? 'is-active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m21 16-9 5-9-5V8l9-5 9 5zM3.3 7 12 12l8.7-5M12 22V12"/>
                            </svg>
                            Produits
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 7h16M4 12h16M4 17h10"/>
                            </svg>
                            Catégories
                        </a>
                    </li>
                </ul>
            </div>

            <div class="nav-section">
                <span class="nav-label">Commerce</span>
                <ul>
                    <li>
                        <a href="#">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4zM3 6h18M16 10a4 4 0 0 1-8 0"/>
                            </svg>
                            Commandes
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                            Clients
                        </a>
                    </li>
                </ul>
            </div>

            <div class="nav-section">
                <span class="nav-label">Système</span>
                <ul>
                    <li>
                        <a href="#">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="3"/>
                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>
                            </svg>
                            Paramètres
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="sidebar-user">
            <div class="user-chip">
                <div class="chip-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div class="chip-info">
                    <span class="chip-name">{{ auth()->user()->name }}</span>
                    <span class="chip-role">Administrateur</span>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="chip-logout" title="Déconnexion" aria-label="Déconnexion">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/>
                    </svg>
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="admin-main">
        <header class="topbar">
            <div class="topbar-left">
                @yield('breadcrumbs')
            </div>
            <div class="topbar-right">
                <div class="search-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round">
                        <circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/>
                    </svg>
                    <input type="search" placeholder="Rechercher...">
                    <kbd>⌘K</kbd>
                </div>
                <button class="icon-btn" title="Notifications" aria-label="Notifications">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 0 1-3.46 0"/>
                    </svg>
                    <span class="dot"></span>
                </button>
                <a href="{{ route('index') }}" class="btn-ghost" target="_blank">
                    Voir le site
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M7 17 17 7M7 7h10v10"/>
                    </svg>
                </a>
            </div>
        </header>

        <div class="admin-content">
            @if (session('success'))
                <div class="flash flash-success">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 6 9 17l-5-5"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="flash flash-error">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                        <circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/>
                    </svg>
                    <div>
                        @foreach ($errors->all() as $e) <div>{{ $e }}</div> @endforeach
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>
@yield('scripts')
</body>
</html>