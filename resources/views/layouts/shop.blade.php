<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mağaza')</title>
    <link href="{{ asset('vendor/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/shop.css') }}" rel="stylesheet">
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

<script src="{{ asset('vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
@stack('scripts')
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
