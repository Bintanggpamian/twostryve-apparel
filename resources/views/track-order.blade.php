@extends('layouts.app')
@section('title', 'Cek Status Pesanan — TWOSTRYVE')
@section('content')
@php use App\Helpers\FormatHelper; @endphp
<div class="track-order-box">
    <h1>Cek Status Pesanan</h1>
    <p style="color:var(--color-text-secondary);margin-bottom:var(--space-8)">Masukkan No. Invoice atau No. HP untuk mengecek status pesanan kamu.</p>
    <form action="{{ route('order.track.search') }}" method="POST" style="max-width:400px;margin:0 auto">
        @csrf
        <div class="form-group"><input type="text" class="form-input" name="query" placeholder="No. Invoice (INV-XXXXXX-XXXX) atau No. HP" style="text-align:center" value="{{ $query ?? '' }}"></div>
        <button type="submit" class="btn btn-primary btn-block btn-lg">Cek Pesanan</button>
    </form>
    <div id="trackResult" style="margin-top:var(--space-8)">
        @if(isset($query) && isset($order) && $order)
            @php
                $statusSteps = ['Pesanan Dibuat', 'Menunggu Pembayaran', 'Diverifikasi', 'Diproses', 'Dikirim', 'Selesai'];
                $statusMap = ['new' => 0, 'pending_payment' => 1, 'paid' => 2, 'processing' => 3, 'shipped' => 4, 'completed' => 5];
                $currentStep = $statusMap[$order->status] ?? 0;
            @endphp
            <div class="order-invoice" style="text-align:left">
                <div class="order-invoice-number">{{ $order->invoice }}</div>
                <div class="cart-summary-row"><span>Nama</span><span>{{ $order->customer_name }}</span></div>
                <div class="cart-summary-row"><span>Total</span><span style="font-weight:700;color:var(--color-accent)">{{ FormatHelper::price($order->total) }}</span></div>
                <div class="cart-summary-row"><span>Pembayaran</span><span style="text-transform:uppercase">{{ $order->payment_method }}</span></div>
                <div class="cart-summary-row"><span>Tanggal</span><span>{{ $order->created_at->format('d/m/Y') }}</span></div>
                <div class="order-timeline" style="margin-top:var(--space-8)">
                    @foreach($statusSteps as $i => $step)
                    <div class="timeline-step {{ $i < $currentStep ? 'completed' : '' }} {{ $i === $currentStep ? 'current' : '' }}">
                        <div class="timeline-step-title">{{ $step }}</div>
                        @if($i <= $currentStep)<div class="timeline-step-time">{{ $order->created_at->format('d/m/Y') }}</div>@endif
                    </div>
                    @endforeach
                </div>
            </div>
        @elseif(isset($query))
            <div class="empty-state" style="padding:var(--space-8)"><h3>Pesanan Tidak Ditemukan</h3><p>Pastikan No. Invoice atau No. HP yang kamu masukkan benar.</p></div>
        @endif
    </div>
</div>
@endsection
