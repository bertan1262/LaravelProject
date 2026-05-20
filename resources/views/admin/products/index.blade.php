@extends('layouts.admin')
@section('title', 'Ürünler')
@section('page-title', 'Ürün Yönetimi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item text-muted">Admin</li>
            <li class="breadcrumb-item active">Ürünler</li>
        </ol>
    </nav>
    <a href="{{ route('admin.product.create') }}" class="btn btn-admin-primary">
        <i class="bi bi-plus-lg me-1"></i> Yeni Ürün Ekle
    </a>
</div>

<div class="admin-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-box-seam me-2"></i>Tüm Ürünler</span>
        <span class="badge bg-secondary">{{ $products->count() }} ürün</span>
    </div>

    @if($products->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="bi bi-inbox" style="font-size:3rem;"></i>
            <p class="mt-3 fs-5">No Products found</p>
            <a href="{{ route('admin.product.create') }}" class="btn btn-admin-primary btn-sm mt-1">
                İlk Ürünü Ekle
            </a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kategori</th>
                        <th>Başlık</th>
                        <th>Fiyat</th>
                        <th>Stok</th>
                        <th>İndirim</th>
                        <th>Resim</th>
                        <th>Durum</th>
                        <th class="text-end">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="fw-semibold text-muted">#{{ $product->id }}</td>

                        {{-- Kategori: Tam yol --}}
                        <td>
                            @if($product->category)
                                <small class="text-muted">{{ $product->category->full_path }}</small>
                            @else
                                <span class="text-danger small">—</span>
                            @endif
                        </td>

                        <td class="fw-semibold">{{ $product->title }}</td>

                        <td>{{ number_format($product->price, 2, ',', '.') }} ₺</td>

                        <td>
                            @if($product->low_stock)
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-exclamation-triangle me-1"></i>{{ $product->stock }}
                                </span>
                            @else
                                {{ $product->stock }}
                            @endif
                        </td>

                        <td>
                            @if($product->discount > 0)
                                <span class="badge bg-danger">% {{ $product->discount }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->title }}"
                                     class="img-thumbnail" style="max-height:50px;">
                            @else
                                <span class="text-muted small">Resim yok</span>
                            @endif
                        </td>

                        <td>
                            @if($product->status)
                                <span class="badge bg-success status-badge">
                                    <i class="bi bi-check-circle me-1"></i>True
                                </span>
                            @else
                                <span class="badge bg-secondary status-badge">
                                    <i class="bi bi-x-circle me-1"></i>False
                                </span>
                            @endif
                        </td>

                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                {{-- Show --}}
                                <a href="{{ route('admin.product.show', $product) }}"
                                   class="btn btn-sm btn-outline-primary" title="Detay">
                                    <i class="bi bi-eye"></i> Show
                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('admin.product.edit', $product) }}"
                                   class="btn btn-sm btn-outline-warning" title="Düzenle">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('admin.product.destroy', $product) }}" method="POST"
                                      onsubmit="return confirm('Bu ürünü silmek istediğinizden emin misiniz? Bu işlem geri alınamaz!')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Sil">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
