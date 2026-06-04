@extends('layouts.shop')
@section('title', 'Anasayfa — Mağaza')

@section('content')

{{-- Premium Hero Section --}}
<div class="hero-wrapper">
    <div class="hero-bg-shapes">
        <div class="hero-shape hero-shape-1"></div>
        <div class="hero-shape hero-shape-2"></div>
    </div>
    
    <div class="container text-center position-relative z-1 u-animate-slide-up">
        <h1 class="display-3 fw-bold mb-4">Geleceğin <span class="text-primary">Alışveriş</span> Deneyimi</h1>
        <p class="lead text-muted mb-5 mx-auto" style="max-width: 650px;">En son teknoloji ürünleri, şık tasarımlar ve benzersiz fırsatlar. İhtiyacınız olan her şey tek bir yerde, kusursuz bir deneyimle.</p>
        
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('shop.products') }}" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold">
                Koleksiyonu Keşfet <i class="bi bi-arrow-right ms-2"></i>
            </a>
            <a href="#categories" class="btn btn-outline-secondary btn-lg rounded-pill px-4 fw-medium">
                Kategoriler <i class="bi bi-chevron-down ms-2"></i>
            </a>
        </div>
    </div>
</div>



{{-- Öne Çıkan Ürünler --}}
<div class="container mb-5 mt-5 pt-4">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h2 class="fw-bold mb-1">Yeni Gelenler</h2>
            <p class="text-muted mb-0">En son eklenen ürünlerimizi kaçırmayın.</p>
        </div>
        <a href="{{ route('shop.products') }}" class="btn btn-outline-primary rounded-pill px-4 fw-medium d-none d-sm-inline-flex">Tümünü Gör</a>
    </div>

    @if($featured->isEmpty())
        <div class="text-center py-5 text-muted border rounded-4 border-dashed">
            <div class="brand-icon-wrapper mx-auto mb-3" style="width:64px;height:64px;font-size:2rem;background:rgba(99,102,241,0.1);color:var(--primary-color);">
                <i class="bi bi-inbox"></i>
            </div>
            <h5 class="fw-bold">Henüz aktif ürün bulunmuyor.</h5>
            <p class="mb-0">Daha sonra tekrar kontrol edin.</p>
        </div>
    @else
        <div class="row g-4">
            @foreach($featured as $product)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <a href="{{ route('shop.show', $product) }}" class="text-decoration-none">
                    <div class="product-card h-100">
                        <div class="product-card-img-wrapper">
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->title }}">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light" style="height:250px; font-size:4rem; color: #cbd5e1;">
                                    <i class="bi bi-bag"></i>
                                </div>
                            @endif
                        </div>
                        <div class="card-body p-4">
                            <p class="text-muted small mb-2 text-uppercase fw-semibold" style="letter-spacing: 1px; font-size: 0.7rem;">{{ $product->category?->name }}</p>
                            <h5 class="fw-bold mb-3 text-body">{{ Str::limit($product->title, 40) }}</h5>
                            <div class="d-flex align-items-center gap-2">
                                <span class="price-badge">
                                    @if($product->discount > 0)
                                        {{ number_format($product->discounted_price, 2, ',', '.') }} ₺
                                    @else
                                        {{ number_format($product->price, 2, ',', '.') }} ₺
                                    @endif
                                </span>
                                @if($product->discount > 0)
                                    <span class="discount-badge">-%{{ $product->discount }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4 d-sm-none">
             <a href="{{ route('shop.products') }}" class="btn btn-outline-primary rounded-pill px-4 fw-medium w-100">Tümünü Gör</a>
        </div>
    @endif
</div>
@endsection
