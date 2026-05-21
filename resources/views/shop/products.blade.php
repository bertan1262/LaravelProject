@extends('layouts.shop')
@section('title', 'Ürünler')

@section('content')
<div class="container py-5">
    <div class="row g-4">

        {{-- Filtre Sidebar --}}
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 p-3">
                <h6 class="fw-bold mb-3"><i class="bi bi-funnel me-1"></i>Kategoriler</h6>
                <div class="list-group list-group-flush">
                    <a href="{{ route('shop.products') }}"
                       class="list-group-item list-group-item-action border-0 rounded-3 {{ !request('category') ? 'active bg-primary' : '' }}">
                        Tüm Ürünler
                    </a>
                    @foreach(\App\Models\Category::whereNull('parent_id')->get() as $cat)
                        <a href="{{ route('shop.products', ['category' => $cat->id]) }}"
                           class="list-group-item list-group-item-action border-0 rounded-3 {{ request('category') == $cat->id ? 'active bg-primary' : '' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Ürün Grid --}}
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">
                    @if(request('q'))
                        "<span class="text-primary">{{ request('q') }}</span>" için sonuçlar
                    @else
                        Tüm Ürünler
                    @endif
                    <span class="text-muted fw-normal fs-6">({{ $products->total() }} ürün)</span>
                </h5>
            </div>

            @if($products->isEmpty())
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-search" style="font-size:3rem;"></i>
                    <h5 class="mt-3">Ürün bulunamadı</h5>
                    <a href="{{ route('shop.products') }}" class="btn btn-outline-primary mt-2">Tüm Ürünler</a>
                </div>
            @else
                <div class="row g-4">
                    @foreach($products as $product)
                    <div class="col-sm-6 col-xl-4">
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

                <div class="mt-5 d-flex justify-content-center">
                    {{ $products->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
