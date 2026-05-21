@extends('layouts.shop')
@section('title', $product->title)

@section('content')
<div class="container py-5">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">Anasayfa</a></li>
            @if($product->category)
                <li class="breadcrumb-item">
                    <a href="{{ route('shop.category', $product->category) }}">{{ $product->category->name }}</a>
                </li>
            @endif
            <li class="breadcrumb-item active">{{ $product->title }}</li>
        </ol>
    </nav>

    <div class="row g-5">

        {{-- Görsel --}}
        <div class="col-md-5">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->title }}"
                     class="img-fluid rounded-4 shadow-sm w-100" style="max-height:420px; object-fit:contain;">
            @else
                <div class="d-flex align-items-center justify-content-center bg-light rounded-4"
                     style="height:350px; font-size:5rem;">🛍️</div>
            @endif
        </div>

        {{-- Bilgi --}}
        <div class="col-md-7">
            <p class="text-primary fw-semibold small mb-1">{{ $product->category?->full_path }}</p>
            <h1 class="fw-bold mb-2">{{ $product->title }}</h1>

            @if($product->description)
                <p class="text-muted mb-4">{{ $product->description }}</p>
            @endif

            {{-- Fiyat --}}
            <div class="mb-4">
                @if($product->discount > 0)
                    <div class="d-flex align-items-baseline gap-2">
                        <span class="fs-2 fw-bold text-danger">
                            {{ number_format($product->discounted_price, 2, ',', '.') }} ₺
                        </span>
                        <span class="text-muted text-decoration-line-through fs-5">
                            {{ number_format($product->price, 2, ',', '.') }} ₺
                        </span>
                        <span class="badge bg-danger">%{{ $product->discount }} İndirim</span>
                    </div>
                @else
                    <span class="fs-2 fw-bold">{{ number_format($product->price, 2, ',', '.') }} ₺</span>
                @endif
            </div>

            {{-- Stok --}}
            <div class="mb-3">
                @if($product->stock > 0)
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2">
                        <i class="bi bi-check-circle me-1"></i>Stokta Var ({{ $product->stock }} adet)
                    </span>
                @else
                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2">
                        <i class="bi bi-x-circle me-1"></i>Stok Tükendi
                    </span>
                @endif
            </div>

            {{-- Keywords --}}
            @if($product->keywords)
                <div class="mb-4">
                    @foreach(explode(',', $product->keywords) as $kw)
                        <span class="badge bg-light text-muted border me-1">{{ trim($kw) }}</span>
                    @endforeach
                </div>
            @endif

            <hr>
            <a href="{{ route('shop.products') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Ürünlere Dön
            </a>
        </div>
    </div>

    {{-- Detaylı Açıklama --}}
    @if($product->detail)
        <div class="mt-5">
            <h4 class="fw-bold border-bottom pb-2 mb-3">Ürün Detayları</h4>
            <div class="prose bg-white p-4 rounded-4 border">
                {!! $product->detail !!}
            </div>
        </div>
    @endif

    {{-- İlgili Ürünler --}}
    @if($related->count())
        <div class="mt-5">
            <h4 class="fw-bold border-bottom pb-2 mb-4">Benzer Ürünler</h4>
            <div class="row g-3">
                @foreach($related as $r)
                <div class="col-sm-6 col-md-3">
                    <a href="{{ route('shop.show', $r) }}" class="text-decoration-none">
                        <div class="card product-card h-100">
                            @if($r->image)
                                <img src="{{ asset('storage/'.$r->image) }}" alt="{{ $r->title }}" class="card-img-top">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light" style="height:150px; font-size:2.5rem;">🛍️</div>
                            @endif
                            <div class="card-body p-3">
                                <div class="fw-semibold small text-dark">{{ Str::limit($r->title, 40) }}</div>
                                <div class="text-primary fw-bold mt-1">{{ number_format($r->price, 2, ',', '.') }} ₺</div>
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
