@extends('layouts.admin')
@section('title', 'Yeni Ürün Ekle')
@section('page-title', 'Yeni Ürün Ekle')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}" class="text-decoration-none">Ürünler</a></li>
            <li class="breadcrumb-item active">Yeni Ekle</li>
        </ol>
    </nav>
</div>

{{-- Dosya yükleme için enctype="multipart/form-data" zorunlu --}}
<form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @include('admin.products.form', ['product' => null])

    <div class="d-flex gap-2 mt-4">
        <button type="submit" class="btn btn-admin-primary px-4">
            <i class="bi bi-check-lg me-1"></i> Ürünü Kaydet
        </button>
        <a href="{{ route('admin.product.index') }}" class="btn btn-outline-secondary px-4">
            <i class="bi bi-x-lg me-1"></i> İptal
        </a>
    </div>
</form>
@endsection

@push('scripts')
{{-- CKEditor 5 entegrasyonu --}}
<script src="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.umd.js"></script>
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.css">
<script>
    const { ClassicEditor, Essentials, Bold, Italic, Underline, Strikethrough,
            Paragraph, Heading, Link, BulletedList, NumberedList, BlockQuote,
            Table, TableToolbar, Image, ImageUpload, ImageCaption, ImageStyle,
            Alignment, FontSize, FontColor } = CKEDITOR;

    ClassicEditor
        .create(document.getElementById('detail'), {
            plugins: [
                Essentials, Bold, Italic, Underline, Strikethrough,
                Paragraph, Heading, Link, BulletedList, NumberedList,
                BlockQuote, Table, TableToolbar, Alignment, FontSize, FontColor
            ],
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'alignment', '|',
                    'bulletedList', 'numberedList', '|',
                    'blockQuote', 'link', '|',
                    'fontSize', 'fontColor', '|',
                    'insertTable', '|',
                    'undo', 'redo'
                ]
            },
            language: 'tr',
        })
        .catch(err => console.error('CKEditor hatası:', err));
</script>
@endpush
