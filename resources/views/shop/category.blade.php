@extends('layouts.shop')
@section('title', $category->name . ' Ürünleri')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">Anasayfa</a></li>
            @if($category->parent)
                <li class="breadcrumb-item">{{ $category->parent->name }}</li>
            @endif
            <li class="breadcrumb-item active">{{ $category->name }}</li>
        </ol>
    </nav>

    <h2 class="fw-bold mb-4">{{ $category->name }}</h2>

    @if($products->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="bi bi-inbox" style="font-size:3rem;"></i>
            <p class="mt-3">Bu kategoride ürün bulunamadı.</p>
            <a href="{{ route('shop.products') }}" class="btn btn-outline-primary">Tüm Ürünler</a>
        </div>
    @else
        <div class="row g-4">
            @foreach($products as $product)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <a href="{{ route('shop.show', $product) }}" class="text-decoration-none">
                    <div class="card product-card h-100">
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->title }}" class="card-img-top">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light" style="height:200px;font-size:3rem;">🛍️</div>
                        @endif
                        <div class="card-body">
                            <h6 class="fw-bold text-dark mb-2">{{ Str::limit($product->title, 45) }}</h6>
                            <div class="d-flex align-items-center gap-2">
                                <span class="price-badge">{{ number_format($product->price, 2, ',', '.') }} ₺</span>
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
        <div class="mt-5 d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
