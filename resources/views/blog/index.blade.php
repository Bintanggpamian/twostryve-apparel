@extends('layouts.app')
@section('title', 'Magazine — TWOSTRYVE')
@section('content')
<div class="page-hero"><div class="container"><h1>Magazine</h1><p>Insight, tips, dan cerita dari dunia streetwear</p></div></div>
<div class="container section">
    <div class="blog-grid">
        @if($articles->count() > 0)
        <div class="blog-featured">@include('partials.article-card', ['article' => $articles->first()])</div>
        @endif
        @foreach($articles->skip(1) as $article)
            @include('partials.article-card', ['article' => $article])
        @endforeach
    </div>
</div>
@endsection
