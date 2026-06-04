@extends('layouts.shop')
@section('title', 'Alışveriş Sepeti')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Alışveriş Sepetim</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(count($cart) > 0)
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Ürün</th>
                                        <th>Fiyat</th>
                                        <th>Adet</th>
                                        <th>Toplam</th>
                                        <th class="text-end pe-4">İşlem</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $id => $details)
                                    <tr class="border-bottom">
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" style="width: 50px; height: 50px; object-fit: cover;" class="rounded me-3">
                                                <h6 class="mb-0">{{ $details['name'] }}</h6>
                                            </div>
                                        </td>
                                        <td>{{ number_format($details['price'], 2, ',', '.') }} ₺</td>
                                        <td>
                                            <form action="{{ route('shop.cart.update') }}" method="POST" class="d-flex align-items-center">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $id }}">
                                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="form-control form-control-sm text-center me-2" style="width: 70px;" onchange="this.form.submit()">
                                            </form>
                                        </td>
                                        <td class="fw-bold">{{ number_format($details['price'] * $details['quantity'], 2, ',', '.') }} ₺</td>
                                        <td class="text-end pe-4">
                                            <form action="{{ route('shop.cart.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $id }}">
                                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-4">Sipariş Özeti</h5>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Ara Toplam</span>
                            <span>{{ number_format($total, 2, ',', '.') }} ₺</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Kargo Ücreti</span>
                            <span class="text-success">Ücretsiz</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold fs-5">Genel Toplam</span>
                            <span class="fw-bold fs-5 text-primary">{{ number_format($total, 2, ',', '.') }} ₺</span>
                        </div>
                        <a href="{{ route('shop.checkout.index') }}" class="btn btn-primary w-100 py-2 fw-bold">Güvenli Ödemeye Geç</a>
                        <div class="text-center mt-3">
                            <a href="{{ route('shop.products') }}" class="text-decoration-none text-muted small"><i class="bi bi-arrow-left"></i> Alışverişe Dön</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-cart-x text-muted" style="font-size: 4rem;"></i>
            <h4 class="mt-3 text-muted">Sepetiniz şu an boş.</h4>
            <p class="text-muted mb-4">Sepetinizde ürün bulunmamaktadır. Alışverişe başlamak için ürünlerimize göz atın.</p>
            <a href="{{ route('shop.products') }}" class="btn btn-primary px-4 py-2">Alışverişe Başla</a>
        </div>
    @endif
</div>
@endsection
