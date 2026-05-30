@extends('layouts.admin')
@section('title', 'İstatistikler')
@section('page-title', 'Site İstatistikleri')

@section('content')
<div class="row g-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center p-4">
                <div class="text-primary mb-3">
                    <i class="bi bi-people display-4"></i>
                </div>
                <h5 class="card-title text-muted mb-1">Toplam Kullanıcı</h5>
                <h2 class="fw-bold mb-0">{{ $stats['users'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center p-4">
                <div class="text-success mb-3">
                    <i class="bi bi-box-seam display-4"></i>
                </div>
                <h5 class="card-title text-muted mb-1">Toplam Ürün</h5>
                <h2 class="fw-bold mb-0">{{ $stats['products'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center p-4">
                <div class="text-warning mb-3">
                    <i class="bi bi-grid display-4"></i>
                </div>
                <h5 class="card-title text-muted mb-1">Toplam Kategori</h5>
                <h2 class="fw-bold mb-0">{{ $stats['categories'] }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection
