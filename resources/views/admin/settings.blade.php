@extends('layouts.admin')
@section('title', 'Ayarlar')
@section('page-title', 'Sistem Ayarları')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form>
            <div class="mb-4">
                <label class="form-label fw-bold">Site Başlığı</label>
                <input type="text" class="form-control" value="LaravelProject Mağaza" disabled>
                <div class="form-text">Mevcut ödev projesinde site adı değiştirilemez.</div>
            </div>
            
            <div class="mb-4">
                <label class="form-label fw-bold">Admin E-posta</label>
                <input type="email" class="form-control" value="{{ auth()->user()->email ?? 'admin@admin.com' }}" disabled>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Bakım Modu</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="maintenanceMode" disabled>
                    <label class="form-check-label" for="maintenanceMode">Siteyi bakıma al (Demoda aktif değil)</label>
                </div>
            </div>

            <button type="button" class="btn btn-primary" disabled>
                <i class="bi bi-save me-1"></i> Ayarları Kaydet
            </button>
        </form>
    </div>
</div>
@endsection
