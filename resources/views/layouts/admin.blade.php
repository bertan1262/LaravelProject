<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') — Yönetim</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>

<!-- ===================== SIDEBAR ===================== -->
<nav id="sidebar">
    <a href="{{ route('admin.product.index') }}" class="sidebar-brand">
        <i class="bi bi-shop"></i> Admin Panel
    </a>

    <div class="sidebar-section">Menü</div>

    <a href="{{ route('admin.product.index') }}"
       class="nav-link {{ request()->routeIs('admin.product.*') ? 'active' : '' }}">
        <i class="bi bi-box-seam"></i> Ürünler
    </a>

    <a href="{{ route('admin.category.index') }}"
       class="nav-link {{ request()->routeIs('admin.category.*') ? 'active' : '' }}">
        <i class="bi bi-grid"></i> Kategoriler
    </a>
    <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
        <i class="bi bi-people"></i> Kullanıcılar
    </a>
    <a href="{{ route('admin.stats') }}" class="nav-link {{ request()->routeIs('admin.stats') ? 'active' : '' }}">
        <i class="bi bi-bar-chart"></i> İstatistikler
    </a>

    <div class="mt-auto">
        <div class="sidebar-section">Sistem</div>
        <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
            <i class="bi bi-gear"></i> Ayarlar
        </a>
    </div>
</nav>

<!-- ===================== ANA İÇERİK ===================== -->
<div id="main-content">

    <!-- Topbar -->
    <div class="topbar">
        <span class="topbar-title">@yield('page-title', 'Yönetim Paneli')</span>
        <div class="d-flex align-items-center gap-3">
            <span class="text-muted small"><i class="bi bi-person-circle me-1"></i>{{ auth()->user()?->name ?? 'Admin' }}</span>
            <a href="{{ route('shop.index') }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-shop me-1"></i>Siteyi Gör
            </a>
            <form action="{{ route('admin.logout') }}" method="POST" class="mb-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-box-arrow-right me-1"></i>Çıkış
                </button>
            </form>
        </div>
    </div>

    <!-- Flash Mesajlar -->
    <div class="px-4 pt-3">
        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center gap-2 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center gap-2 shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span>{{ session('error') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger shadow-sm">
                <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i>Lütfen hataları düzeltin:</div>
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Sayfa İçeriği -->
    <div class="page-body">
        @yield('content')
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
