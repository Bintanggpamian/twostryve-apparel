@extends('layouts.app')
@section('title', ($page->title ?? 'Syarat & Ketentuan') . ' — TWOSTRYVE')
@section('content')
<div class="page-hero"><div class="container"><h1>{{ $page->title ?? 'Syarat & Ketentuan' }}</h1><p>{{ $page->subtitle ?? 'Terms and Conditions' }}</p></div></div>
<div class="page-content">{!! $page->content ?? '<p>Konten belum tersedia.</p>' !!}</div>
@endsection
