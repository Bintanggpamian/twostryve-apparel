@extends('layouts.app')
@section('title', ($page->title ?? 'Kebijakan Retur') . ' — TWOSTRYVE')
@section('content')
<div class="page-hero"><div class="container"><h1>{{ $page->title ?? 'Kebijakan Retur' }}</h1><p>{{ $page->subtitle ?? 'Return & Exchange Policy' }}</p></div></div>
<div class="page-content">
    {!! $page->content ?? '<p>Konten belum tersedia.</p>' !!}
    <p style="margin-top:var(--space-6)"><a href="https://wa.me/{{ $settings['whatsapp'] ?? '628123456789' }}" target="_blank" style="color:var(--color-accent);text-decoration:underline">Hubungi CS untuk proses return →</a></p>
</div>
@endsection
