@extends('layouts.shop')
@section('title', 'Anasayfa — Mağaza')

@section('content')

{{-- Hero --}}
<div style="background: linear-gradient(135deg,#4f46e5,#7c3aed); color:#fff; padding: 4rem 0;">
    <div class="container text-center">
        <h1 class="display-5 fw-bold mb-3">Hoş Geldiniz! 🛍️</h1>
        <p class="lead opacity-75 mb-4">En yeni ürünleri keşfedin, indirimli fırsatları kaçırmayın.</p>
        <a href="{{ route('shop.products') }}" class="btn btn-light btn-lg fw-bold px-5">
            Tüm Ürünlere Bak <i class="bi bi-arrow-right ms-2"></i>
        </a>
    </div>
</div>

{{-- Kategoriler --}}
@if($categories->count())
<div class="container my-5">
    <h2 class="fw-bold mb-4">Kategoriler</h2>
    <div class="row g-3">
        @foreach($categories as $cat)
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
            <a href="{{ route('shop.category', $cat) }}" class="text-decoration-none">
                <div class="card text-center p-3 border h-100" style="border-radius:0.75rem; transition: all 0.2s;"
                     onmouseover="this.style.borderColor='#6366f1'; this.style.background='#f5f3ff';"
                     onmouseout="this.style.borderColor=''; this.style.background='';">
                    <i class="bi bi-grid-fill text-primary mb-2" style="font-size:1.75rem;"></i>
                    <div class="fw-semibold small">{{ $cat->name }}</div>
                    <div class="text-muted" style="font-size:0.72rem;">{{ $cat->products_count }} ürün</div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endif

{{-- Öne Çıkan Ürünler --}}
<div class="container mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Yeni Ürünler</h2>
        <a href="{{ route('shop.products') }}" class="btn btn-outline-primary btn-sm">Tümünü Gör</a>
    </div>

    @if($featured->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="bi bi-inbox" style="font-size:3rem;"></i>
            <p class="mt-3">Henüz aktif ürün bulunmuyor.</p>
        </div>
    @else
        <div class="row g-4">
            @foreach($featured as $product)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <a href="{{ route('shop.show', $product) }}" class="text-decoration-none">
                    <div class="card product-card h-100">
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->title }}" class="card-img-top">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light" style="height:200px; font-size:3rem;">🛍️</div>
                        @endif
                        <div class="card-body">
                            <p class="text-muted small mb-1">{{ $product->category?->name }}</p>
                            <h6 class="fw-bold text-dark mb-2">{{ Str::limit($product->title, 45) }}</h6>
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
    @endif
</div>
@endsection
