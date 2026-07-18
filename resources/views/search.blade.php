@extends('layouts.app')
@section('title', 'Hasil Pencarian — TWOSTRYVE')
@section('content')
<div class="container section" style="min-height:60vh">
    <h1 style="font-family:var(--font-heading);font-size:var(--text-4xl);letter-spacing:2px;margin-bottom:var(--space-2)">HASIL PENCARIAN</h1>
    <p style="color:var(--color-text-muted);margin-bottom:var(--space-8)">{{ $results->count() }} hasil untuk "{{ $q }}"</p>
    @if($results->count() > 0)
        <div class="product-grid">@foreach($results as $product) @include('partials.product-card', ['product' => $product]) @endforeach</div>
    @else
        <div class="empty-state"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg><h3>Tidak Ditemukan</h3><p>Coba gunakan kata kunci lain.</p><a href="{{ route('shop') }}" class="btn btn-outline">Lihat Semua Produk</a></div>
    @endif
</div>
@endsection
