@extends('layouts.admin')
@section('title', 'Kategori Düzenle')
@section('page-title', 'Kategori Düzenle')

@section('content')
<div class="mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}" class="text-decoration-none">Kategoriler</a></li>
            <li class="breadcrumb-item active">{{ $category->name }}</li>
        </ol>
    </nav>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="admin-card">
            <div class="card-header"><i class="bi bi-pencil me-2"></i>Kategoriyi Düzenle</div>
            <div class="card-body p-4">
                <form action="{{ route('admin.category.update', $category) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Kategori Adı <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $category->name) }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="parent_id" class="form-label">Üst Kategori</label>
                        <select name="parent_id" id="parent_id"
                                class="form-select @error('parent_id') is-invalid @enderror">
                            <option value="">-- Ana Kategori (Üst Yok) --</option>
                            @foreach($parents as $parent)
                                <option value="{{ $parent->id }}"
                                    {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('parent_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary px-4">
                            <i class="bi bi-check-lg me-1"></i> Güncelle
                        </button>
                        <a href="{{ route('admin.category.index') }}" class="btn btn-outline-secondary px-4">
                            İptal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
