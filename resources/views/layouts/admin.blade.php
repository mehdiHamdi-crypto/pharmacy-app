{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — PharmaAdmin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>
<body>

{{-- Modal suppression global --}}
<div class="modal-overlay" id="deleteModal">
    <div class="modal-box">
        <div class="modal-icon"><i class="fas fa-trash-alt"></i></div>
        <p class="modal-title">Confirmer la suppression</p>
        <p class="modal-text" id="deleteModalMessage">
            Cette action est irréversible. Voulez-vous vraiment supprimer cet élément ?
        </p>
        <div class="modal-actions">
            <button class="btn btn-outline" onclick="closeDeleteModal()">
                <i class="fas fa-times"></i> Annuler
            </button>
            <form id="deleteModalForm" method="POST" style="flex:1">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" style="width:100%;justify-content:center">
                    <i class="fas fa-trash-alt"></i> Supprimer
                </button>
            </form>
        </div>
    </div>
</div>
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<div class="admin-layout">

    {{-- SIDEBAR --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">💊</div>
            <div>
                <div class="brand-name">PharmaAdmin</div>
                <div class="brand-sub">Tableau de bord</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Principal</div>
            <a href="{{ route('admin.dashboard') }}"
               class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
                Dashboard
            </a>

            <div class="nav-section-label">Catalogue</div>
            <a href="{{ route('admin.products.index') }}"
               class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-pills"></i></span>
                Produits
            </a>
            <a href="{{ route('admin.stock.index') }}"
               class="nav-item {{ request()->routeIs('admin.stock.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-warehouse"></i></span>
                Stock
                @if(isset($lowStockCount) && $lowStockCount > 0)
                    <span class="nav-badge badge-warning">{{ $lowStockCount }}</span>
                @endif
            </a>

            <div class="nav-section-label">Ventes</div>
            <a href="{{ route('admin.orders.index') }}"
               class="nav-item {{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-file-prescription"></i></span>
                Ordonnances
                @if(isset($pendingOrders) && $pendingOrders > 0)
                    <span class="nav-badge">{{ $pendingOrders }}</span>
                @endif
            </a>
            <a href="{{ route('admin.orders.history') }}"
               class="nav-item {{ request()->routeIs('admin.orders.history') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-history"></i></span>
                Historique
            </a>

            <div class="nav-section-label">Gestion</div>
            <a href="{{ route('admin.users.index') }}"
               class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-users"></i></span>
                Utilisateurs
            </a>
            <a href="{{ route('admin.categories.index') }}"
               class="nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-tags"></i></span>
                Catégories
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-card">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="user-info">
                    <div class="user-name">{{ auth()->user()->name ?? 'Administrateur' }}</div>
                    <div class="user-role">Admin</div>
                </div>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   style="margin-left:auto;color:#3d5166;font-size:.8rem;" title="Déconnexion">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>
        </div>
    </aside>

    {{-- MAIN WRAPPER --}}
    <div class="main-wrapper">

        <header class="topbar">
            <div class="flex items-center gap-3">
                <button class="sidebar-toggle" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="topbar-left">
                    <span class="topbar-title">@yield('page-title', 'Dashboard')</span>
                    <nav class="breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Accueil</a>
                        <span class="breadcrumb-sep">›</span>
                        @yield('breadcrumb')
                    </nav>
                </div>
            </div>
            <div class="topbar-actions">
                <form action="{{ route('admin.products.index') }}" method="GET">
                    <div class="search-box" style="max-width:220px">
                        <i class="fas fa-search"></i>
                        <input type="text" name="search" placeholder="Rechercher..." value="{{ request('search') }}">
                    </div>
                </form>
                <button class="topbar-btn" title="Alertes stock">
                    <i class="fas fa-bell"></i>
                    @if(isset($lowStockCount) && $lowStockCount > 0)
                        <span class="notif-dot"></span>
                    @endif
                </button>
                <div class="topbar-divider"></div>
                <div class="user-avatar" style="font-size:.75rem">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
            </div>
        </header>

        @if(session('success'))
            <div style="padding:0 28px;padding-top:16px">
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            </div>
        @endif
        @if(session('error'))
            <div style="padding:0 28px;padding-top:16px">
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            </div>
        @endif

        <main class="page-content">
            @yield('content')
        </main>
    </div>
</div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
    document.getElementById('sidebarOverlay').classList.toggle('show');
}
function confirmDelete(url, message) {
    document.getElementById('deleteModalForm').action = url;
    document.getElementById('deleteModalMessage').textContent =
        message || 'Cette action est irréversible. Voulez-vous vraiment supprimer cet élément ?';
    document.getElementById('deleteModal').classList.add('open');
}
function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('open');
}
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});
setTimeout(() => {
    document.querySelectorAll('.alert').forEach(el => {
        el.style.transition = 'opacity .4s';
        el.style.opacity = '0';
        setTimeout(() => el.remove(), 400);
    });
}, 4000);
</script>
@stack('scripts')
</body>
</html>