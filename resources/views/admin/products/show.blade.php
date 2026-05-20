@extends('layouts.admin')
@section('title', $product->title . ' — Detay')
@section('page-title', 'Ürün Detayı')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}" class="text-decoration-none">Ürünler</a></li>
            <li class="breadcrumb-item active">{{ $product->title }}</li>
        </ol>
    </nav>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.product.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Geri Dön
        </a>
        <a href="{{ route('admin.product.edit', $product) }}" class="btn btn-outline-warning btn-sm">
            <i class="bi bi-pencil me-1"></i> Düzenle
        </a>
    </div>
</div>

<div class="admin-card">
    <div class="card-header">
        <i class="bi bi-box-seam me-2"></i>{{ $product->title }}
    </div>

    <div class="p-4">
        <div class="row g-4">

            {{-- Resim --}}
            @if($product->image)
            <div class="col-md-4 text-center">
                <img src="{{ asset('storage/' . $product->image) }}"
                     alt="{{ $product->title }}"
                     class="img-fluid rounded shadow"
                     style="max-height: 280px;">
            </div>
            <div class="col-md-8">
            @else
            <div class="col-12">
            @endif

                {{-- Tablo — table-striped --}}
                <table class="table table-striped admin-table">
                    <tbody>
                        <tr>
                            <th style="width:180px">ID</th>
                            <td>#{{ $product->id }}</td>
                        </tr>
                        <tr>
                            <th>Kategori Yolu</th>
                            <td>
                                @if($product->category)
                                    <span class="text-muted">{{ $product->category->full_path }}</span>
                                @else
                                    <span class="text-danger">Kategori yok</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Ürün Adı (title)</th>
                            <td class="fw-semibold">{{ $product->title }}</td>
                        </tr>
                        <tr>
                            <th>Keywords</th>
                            <td>{{ $product->keywords ?: '—' }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $product->description ?: '—' }}</td>
                        </tr>
                        <tr>
                            <th>Fiyat</th>
                            <td>
                                <strong>{{ number_format($product->price, 2, ',', '.') }} ₺</strong>
                                @if($product->discount > 0)
                                    <span class="badge bg-danger ms-2">%{{ $product->discount }} indirim</span>
                                    <span class="text-success ms-1">
                                        → {{ number_format($product->discounted_price, 2, ',', '.') }} ₺
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Stok / Min. Stok</th>
                            <td>
                                {{ $product->stock }} adet
                                <span class="text-muted">/ min. {{ $product->minstock }}</span>
                                @if($product->low_stock)
                                    <span class="badge bg-warning text-dark ms-2">
                                        <i class="bi bi-exclamation-triangle me-1"></i>Kritik Stok
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>İndirim Oranı</th>
                            <td>
                                @if($product->discount > 0)
                                    <span class="badge bg-danger">% {{ $product->discount }}</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Durum</th>
                            <td>
                                @if($product->status)
                                    <span class="badge bg-success status-badge">
                                        <i class="bi bi-check-circle me-1"></i>True — Aktif
                                    </span>
                                @else
                                    <span class="badge bg-secondary status-badge">
                                        <i class="bi bi-x-circle me-1"></i>False — Pasif
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Ekleyen Kullanıcı</th>
                            <td>{{ $product->user->name ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th>Kayıt Tarihi</th>
                            <td>{{ $product->created_at->format('d.m.Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Son Güncelleme</th>
                            <td>{{ $product->updated_at->format('d.m.Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

        {{-- Detaylı Açıklama (HTML içerik) --}}
        @if($product->detail)
        <hr>
        <h6 class="text-muted fw-bold text-uppercase small mb-3">
            <i class="bi bi-file-text me-2"></i>Detaylı Açıklama
        </h6>
        <div class="border rounded p-3 bg-light prose-content">
            {!! $product->detail !!}
        </div>
        @endif
    </div>
</div>

<div class="d-flex gap-2 mt-3">
    <a href="{{ route('admin.product.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Geri Dön
    </a>
    <a href="{{ route('admin.product.edit', $product) }}" class="btn btn-outline-warning">
        <i class="bi bi-pencil me-1"></i> Düzenle
    </a>
    <form action="{{ route('admin.product.destroy', $product) }}" method="POST" class="ms-auto"
          onsubmit="return confirm('Bu ürünü silmek istediğinizden emin misiniz?')">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-outline-danger">
            <i class="bi bi-trash me-1"></i> Sil
        </button>
    </form>
</div>
@endsection
