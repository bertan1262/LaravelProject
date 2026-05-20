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

    <style>
        body { background: #f4f6f9; font-family: 'Segoe UI', sans-serif; }

        /* Sidebar */
        #sidebar {
            width: 250px;
            min-height: 100vh;
            background: #1e293b;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
            display: flex;
            flex-direction: column;
        }

        #sidebar .sidebar-brand {
            padding: 1.5rem 1.25rem;
            background: #0f172a;
            color: #fff;
            font-size: 1.1rem;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        #sidebar .nav-link {
            color: #94a3b8;
            padding: 0.75rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.9rem;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        #sidebar .nav-link:hover,
        #sidebar .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,0.05);
            border-left-color: #6366f1;
        }

        #sidebar .sidebar-section {
            padding: 0.5rem 1.25rem 0.25rem;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #475569;
            letter-spacing: 0.08em;
            margin-top: 0.5rem;
        }

        /* Main */
        #main-content {
            margin-left: 250px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Topbar */
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.875rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .topbar-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
        }

        /* Page */
        .page-body { padding: 1.5rem; flex: 1; }

        /* Card */
        .admin-card {
            background: #fff;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .admin-card .card-header {
            background: transparent;
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 1.25rem;
            font-weight: 600;
            color: #1e293b;
            border-radius: 0.75rem 0.75rem 0 0 !important;
        }

        /* Tablo */
        .admin-table th {
            background: #f8fafc;
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            border-bottom: 2px solid #e2e8f0;
            white-space: nowrap;
        }

        .admin-table td { vertical-align: middle; color: #334155; }
        .admin-table tbody tr:hover { background: #f8faff; }

        /* Form */
        .form-label { font-weight: 600; font-size: 0.875rem; color: #374151; }
        .form-control, .form-select {
            border-radius: 0.5rem;
            border-color: #d1d5db;
            font-size: 0.9rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
        }

        /* Butonlar */
        .btn-admin-primary   { background: #6366f1; border-color: #6366f1; color: #fff; }
        .btn-admin-primary:hover { background: #4f46e5; border-color: #4f46e5; color: #fff; }

        /* Badge */
        .status-badge {
            font-size: 0.72rem;
            padding: 0.25rem 0.6rem;
            border-radius: 50px;
            font-weight: 600;
        }

        /* Resim önizleme */
        .img-thumbnail { max-height: 60px; border-radius: 0.5rem; }

        /* Alert */
        .alert { border-radius: 0.625rem; border: none; }
    </style>
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
    <a href="#" class="nav-link">
        <i class="bi bi-people"></i> Kullanıcılar
    </a>
    <a href="#" class="nav-link">
        <i class="bi bi-bar-chart"></i> İstatistikler
    </a>

    <div class="mt-auto">
        <div class="sidebar-section">Sistem</div>
        <a href="#" class="nav-link">
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
</body>
</html>
