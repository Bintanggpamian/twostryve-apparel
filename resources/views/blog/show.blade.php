@extends('layouts.app')
@section('title', $article->title . ' — TWOSTRYVE')
@section('content')
<div class="article-detail">
    <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> <span class="sep">/</span> <a href="{{ route('blog') }}">Blog</a> <span class="sep">/</span> <span>{{ $article->title }}</span></div>
    <div class="article-detail-cover"><img src="{{ asset($article->cover_image) }}" alt="{{ $article->title }}"></div>
    <span class="article-card-tag">{{ $article->tag }}</span>
    <h1>{{ $article->title }}</h1>
    <div class="article-detail-meta"><span>{{ $article->published_at?->format('Y-m-d') }}</span><span>&middot;</span><span>{{ $article->read_time }}</span></div>
    <div class="article-detail-content">{!! $article->content !!}</div>
    @if($otherArticles->count() > 0)
    <div style="margin-top:var(--space-16)">
        <h2 class="section-title" style="margin-bottom:var(--space-6)">Artikel Lainnya</h2>
        <div class="grid-2">@foreach($otherArticles as $a) @include('partials.article-card', ['article' => $a]) @endforeach</div>
    </div>
    @endif
</div>
@endsection
