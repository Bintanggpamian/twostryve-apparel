@extends('layouts.app')
@section('title', 'FAQ — TWOSTRYVE')
@section('content')
@php
$faqItems = [
    ['q' => 'Bagaimana cara memesan produk di TWOSTRYVE?', 'a' => 'Pilih produk yang kamu inginkan, pilih warna dan ukuran, lalu klik "Tambah ke Keranjang". Setelah selesai belanja, buka keranjang dan klik "Checkout". Isi form pemesanan, pilih metode pembayaran, dan submit.'],
    ['q' => 'Apakah harus membuat akun untuk berbelanja?', 'a' => 'Tidak! Kamu bisa berbelanja langsung tanpa harus daftar atau login.'],
    ['q' => 'Metode pembayaran apa saja yang tersedia?', 'a' => 'Saat ini kami menerima Transfer Bank (BCA, Mandiri), QRIS, dan COD (khusus area tertentu).'],
    ['q' => 'Berapa lama proses pengiriman?', 'a' => 'Pesanan diproses dalam 1-2 hari kerja. Estimasi pengiriman 2-5 hari kerja (Jawa), 5-10 hari kerja (luar Jawa).'],
    ['q' => 'Apakah bisa return/tukar produk?', 'a' => 'Ya! Return/tukar dalam 7 hari setelah diterima, produk belum dicuci, belum dipakai, tag masih ada.'],
    ['q' => 'Bagaimana cara mengetahui ukuran yang tepat?', 'a' => 'Cek Size Guide yang kami sediakan. Jika masih ragu, hubungi CS kami.'],
    ['q' => 'Bagaimana cara cek status pesanan saya?', 'a' => 'Kunjungi halaman "Cek Status Pesanan" dan masukkan No. Invoice atau No. HP kamu.'],
];
@endphp
<div class="page-hero"><div class="container"><h1>FAQ</h1><p>Frequently Asked Questions</p></div></div>
<div class="page-content">
    @foreach($faqItems as $i => $item)
    <div class="faq-item" id="faq-{{ $i }}">
        <button class="faq-question" onclick="this.parentElement.classList.toggle('open'); const c = this.nextElementSibling; c.style.maxHeight = c.style.maxHeight ? null : c.scrollHeight + 'px';">
            {{ $item['q'] }} <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
        </button>
        <div class="faq-answer"><div class="faq-answer-inner">{{ $item['a'] }}</div></div>
    </div>
    @endforeach
</div>
@endsection
