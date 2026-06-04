@extends('layouts.shop')
@section('title', 'Güvenli Ödeme')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Güvenli Ödeme</h2>

    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('shop.checkout.process') }}" method="POST">
                        @csrf
                        
                        <h5 class="fw-bold mb-3"><i class="bi bi-person-badge"></i> Teslimat Bilgileri</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Ad Soyad</label>
                                <input type="text" name="customer_name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">E-posta Adresi</label>
                                <input type="email" name="customer_email" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Açık Adres</label>
                                <textarea name="shipping_address" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="fw-bold mb-3"><i class="bi bi-credit-card"></i> Kredi Kartı Bilgileri <span class="badge bg-secondary ms-2 text-wrap" style="font-size:0.7rem; font-weight:normal">(Ödev İçin Simülasyon)</span></h5>
                        
                        <div class="p-3 bg-light rounded border mb-4">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Kart Üzerindeki İsim</label>
                                    <input type="text" name="card_name" class="form-control" required placeholder="AD SOYAD">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Kart Numarası</label>
                                    <input type="text" name="card_number" class="form-control" required placeholder="0000 0000 0000 0000" maxlength="19">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Son Kullanma Tarihi</label>
                                    <input type="text" name="card_expiry" class="form-control" required placeholder="AA/YY" maxlength="5">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">CVC</label>
                                    <input type="text" name="card_cvc" class="form-control" required placeholder="123" maxlength="3">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100 py-3 fw-bold fs-5">
                            <i class="bi bi-lock-fill"></i> Siparişi Tamamla ve Öde ({{ number_format($total, 2, ',', '.') }} ₺)
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-4">Sipariş Özeti</h5>
                    <div class="order-items mb-3" style="max-height: 300px; overflow-y: auto;">
                        @foreach($cart as $details)
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('storage/' . $details['image']) }}" style="width: 40px; height: 40px; object-fit: cover;" class="rounded">
                                    <div>
                                        <h6 class="mb-0 small fw-bold">{{ Str::limit($details['name'], 25) }}</h6>
                                        <small class="text-muted">{{ $details['quantity'] }} adet</small>
                                    </div>
                                </div>
                                <div class="fw-bold small">
                                    {{ number_format($details['price'] * $details['quantity'], 2, ',', '.') }} ₺
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Ara Toplam</span>
                        <span>{{ number_format($total, 2, ',', '.') }} ₺</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Kargo Ücreti</span>
                        <span class="text-success">Ücretsiz</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold fs-5">Ödenecek Tutar</span>
                        <span class="fw-bold fs-5 text-primary">{{ number_format($total, 2, ',', '.') }} ₺</span>
                    </div>
                </div>
            </div>
            
            <div class="alert alert-info mt-3 d-flex gap-2">
                <i class="bi bi-shield-check fs-4"></i>
                <small>Bu sayfa 256-bit SSL sertifikası ile korunmaktadır. Ödemeleriniz %100 güvence altındadır.</small>
            </div>
        </div>
    </div>
</div>
@endsection
