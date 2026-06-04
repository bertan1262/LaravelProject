@extends('layouts.admin')
@section('title', 'Siparişler')
@section('page-title', 'Tüm Siparişler')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Sipariş No</th>
                        <th>Müşteri Adı</th>
                        <th>Toplam Tutar</th>
                        <th>Durum</th>
                        <th>Tarih</th>
                        <th class="text-end pe-4">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="ps-4 fw-bold">#{{ $order->id }}</td>
                        <td>
                            <div class="fw-bold">{{ $order->customer_name }}</div>
                            <small class="text-muted">{{ $order->customer_email }}</small>
                        </td>
                        <td class="fw-bold text-success">{{ number_format($order->total_amount, 2, ',', '.') }} ₺</td>
                        <td>
                            @php
                                $badge = match($order->status) {
                                    'Sipariş Alındı' => 'bg-info',
                                    'Kargoya Verildi' => 'bg-primary',
                                    'Tamamlandı' => 'bg-success',
                                    'İptal Edildi' => 'bg-danger',
                                    default => 'bg-secondary'
                                };
                            @endphp
                            <span class="badge {{ $badge }}">{{ $order->status }}</span>
                        </td>
                        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.order.show', $order) }}" class="btn btn-sm btn-outline-primary">Detay</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Henüz sipariş bulunmuyor.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($orders->hasPages())
    <div class="card-footer bg-white border-top">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection
