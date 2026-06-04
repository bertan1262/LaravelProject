@extends('layouts.shop')
@section('title', $product->title)

@section('content')
<div class="container py-5">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb fw-medium">
            <li class="breadcrumb-item"><a href="{{ route('shop.index') }}" class="text-decoration-none text-muted">Anasayfa</a></li>
            @if($product->category)
                <li class="breadcrumb-item">
                    <a href="{{ route('shop.category', $product->category) }}" class="text-decoration-none text-muted">{{ $product->category->name }}</a>
                </li>
            @endif
            <li class="breadcrumb-item active text-primary">{{ Str::limit($product->title, 30) }}</li>
        </ol>
    </nav>

    <div class="row g-5 align-items-center mb-5 u-animate-slide-up">

        {{-- Görsel --}}
        <div class="col-md-5">
            <div class="position-relative">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->title }}"
                         class="img-fluid rounded-4 w-100" style="max-height:500px; object-fit:contain; background: var(--bg-surface); box-shadow: var(--card-shadow);">
                @else
                    <div class="d-flex align-items-center justify-content-center rounded-4"
                         style="height:450px; font-size:6rem; background: var(--bg-surface); color: #cbd5e1; box-shadow: var(--card-shadow);">🛍️</div>
                @endif
                @if($product->discount > 0)
                    <span class="position-absolute top-0 start-0 m-4 badge bg-danger fs-6 px-3 py-2 rounded-pill shadow-sm">
                        -%{{ $product->discount }} İndirim
                    </span>
                @endif
            </div>
        </div>

        {{-- Bilgi --}}
        <div class="col-md-7 ps-md-5">
            <p class="text-primary fw-semibold small mb-2 text-uppercase tracking-wider" style="letter-spacing:1px;">{{ $product->category?->full_path }}</p>
            <h1 class="display-5 fw-bold mb-3" style="letter-spacing: -1px;">{{ $product->title }}</h1>

            @if($product->description)
                <p class="text-muted mb-4 fs-5" style="line-height: 1.6;">{{ $product->description }}</p>
            @endif

            {{-- Fiyat --}}
            <div class="mb-4">
                @if($product->discount > 0)
                    <div class="d-flex align-items-baseline gap-3">
                        <span class="display-4 fw-bold text-danger">
                            {{ number_format($product->discounted_price, 2, ',', '.') }} ₺
                        </span>
                        <span class="text-muted text-decoration-line-through fs-4">
                            {{ number_format($product->price, 2, ',', '.') }} ₺
                        </span>
                    </div>
                @else
                    <span class="display-4 fw-bold">{{ number_format($product->price, 2, ',', '.') }} ₺</span>
                @endif
            </div>

            {{-- Stok --}}
            <div class="mb-4 d-inline-flex gap-2 align-items-center">
                @if($product->stock > 0)
                    <span class="badge rounded-pill bg-success-subtle text-success px-4 py-2 fw-semibold fs-6">
                        <i class="bi bi-check-circle-fill me-2"></i>Stokta Var ({{ $product->stock }} adet)
                    </span>
                @else
                    <span class="badge rounded-pill bg-danger-subtle text-danger px-4 py-2 fw-semibold fs-6">
                        <i class="bi bi-x-circle-fill me-2"></i>Stok Tükendi
                    </span>
                @endif
            </div>

            {{-- Keywords --}}
            @if($product->keywords)
                <div class="mb-5 d-flex flex-wrap gap-2">
                    @foreach(explode(',', $product->keywords) as $kw)
                        <span class="badge bg-body-tertiary text-muted border px-3 py-2 rounded-pill fw-normal">{{ trim($kw) }}</span>
                    @endforeach
                </div>
            @endif

            <hr class="opacity-10 mb-4">
            
            <div class="d-flex gap-3">
                <form action="{{ route('shop.cart.add', $product) }}" method="POST" class="flex-grow-1">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill fw-bold shadow-sm" {{ $product->stock <= 0 ? 'disabled' : '' }} style="padding: 1rem;">
                        <i class="bi bi-bag-plus-fill me-2"></i> Sepete Ekle
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Detaylı Açıklama --}}
    @if($product->detail)
        <div class="row mt-5 pt-4">
            <div class="col-12">
                <div class="card border-0 rounded-4 p-5" style="background: var(--bg-surface); box-shadow: var(--card-shadow);">
                    <h3 class="fw-bold mb-4 d-flex align-items-center gap-3">
                        <i class="bi bi-info-circle-fill text-primary"></i> Ürün Detayları
                    </h3>
                    <div class="prose fs-5 text-muted" style="line-height: 1.8;">
                        {!! $product->detail !!}
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- İlgili Ürünler --}}
    @if($related->count())
        <div class="mt-5 pt-5">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h3 class="fw-bold mb-0">İlginizi Çekebilir</h3>
            </div>
            
            <div class="row g-4">
                @foreach($related as $r)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="{{ route('shop.show', $r) }}" class="text-decoration-none">
                        <div class="product-card h-100">
                            <div class="product-card-img-wrapper">
                                @if($r->image)
                                    <img src="{{ asset('storage/'.$r->image) }}" alt="{{ $r->title }}">
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-light" style="height:200px; font-size:3rem; color:#cbd5e1;">🛍️</div>
                                @endif
                            </div>
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-2 text-body">{{ Str::limit($r->title, 40) }}</h6>
                                <div class="price-badge text-primary fs-5 mt-2">{{ number_format($r->price, 2, ',', '.') }} ₺</div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection
