@extends('layouts.shop')
@section('title', $category->name . ' Koleksiyonu')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4 u-animate-fade">
        <ol class="breadcrumb fw-medium">
            <li class="breadcrumb-item"><a href="{{ route('shop.index') }}" class="text-decoration-none text-muted">Anasayfa</a></li>
            @if($category->parent)
                <li class="breadcrumb-item"><a href="{{ route('shop.category', $category->parent) }}" class="text-decoration-none text-muted">{{ $category->parent->name }}</a></li>
            @endif
            <li class="breadcrumb-item active text-primary">{{ $category->name }}</li>
        </ol>
    </nav>

    <div class="d-flex align-items-center gap-3 mb-5 u-animate-slide-up">
        <div class="category-card-icon mb-0 bg-primary text-white" style="width: 56px; height: 56px; box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);">
            <i class="bi bi-grid-fill fs-3"></i>
        </div>
        <div>
            <h2 class="fw-bold mb-1" style="letter-spacing: -0.5px;">{{ $category->name }}</h2>
            <p class="text-muted mb-0">{{ $products->total() }} muhteşem ürün bulundu.</p>
        </div>
    </div>

    @if($products->isEmpty())
        <div class="text-center py-5 text-muted border rounded-4 border-dashed u-animate-fade">
            <div class="brand-icon-wrapper mx-auto mb-3" style="width:64px;height:64px;font-size:2rem;background:rgba(99,102,241,0.1);color:var(--primary-color);">
                <i class="bi bi-inbox"></i>
            </div>
            <h5 class="fw-bold">Bu kategoride henüz ürün yok</h5>
            <p class="mb-4">Daha sonra tekrar kontrol edebilir veya tüm ürünleri inceleyebilirsiniz.</p>
            <a href="{{ route('shop.products') }}" class="btn btn-primary rounded-pill px-4 fw-medium shadow-sm">Tüm Ürünler</a>
        </div>
    @else
        <div class="row g-4 u-animate-fade">
            @foreach($products as $product)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <a href="{{ route('shop.show', $product) }}" class="text-decoration-none">
                    <div class="product-card h-100">
                        <div class="product-card-img-wrapper">
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->title }}">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light" style="height:250px;font-size:4rem;color:#cbd5e1;">🛍️</div>
                            @endif
                        </div>
                        <div class="card-body p-4">
                            <p class="text-muted small mb-2 text-uppercase fw-semibold" style="letter-spacing: 1px; font-size: 0.7rem;">{{ $category->name }}</p>
                            <h5 class="fw-bold text-body mb-3">{{ Str::limit($product->title, 40) }}</h5>
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
        <div class="mt-5 d-flex justify-content-center u-animate-fade">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
