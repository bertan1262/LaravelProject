<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mağaza')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f8fafc; }
        .navbar { background: #1e293b !important; }
        .navbar-brand { font-weight: 800; font-size: 1.3rem; color: #fff !important; }
        .nav-link { color: rgba(255,255,255,0.75) !important; }
        .nav-link:hover { color: #fff !important; }
        .product-card { transition: transform 0.2s, box-shadow 0.2s; border: 1px solid #e2e8f0; border-radius: 0.75rem; overflow: hidden; }
        .product-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,0.1); }
        .product-card img { height: 200px; object-fit: cover; }
        .price-badge { font-size: 1.1rem; font-weight: 700; color: #1e293b; }
        .discount-badge { background: #ef4444; color: #fff; font-size: 0.72rem; font-weight: 700; border-radius: 50px; padding: 2px 8px; }
        footer { background: #1e293b; color: rgba(255,255,255,0.6); }
        .search-bar { max-width: 360px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('shop.index') }}">
            <i class="bi bi-shop me-1"></i> Mağaza
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a href="{{ route('shop.index') }}" class="nav-link">Anasayfa</a></li>
                <li class="nav-item"><a href="{{ route('shop.products') }}" class="nav-link">Ürünler</a></li>
            </ul>

            {{-- Arama --}}
            <form action="{{ route('shop.products') }}" method="GET" class="d-flex search-bar me-3">
                <input type="text" name="q" class="form-control form-control-sm rounded-start-pill"
                       placeholder="Ürün ara..." value="{{ request('q') }}">
                <button type="submit" class="btn btn-primary btn-sm rounded-end-pill">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm">
                <i class="bi bi-grid me-1"></i>Admin
            </a>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

<footer class="mt-5 py-4">
    <div class="container text-center">
        <p class="mb-0 small">© {{ date('Y') }} Mağaza. Tüm hakları saklıdır.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
