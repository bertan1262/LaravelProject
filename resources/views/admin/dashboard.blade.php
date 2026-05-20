@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- İstatistik Kartları --}}
<div class="row g-3 mb-4">

    <div class="col-sm-6 col-xl-3">
        <div class="admin-card p-4 d-flex align-items-center gap-3">
            <div class="rounded-3 p-3 bg-primary bg-opacity-10">
                <i class="bi bi-box-seam text-primary fs-4"></i>
            </div>
            <div>
                <div class="fs-4 fw-bold">{{ $stats['total_products'] }}</div>
                <div class="text-muted small">Toplam Ürün</div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="admin-card p-4 d-flex align-items-center gap-3">
            <div class="rounded-3 p-3 bg-success bg-opacity-10">
                <i class="bi bi-check-circle text-success fs-4"></i>
            </div>
            <div>
                <div class="fs-4 fw-bold text-success">{{ $stats['active_products'] }}</div>
                <div class="text-muted small">Aktif Ürün</div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="admin-card p-4 d-flex align-items-center gap-3">
            <div class="rounded-3 p-3 bg-info bg-opacity-10">
                <i class="bi bi-grid text-info fs-4"></i>
            </div>
            <div>
                <div class="fs-4 fw-bold">{{ $stats['total_categories'] }}</div>
                <div class="text-muted small">Kategori</div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="admin-card p-4 d-flex align-items-center gap-3">
            <div class="rounded-3 p-3 bg-warning bg-opacity-10">
                <i class="bi bi-exclamation-triangle text-warning fs-4"></i>
            </div>
            <div>
                <div class="fs-4 fw-bold text-warning">{{ $stats['low_stock'] }}</div>
                <div class="text-muted small">Kritik Stok</div>
            </div>
        </div>
    </div>

</div>

<div class="row g-4">

    {{-- Son Eklenen Ürünler --}}
    <div class="col-lg-7">
        <div class="admin-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-clock-history me-2"></i>Son Eklenen Ürünler</span>
                <a href="{{ route('admin.product.index') }}" class="btn btn-sm btn-outline-primary">Tümü</a>
            </div>
            @if($latest_products->isEmpty())
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-inbox fs-2"></i>
                    <p class="mt-2 mb-0">Henüz ürün yok.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table admin-table mb-0">
                        <thead>
                            <tr>
                                <th>Ürün</th>
                                <th>Fiyat</th>
                                <th>Stok</th>
                                <th>Durum</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latest_products as $p)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.product.show', $p) }}" class="text-decoration-none fw-semibold">
                                        {{ Str::limit($p->title, 30) }}
                                    </a>
                                    <div class="text-muted small">{{ $p->category?->name }}</div>
                                </td>
                                <td>{{ number_format($p->price, 2, ',', '.') }} ₺</td>
                                <td>{{ $p->stock }}</td>
                                <td>
                                    @if($p->status)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Pasif</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- Kritik Stok Uyarıları --}}
    <div class="col-lg-5">
        <div class="admin-card">
            <div class="card-header">
                <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>Kritik Stok Uyarıları
            </div>
            @if($low_stock_products->isEmpty())
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-check-circle text-success fs-2"></i>
                    <p class="mt-2 mb-0 small">Stok durumu normal.</p>
                </div>
            @else
                <div class="p-3">
                    @foreach($low_stock_products as $p)
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <div>
                            <div class="fw-semibold small">{{ Str::limit($p->title, 25) }}</div>
                            <div class="text-muted" style="font-size:0.75rem">Min: {{ $p->minstock }}</div>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-warning text-dark">{{ $p->stock }} adet</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Hızlı Erişim --}}
        <div class="admin-card mt-4 p-4">
            <h6 class="fw-bold text-muted text-uppercase small mb-3">Hızlı Erişim</h6>
            <div class="d-grid gap-2">
                <a href="{{ route('admin.product.create') }}" class="btn btn-outline-primary btn-sm text-start">
                    <i class="bi bi-plus-circle me-2"></i>Yeni Ürün Ekle
                </a>
                <a href="{{ route('admin.category.create') }}" class="btn btn-outline-info btn-sm text-start">
                    <i class="bi bi-folder-plus me-2"></i>Yeni Kategori Ekle
                </a>
                <a href="{{ route('shop.index') }}" target="_blank" class="btn btn-outline-success btn-sm text-start">
                    <i class="bi bi-shop me-2"></i>Siteyi Görüntüle
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
