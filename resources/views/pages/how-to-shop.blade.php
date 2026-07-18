@extends('layouts.app')
@section('title', 'Cara Belanja — TWOSTRYVE')
@section('content')
<div class="page-hero"><div class="container"><h1>Cara Belanja</h1><p>Panduan langkah demi langkah untuk berbelanja di TWOSTRYVE</p></div></div>
<div class="container section">
    <div class="steps">
        <div class="step-card"><div class="step-number">1</div><h3>Pilih Produk</h3><p>Browse katalog, pilih warna & ukuran yang kamu inginkan.</p></div>
        <div class="step-card"><div class="step-number">2</div><h3>Checkout</h3><p>Masukkan ke keranjang, isi form data pembeli & alamat.</p></div>
        <div class="step-card"><div class="step-number">3</div><h3>Bayar</h3><p>Transfer ke rekening kami atau pilih metode pembayaran lain.</p></div>
        <div class="step-card"><div class="step-number">4</div><h3>Terima Barang</h3><p>Pesanan diproses & dikirim ke alamat kamu. Cek status kapan saja!</p></div>
    </div>
    <div style="text-align:center;margin-top:var(--space-12)">
        <p style="color:var(--color-text-secondary);margin-bottom:var(--space-4)">Butuh bantuan?</p>
        <a href="https://wa.me/{{ $settings['whatsapp'] ?? '628123456789' }}" target="_blank" class="btn btn-primary btn-lg">Chat Admin</a>
    </div>
</div>
@endsection
