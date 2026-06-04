<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel')</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Localized Bootstrap and Icons -->
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/adminlte.min.css') }}">
    <style>
        .app-sidebar .nav-icon { margin-right: 0.5rem; }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">
    <!-- Navbar -->
    <nav class="app-header navbar navbar-expand bg-body">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"><i class="bi bi-list fs-4"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item me-3">
                    <span class="text-muted d-flex align-items-center"><i class="bi bi-person-circle fs-5 me-2"></i> {{ auth()->user()?->name ?? 'Admin' }}</span>
                </li>
                <li class="nav-item me-2">
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('shop.index') }}" target="_blank">
                        <i class="bi bi-shop"></i> Siteyi Gör
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('admin.logout') }}" method="POST" class="mb-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-box-arrow-right"></i> Çıkış
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="app-sidebar bg-dark shadow" data-bs-theme="dark">
        <!-- Brand Logo -->
        <div class="sidebar-brand p-3 text-center border-bottom border-secondary">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-white fs-4 fw-bold">
                <i class="bi bi-kanban"></i> AdminLTE
            </a>
        </div>
        
        <!-- Sidebar -->
        <div class="sidebar-wrapper">
            <nav class="mt-3">
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                    <li class="nav-header text-uppercase text-secondary small fw-bold px-3 py-2">Menü</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-speedometer2"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.order.index') }}" class="nav-link {{ request()->routeIs('admin.order.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-cart-check"></i>
                            <p>Siparişler</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.product.index') }}" class="nav-link {{ request()->routeIs('admin.product.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-box-seam"></i>
                            <p>Ürünler</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.category.index') }}" class="nav-link {{ request()->routeIs('admin.category.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-grid"></i>
                            <p>Kategoriler</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-people"></i>
                            <p>Kullanıcılar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.stats') }}" class="nav-link {{ request()->routeIs('admin.stats') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-bar-chart"></i>
                            <p>İstatistikler</p>
                        </a>
                    </li>
                    
                    <li class="nav-header text-uppercase text-secondary small fw-bold px-3 py-2 mt-2">Sistem</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-gear"></i>
                            <p>Ayarlar</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <main class="app-main">
        <div class="app-content-header py-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0 fw-bold">@yield('page-title', 'Yönetim Paneli')</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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
                
                @yield('content')
            </div>
        </div>
    </main>

    <footer class="app-footer">
        <div class="float-end d-none d-sm-inline text-muted small">
            Laravel E-Commerce
        </div>
        <strong class="text-muted small">Copyright &copy; {{ date('Y') }} Mağaza. Tüm hakları saklıdır.</strong>
    </footer>
</div>

<script src="{{ asset('vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/js/adminlte.min.js') }}"></script>

@stack('scripts')
</body>
</html>
