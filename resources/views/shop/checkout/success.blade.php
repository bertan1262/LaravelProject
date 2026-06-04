@extends('layouts.shop')
@section('title', 'Sipariş Başarılı')

@section('content')
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0 py-5">
                <div class="card-body">
                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                    </div>
                    <h2 class="fw-bold text-success mb-3">Siparişiniz Başarıyla Alındı!</h2>
                    <p class="text-muted mb-4">
                        Bizi tercih ettiğiniz için teşekkür ederiz. Sipariş detaylarınız belirtmiş olduğunuz e-posta adresine gönderilmiştir. Ürünleriniz en kısa sürede kargoya teslim edilecektir.
                    </p>
                    <a href="{{ route('shop.products') }}" class="btn btn-primary px-5 py-2 fw-bold">Alışverişe Devam Et</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
