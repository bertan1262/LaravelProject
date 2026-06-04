@extends('layouts.shop')
@section('title', 'Koleksiyon')

@section('content')
<div class="container py-5">
    <div class="row g-4">

        {{-- Filtre Sidebar --}}
        <div class="col-lg-3">
            <div class="card border-0 rounded-4 p-4 sticky-top" style="top: 100px; background: var(--bg-surface); box-shadow: var(--card-shadow);">
                <h6 class="fw-bold mb-4 text-uppercase tracking-wider" style="letter-spacing: 1px; font-size: 0.85rem;"><i class="bi bi-funnel me-2 text-primary"></i>Kategoriler</h6>
                <div class="list-group list-group-flush gap-1">
                    <a href="{{ route('shop.products') }}"
                       class="list-group-item list-group-item-action border-0 rounded-3 px-3 py-2 fw-medium {{ !request('category') ? 'active bg-primary text-white shadow-sm' : 'text-muted' }}" style="transition: all 0.2s;">
                        Tüm Koleksiyon
                    </a>
                    @foreach(\App\Models\Category::whereNull('parent_id')->get() as $cat)
                        <a href="{{ route('shop.products', ['category' => $cat->id]) }}"
                           class="list-group-item list-group-item-action border-0 rounded-3 px-3 py-2 fw-medium {{ request('category') == $cat->id ? 'active bg-primary text-white shadow-sm' : 'text-muted' }}" style="transition: all 0.2s;">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Ürün Grid --}}
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-dashed">
                <h4 class="fw-bold mb-0">
                    @if(request('q'))
                        "<span class="text-primary">{{ request('q') }}</span>" için sonuçlar
                    @else
                        Koleksiyon
                    @endif
                    <span class="text-muted fw-medium fs-6 ms-2">({{ $products->total() }} ürün)</span>
                </h4>
            </div>

            @if($products->isEmpty())
                <div class="text-center py-5 text-muted border rounded-4 border-dashed">
                    <div class="brand-icon-wrapper mx-auto mb-3" style="width:64px;height:64px;font-size:2rem;background:rgba(99,102,241,0.1);color:var(--primary-color);">
                        <i class="bi bi-search"></i>
                    </div>
                    <h5 class="fw-bold">Sonuç bulunamadı</h5>
                    <p class="mb-3">Farklı kelimeler veya filtreler denemelisiniz.</p>
                    <a href="{{ route('shop.products') }}" class="btn btn-outline-primary rounded-pill px-4">Tüm Ürünler</a>
                </div>
            @else
                <div class="row g-4 u-animate-fade">
                    @foreach($products as $product)
                    <div class="col-sm-6 col-xl-4">
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

                <div class="mt-5 d-flex justify-content-center">
                    {{ $products->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
