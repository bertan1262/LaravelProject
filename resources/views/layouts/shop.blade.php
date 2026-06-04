<!DOCTYPE html>
<html lang="tr" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mağaza')</title>
    
    <!-- Google Fonts: Outfit & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap & Icons -->
    <link href="{{ asset('vendor/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet">
    
    <!-- Custom Theme CSS -->
    <link href="{{ asset('css/shop.css') }}" rel="stylesheet">

    <!-- Dark Mode Init Script -->
    <script>
        const storedTheme = localStorage.getItem('theme') || (window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light");
        if (storedTheme) document.documentElement.setAttribute('data-bs-theme', storedTheme);
    </script>
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg sticky-top glass-navbar py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('shop.index') }}">
            <div class="brand-icon-wrapper">
                <i class="bi bi-layers-half"></i>
            </div>
            <span class="brand-text">Mağaza</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto ms-4 gap-2">
                <li class="nav-item"><a href="{{ route('shop.index') }}" class="nav-link {{ request()->routeIs('shop.index') ? 'active' : '' }}">Anasayfa</a></li>
                <li class="nav-item"><a href="{{ route('shop.products') }}" class="nav-link {{ request()->routeIs('shop.products') ? 'active' : '' }}">Koleksiyon</a></li>
            </ul>

            {{-- Arama --}}
            <form action="{{ route('shop.products') }}" method="GET" class="d-flex search-wrapper me-4">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="q" class="form-control border-start-0 ps-0 shadow-none" placeholder="Ürün ara..." value="{{ request('q') }}">
                </div>
            </form>

            <div class="d-flex align-items-center gap-3">
                <!-- Theme Toggle -->
                <button class="btn btn-theme-toggle rounded-circle" id="themeToggleBtn" aria-label="Toggle Theme">
                    <i class="bi bi-moon-stars-fill dark-icon"></i>
                    <i class="bi bi-sun-fill light-icon"></i>
                </button>

                @php
                    $cartCount = 0;
                    if(session('cart')) {
                        foreach(session('cart') as $item) {
                            $cartCount += $item['quantity'];
                        }
                    }
                @endphp
                <a href="{{ route('shop.cart.index') }}" class="btn btn-cart position-relative">
                    <i class="bi bi-bag"></i> 
                    @if($cartCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm">
                        {{ $cartCount }}
                    </span>
                    @endif
                </a>

                <div class="vr mx-1 opacity-25"></div>

                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary rounded-pill px-4 fw-medium btn-admin">
                    <i class="bi bi-grid-1x2 me-1"></i> Admin
                </a>
            </div>
        </div>
    </div>
</nav>

<main class="flex-grow-1">
    @yield('content')
</main>

<footer class="py-5 mt-auto glass-footer">
    <div class="container text-center">
        <div class="brand-icon-wrapper mx-auto mb-3" style="width:40px; height:40px; font-size:1.2rem;">
            <i class="bi bi-layers-half"></i>
        </div>
        <p class="mb-0 text-muted fw-medium">© {{ date('Y') }} Mağaza. Tüm hakları saklıdır.</p>
    </div>
</footer>

<script src="{{ asset('vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script>
    // Theme Toggle Logic
    document.addEventListener('DOMContentLoaded', () => {
        const toggleBtn = document.getElementById('themeToggleBtn');
        const htmlElement = document.documentElement;
        
        // Update icon based on current theme
        const updateIcon = () => {
            if (htmlElement.getAttribute('data-bs-theme') === 'dark') {
                toggleBtn.classList.add('is-dark');
            } else {
                toggleBtn.classList.remove('is-dark');
            }
        };
        updateIcon();

        toggleBtn.addEventListener('click', () => {
            const currentTheme = htmlElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            htmlElement.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateIcon();
        });
    });
</script>
@stack('scripts')
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
