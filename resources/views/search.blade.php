@extends('layouts.app')
@section('title', 'Hasil Pencarian — TWOSTRYVE')
@section('content')
<div class="container section" style="min-height:60vh">
    <h1 style="font-family:var(--font-heading);font-size:var(--text-4xl);letter-spacing:2px;margin-bottom:var(--space-2)">HASIL PENCARIAN</h1>
    @php
        $totalResults = $results['products']->count() + $results['articles']->count() + $results['categories']->count();
    @endphp
    <p style="color:var(--color-text-muted);margin-bottom:var(--space-8)">{{ $totalResults }} hasil untuk "{{ $q }}"</p>
    
    @if($totalResults > 0)
        
        @if($results['products']->count() > 0)
            <h2 style="font-size:18px;margin-bottom:16px;text-transform:uppercase;letter-spacing:1px">Produk</h2>
            <div class="product-grid" style="margin-bottom:40px">
                @foreach($results['products'] as $product) 
                    @include('partials.product-card', ['product' => $product]) 
                @endforeach
            </div>
        @endif

        @if($results['categories']->count() > 0)
            <h2 style="font-size:18px;margin-bottom:16px;text-transform:uppercase;letter-spacing:1px">Kategori</h2>
            <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(200px, 1fr));gap:16px;margin-bottom:40px">
                @foreach($results['categories'] as $category)
                    <a href="{{ route('shop', ['cat' => $category->slug]) }}" style="display:block;border:1px solid #e2e8f0;border-radius:8px;padding:16px;text-align:center;text-decoration:none;color:#0f172a;transition:all 0.2s" onmouseover="this.style.borderColor='#000';this.style.boxShadow='0 4px 12px rgba(0,0,0,0.05)'" onmouseout="this.style.borderColor='#e2e8f0';this.style.boxShadow='none'">
                        @if($category->image)
                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" style="width:64px;height:64px;object-fit:cover;border-radius:50%;margin-bottom:12px">
                        @else
                            <div style="width:64px;height:64px;background:#f1f5f9;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 12px">
                                <svg style="width:24px;height:24px;color:#94a3b8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                            </div>
                        @endif
                        <div style="font-weight:700;font-size:14px">{{ $category->name }}</div>
                        <div style="font-size:12px;color:#64748b">{{ $category->product_count }} Produk</div>
                    </a>
                @endforeach
            </div>
        @endif

        @if($results['articles']->count() > 0)
            <h2 style="font-size:18px;margin-bottom:16px;text-transform:uppercase;letter-spacing:1px">Artikel & Blog</h2>
            <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(300px, 1fr));gap:24px;margin-bottom:40px">
                @foreach($results['articles'] as $article)
                    <a href="{{ route('article.show', $article->slug) }}" style="display:flex;gap:16px;text-decoration:none;color:#0f172a">
                        @if($article->cover_image)
                            <img src="{{ asset($article->cover_image) }}" alt="{{ $article->title }}" style="width:100px;height:100px;object-fit:cover;border-radius:8px;flex-shrink:0">
                        @else
                            <div style="width:100px;height:100px;background:#f1f5f9;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                                <svg style="width:32px;height:32px;color:#94a3b8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                            </div>
                        @endif
                        <div>
                            <h3 style="font-size:15px;font-weight:700;margin-bottom:6px;line-height:1.4">{{ $article->title }}</h3>
                            <div style="font-size:13px;color:#64748b;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">{{ $article->excerpt }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

    @else
        <div class="empty-state"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg><h3>Tidak Ditemukan</h3><p>Coba gunakan kata kunci lain.</p><a href="{{ route('shop') }}" class="btn btn-outline">Lihat Semua Produk</a></div>
    @endif
</div>
@endsection
