@extends('layouts.app')
@section('title', 'Keranjang — TWOSTRYVE')
@section('content')
@php use App\Helpers\FormatHelper; @endphp
<div class="container" style="padding-top:var(--space-8);padding-bottom:var(--space-16);min-height:60vh">
    <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> <span class="sep">/</span> <span>Keranjang</span></div>
    <h1 style="font-family:var(--font-heading);font-size:var(--text-4xl);letter-spacing:2px;margin-bottom:var(--space-8)">KERANJANG BELANJA</h1>
    @if(empty($cart))
        <div class="empty-state">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            <h3>Keranjang Kosong</h3><p>Belum ada produk di keranjang kamu.</p>
            <a href="{{ route('shop') }}" class="btn btn-primary">Mulai Belanja</a>
        </div>
    @else
        <div class="cart-page-grid">
            <div>
                <div class="cart-table-header"><span>Produk</span><span>Harga</span><span>Jumlah</span><span>Subtotal</span><span></span></div>
                @foreach($cart as $key => $item)
                <div class="cart-page-item">
                    <div class="cart-page-item-info">
                        <div class="cart-page-item-image"><img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}"></div>
                        <div><div style="font-weight:600">{{ $item['name'] }}</div><div style="font-size:var(--text-xs);color:var(--color-text-muted);margin-top:4px">{{ $item['color'] }} / {{ $item['size'] }}</div></div>
                    </div>
                    <div style="font-size:var(--text-sm)">{{ FormatHelper::price($item['price']) }}</div>
                    <div>
                        <div class="cart-item-qty">
                            <form action="{{ route('cart.update') }}" method="POST" style="display:inline">@csrf<input type="hidden" name="key" value="{{ $key }}"><input type="hidden" name="qty" value="{{ $item['qty'] - 1 }}"><button type="submit">−</button></form>
                            <span>{{ $item['qty'] }}</span>
                            <form action="{{ route('cart.update') }}" method="POST" style="display:inline">@csrf<input type="hidden" name="key" value="{{ $key }}"><input type="hidden" name="qty" value="{{ $item['qty'] + 1 }}"><button type="submit">+</button></form>
                        </div>
                    </div>
                    <div style="font-weight:700">{{ FormatHelper::price($item['price'] * $item['qty']) }}</div>
                    <form action="{{ route('cart.remove') }}" method="POST">@csrf<input type="hidden" name="key" value="{{ $key }}"><button type="submit" class="cart-item-remove"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg></button></form>
                </div>
                @endforeach
            </div>
            <div class="cart-summary">
                <h3 class="cart-summary-title">Ringkasan Pesanan</h3>
                <div class="cart-summary-row"><span>Subtotal</span><span>{{ FormatHelper::price($subtotal) }}</span></div>
                <div class="cart-summary-row"><span>Estimasi Ongkir</span><span>{!! $shipping === 0 ? '<span style="color:var(--color-success)">GRATIS</span>' : FormatHelper::price($shipping) !!}</span></div>
                <div class="cart-summary-row total"><span>Total</span><span>{{ FormatHelper::price($total) }}</span></div>
                <a href="{{ route('checkout') }}" class="btn btn-primary btn-block btn-lg" style="margin-top:var(--space-6)">Checkout</a>
                <a href="{{ route('shop') }}" class="btn btn-ghost btn-block" style="margin-top:var(--space-3)">Lanjut Belanja</a>
            </div>
        </div>
    @endif
</div>
@endsection
