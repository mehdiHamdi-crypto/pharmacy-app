<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Administration') - PharmaCare</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div class="admin-shell">
    <aside class="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <span class="brand-mark">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                    <circle cx="12" cy="12" r="9" />
                    <path d="M12 3v18M3 12h18" stroke-linecap="round" />
                </svg>
            </span>
            <span class="brand-text">
                <span class="brand-name">PharmaCare</span>
                <span class="brand-tag">Back office</span>
            </span>
        </a>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <span class="nav-label">General</span>
                <ul>
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="7" height="9" />
                                <rect x="14" y="3" width="7" height="5" />
                                <rect x="14" y="12" width="7" height="9" />
                                <rect x="3" y="16" width="7" height="5" />
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
                        <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'is-active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m21 16-9 5-9-5V8l9-5 9 5zM3.3 7 12 12l8.7-5M12 22V12" />
                            </svg>
                            Produits
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.stock.index') }}" class="{{ request()->routeIs('admin.stock.*') ? 'is-active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 7H4M20 12H4M20 17H4" />
                                <circle cx="8" cy="7" r="1.5" />
                                <circle cx="16" cy="12" r="1.5" />
                                <circle cx="10" cy="17" r="1.5" />
                            </svg>
                            Stock
                            @if(($adminSidebarStats['low_stock'] ?? 0) > 0)
                                <span style="margin-left:auto; padding:4px 8px; border-radius:999px; background:rgba(184, 118, 63, 0.15); color:var(--accent); font-size:11px; font-family:var(--font-mono);">
                                    {{ $adminSidebarStats['low_stock'] }}
                                </span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'is-active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 7h16M4 12h16M4 17h10" />
                            </svg>
                            Categories
                        </a>
                    </li>
                </ul>
            </div>

            <div class="nav-section">
                <span class="nav-label">Commerce</span>
                <ul>
                    <li>
                        <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'is-active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4zM3 6h18M16 10a4 4 0 0 1-8 0" />
                            </svg>
                            Commandes
                            @if(($adminSidebarStats['pending_orders'] ?? 0) > 0)
                                <span style="margin-left:auto; padding:4px 8px; border-radius:999px; background:rgba(61, 107, 86, 0.18); color:var(--sage-light); font-size:11px; font-family:var(--font-mono);">
                                    {{ $adminSidebarStats['pending_orders'] }}
                                </span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'is-active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                            Utilisateurs
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
                    <span class="chip-role">{{ auth()->user()->role }}</span>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="chip-logout" title="Deconnexion" aria-label="Deconnexion">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9" />
                    </svg>
                </button>
            </form>
        </div>
    </aside>

    <div class="admin-main">
        <header class="topbar">
            <div class="topbar-left">
                @yield('breadcrumbs')
            </div>

            <div class="topbar-right">
                <form action="{{ route('admin.products.index') }}" method="GET" class="search-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round">
                        <circle cx="11" cy="11" r="7" />
                        <path d="m20 20-3.5-3.5" />
                    </svg>
                    <input type="search" name="q" placeholder="Rechercher un produit..." value="{{ request('q') }}">
                    <kbd>/</kbd>
                </form>

                <a href="{{ route('index') }}" class="btn-ghost" target="_blank">
                    Voir le site
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M7 17 17 7M7 7h10v10" />
                    </svg>
                </a>
            </div>
        </header>

        <div class="admin-content">
            @if (session('success'))
                <div class="flash flash-success">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 6 9 17l-5-5" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="flash flash-error">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 8v4M12 16h.01" />
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="flash flash-error">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 8v4M12 16h.01" />
                    </svg>
                    <div>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
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