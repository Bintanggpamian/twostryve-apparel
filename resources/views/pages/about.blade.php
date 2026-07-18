@extends('layouts.app')
@section('title', ($page->title ?? 'Tentang Kami') . ' — TWOSTRYVE')
@section('content')
<div class="page-hero"><div class="container"><h1>{{ $page->title ?? 'Tentang Kami' }}</h1><p>{{ $page->subtitle ?? 'Mengenal lebih dekat TWOSTRYVE' }}</p></div></div>
<div class="page-content">{!! $page->content ?? '<p>Konten belum tersedia.</p>' !!}</div>
@endsection
