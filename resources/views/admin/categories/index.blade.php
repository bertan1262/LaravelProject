@extends('layouts.admin')
@section('title', 'Kategoriler')
@section('page-title', 'Kategori Yönetimi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item text-muted">Admin</li>
            <li class="breadcrumb-item active">Kategoriler</li>
        </ol>
    </nav>
    <a href="{{ route('admin.category.create') }}" class="btn btn-admin-primary">
        <i class="bi bi-plus-lg me-1"></i> Yeni Kategori
    </a>
</div>

<div class="admin-card">
    <div class="card-header d-flex justify-content-between">
        <span><i class="bi bi-grid me-2"></i>Tüm Kategoriler</span>
        <span class="badge bg-secondary">{{ $categories->count() }} kategori</span>
    </div>
    @if($categories->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="bi bi-folder-x" style="font-size:3rem"></i>
            <p class="mt-3">Henüz kategori eklenmemiş.</p>
            <a href="{{ route('admin.category.create') }}" class="btn btn-admin-primary btn-sm">
                İlk Kategoriyi Ekle
            </a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kategori Adı</th>
                        <th>Üst Kategori</th>
                        <th>Ürün Sayısı</th>
                        <th class="text-end">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $cat)
                    <tr>
                        <td class="text-muted fw-semibold">#{{ $cat->id }}</td>
                        <td class="fw-semibold">
                            @if($cat->parent_id)
                                <span class="text-muted me-1">└</span>
                            @endif
                            {{ $cat->name }}
                        </td>
                        <td>{{ $cat->parent?->name ?? '<span class="text-muted">—</span>' }}</td>
                        <td>
                            <span class="badge bg-light text-dark border">
                                {{ $cat->products()->count() }} ürün
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('admin.category.edit', $cat) }}"
                                   class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i> Düzenle
                                </a>
                                <form action="{{ route('admin.category.destroy', $cat) }}" method="POST"
                                      onsubmit="return confirm('Bu kategoriyi silmek istiyor musunuz?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Sil
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
