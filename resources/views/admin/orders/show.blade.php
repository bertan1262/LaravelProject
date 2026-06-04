@extends('layouts.admin')
@section('title', 'Sipariş Detayı')
@section('page-title', 'Sipariş #'.$order->id)

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.order.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i> Siparişlere Dön</a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white fw-bold"><i class="bi bi-cart-check"></i> Sipariş Kalemleri</div>
            <div class="card-body p-0">
                <table class="table table-borderless mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Ürün</th>
                            <th>Fiyat</th>
                            <th>Adet</th>
                            <th class="text-end pe-4">Toplam</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr class="border-bottom">
                            <td class="ps-4">{{ $item->product_name }}</td>
                            <td>{{ number_format($item->price, 2, ',', '.') }} ₺</td>
                            <td>{{ $item->quantity }}</td>
                            <td class="text-end pe-4 fw-bold">{{ number_format($item->price * $item->quantity, 2, ',', '.') }} ₺</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white text-end pe-4 fw-bold fs-5">
                Genel Toplam: <span class="text-primary">{{ number_format($order->total_amount, 2, ',', '.') }} ₺</span>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white fw-bold"><i class="bi bi-person"></i> Müşteri Bilgileri</div>
            <div class="card-body">
                <p class="mb-1"><strong>Ad Soyad:</strong> {{ $order->customer_name }}</p>
                <p class="mb-1"><strong>E-posta:</strong> {{ $order->customer_email }}</p>
                <p class="mb-0 mt-3"><strong>Adres:</strong><br> {{ $order->shipping_address }}</p>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-bold"><i class="bi bi-gear"></i> Sipariş Durumu</div>
            <div class="card-body">
                <form action="{{ route('admin.order.update', $order) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="input-group">
                        <select name="status" class="form-select">
                            <option value="Sipariş Alındı" {{ $order->status == 'Sipariş Alındı' ? 'selected' : '' }}>Sipariş Alındı</option>
                            <option value="Kargoya Verildi" {{ $order->status == 'Kargoya Verildi' ? 'selected' : '' }}>Kargoya Verildi</option>
                            <option value="Tamamlandı" {{ $order->status == 'Tamamlandı' ? 'selected' : '' }}>Tamamlandı</option>
                            <option value="İptal Edildi" {{ $order->status == 'İptal Edildi' ? 'selected' : '' }}>İptal Edildi</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Güncelle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
