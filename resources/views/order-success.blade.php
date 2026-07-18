@extends('layouts.app')
@section('title', 'Pesanan Berhasil — TWOSTRYVE')
@section('content')
@php use App\Helpers\FormatHelper; @endphp
<div class="order-success">
    <div class="order-success-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg></div>
    <h1>Pesanan Berhasil!</h1>
    <p style="color:var(--color-text-secondary)">Terima kasih sudah berbelanja di TWOSTRYVE. Berikut detail pesanan kamu.</p>
    <div class="order-invoice">
        <div class="order-invoice-number">{{ $invoice }}</div>
        @if($order)
        <div style="margin-bottom:var(--space-6)">
            @foreach($order->items as $item)
            <div style="display:flex;gap:var(--space-3);padding:var(--space-3) 0;border-bottom:1px solid var(--color-border)">
                <div style="flex:1;font-size:var(--text-sm)"><div style="font-weight:600">{{ $item->product_name }}</div><div style="color:var(--color-text-muted);font-size:var(--text-xs)">{{ $item->color }} / {{ $item->size }} × {{ $item->qty }}</div></div>
                <div style="font-weight:600;font-size:var(--text-sm)">{{ FormatHelper::price($item->subtotal) }}</div>
            </div>
            @endforeach
        </div>
        <div class="cart-summary-row"><span>Subtotal</span><span>{{ FormatHelper::price($order->subtotal) }}</span></div>
        <div class="cart-summary-row"><span>Ongkir</span><span>{{ $order->shipping == 0 ? 'GRATIS' : FormatHelper::price($order->shipping) }}</span></div>
        <div class="cart-summary-row total"><span>Total</span><span style="color:var(--color-accent)">{{ FormatHelper::price($order->total) }}</span></div>
        @endif
        @php $bankAccounts = $settings['bank_accounts'] ?? []; @endphp
        <div style="margin-top:var(--space-8);padding:var(--space-6);background:var(--color-bg);border-radius:var(--radius-md)">
            <h4 style="font-family:var(--font-heading);font-size:var(--text-xl);letter-spacing:2px;margin-bottom:var(--space-4)">INSTRUKSI PEMBAYARAN</h4>
            <p style="font-size:var(--text-sm);color:var(--color-text-secondary);margin-bottom:var(--space-4)">Silakan transfer ke salah satu rekening berikut:</p>
            @foreach($bankAccounts as $acc)
            <div style="padding:var(--space-3);border:1px solid var(--color-border);border-radius:var(--radius-sm);margin-bottom:var(--space-2)">
                <div style="font-weight:700">{{ $acc['bank'] }}</div>
                <div style="font-size:var(--text-lg);font-family:monospace;color:var(--color-accent)">{{ $acc['number'] }}</div>
                <div style="font-size:var(--text-xs);color:var(--color-text-muted)">a.n. {{ $acc['name'] }}</div>
            </div>
            @endforeach
            <p style="font-size:var(--text-sm);color:var(--color-warning);margin-top:var(--space-4)">⚠️ Lakukan pembayaran dalam 24 jam.</p>
        </div>
    </div>
    @php $wa = $settings['whatsapp'] ?? '628123456789'; @endphp
    <div style="margin-top:var(--space-8);display:flex;gap:var(--space-3);justify-content:center;flex-wrap:wrap">
        <a href="https://wa.me/{{ $wa }}?text=Halo,%20saya%20sudah%20memesan%20dengan%20invoice%20{{ $invoice }}" target="_blank" class="btn btn-primary">Konfirmasi via WA</a>
        <a href="{{ route('order.track') }}" class="btn btn-outline">Cek Status Pesanan</a>
        <a href="{{ route('shop') }}" class="btn btn-ghost">Lanjut Belanja</a>
    </div>
</div>
@endsection
