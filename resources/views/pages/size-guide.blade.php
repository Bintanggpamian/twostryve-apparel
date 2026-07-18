@extends('layouts.app')
@section('title', 'Size Guide — TWOSTRYVE')
@section('content')
@php
$charts = [
    ['title' => 'T-Shirt / Kaos', 'headers' => ['Size', 'Lebar (cm)', 'Panjang (cm)', 'Lengan (cm)'], 'rows' => [['S','50','68','21'],['M','53','71','22'],['L','56','74','23'],['XL','59','76','24'],['XXL','62','78','25']]],
    ['title' => 'Hoodie', 'headers' => ['Size', 'Lebar (cm)', 'Panjang (cm)', 'Lengan (cm)'], 'rows' => [['S','53','66','58'],['M','56','69','60'],['L','59','72','62'],['XL','62','74','64'],['XXL','65','76','66']]],
    ['title' => 'Pants / Celana', 'headers' => ['Size', 'Pinggang (cm)', 'Panjang (cm)', 'Paha (cm)'], 'rows' => [['28','72','98','56'],['30','76','100','58'],['32','80','102','60'],['34','84','104','62'],['36','88','106','64']]],
];
@endphp
<div class="page-hero"><div class="container"><h1>Size Guide</h1><p>Panduan ukuran untuk memastikan kamu mendapatkan fit yang sempurna</p></div></div>
<div class="page-content">
    <p>Semua ukuran dalam <strong>sentimeter (cm)</strong>. Toleransi ±1-2cm.</p>
    @foreach($charts as $chart)
    <h2>{{ $chart['title'] }}</h2>
    <table class="size-table">
        <thead><tr>@foreach($chart['headers'] as $h)<th>{{ $h }}</th>@endforeach</tr></thead>
        <tbody>@foreach($chart['rows'] as $row)<tr>@foreach($row as $cell)<td>{{ $cell }}</td>@endforeach</tr>@endforeach</tbody>
    </table>
    @endforeach
    <p style="margin-top:var(--space-8)">Masih ragu? <a href="https://wa.me/{{ $settings['whatsapp'] ?? '628123456789' }}" target="_blank" style="color:var(--color-accent);text-decoration:underline">Chat kami via WhatsApp</a></p>
</div>
@endsection
