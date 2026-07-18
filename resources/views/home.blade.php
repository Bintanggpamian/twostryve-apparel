@extends('layouts.app')
@section('title', 'TWOSTRYVE — Streetwear Culture Redefined')

@section('content')
@php use App\Helpers\FormatHelper; @endphp

{{-- Hero Banner --}}
@if($banners->count() > 0)
<section class="hero" id="heroBanner">
    <div class="hero-slides" id="heroSlides">
        @foreach($banners as $banner)
        <div class="hero-slide">
            <img src="{{ asset($banner->image) }}" alt="{{ $banner->title }}">
            <div class="hero-slide-overlay">
                <div class="hero-content">
                    <span class="hero-tag">{{ $banner->tag }}</span>
                    <h1 class="hero-title">{{ $banner->title }}</h1>
                    <p class="hero-desc">{{ $banner->description }}</p>
                    <div class="hero-cta">
                        <a href="{{ $banner->link }}" class="btn btn-primary btn-lg">{{ $banner->cta }}</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <button class="hero-arrow hero-arrow-prev" onclick="heroSlide(-1)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg></button>
    <button class="hero-arrow hero-arrow-next" onclick="heroSlide(1)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg></button>
    <div class="hero-nav" id="heroNav">
        @foreach($banners as $i => $banner)
        <div class="hero-dot {{ $i === 0 ? 'active' : '' }}" onclick="heroGoTo({{ $i }})"></div>
        @endforeach
    </div>
</section>
@endif

{{-- Categories --}}
@if($categories->count() > 0)
<section class="section">
    <div class="container">
        <div class="section-header reveal">
            <h2 class="section-title">Kategori</h2>
            <a href="{{ route('shop') }}" class="section-link">Lihat Semua <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px"><path d="m9 18 6-6-6-6"/></svg></a>
        </div>
        <div class="grid-4 reveal">
            @foreach($categories->take(4) as $cat)
            <a href="{{ route('shop', ['cat' => $cat->slug]) }}" class="category-card">
                <img src="{{ asset($cat->image) }}" alt="{{ $cat->name }}" loading="lazy">
                <div class="category-card-overlay">
                    <div>
                        <div class="category-card-name">{{ $cat->name }}</div>
                        <div class="category-card-count">{{ $cat->product_count }} Produk</div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- New Arrivals --}}
@if($newProducts->count() > 0)
<section class="section" style="background:#f9f9f9">
    <div class="container">
        <div class="section-header reveal">
            <h2 class="section-title">New Arrivals</h2>
            <a href="{{ route('shop', ['sort' => 'newest']) }}" class="section-link">Lihat Semua <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px"><path d="m9 18 6-6-6-6"/></svg></a>
        </div>
        <div class="grid-4 reveal">
            @foreach($newProducts->take(4) as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Promo Banner --}}
@if(($storeSettings['show_promo_banner'] ?? '1') !== '0')
<section class="section-sm">
    <div class="container reveal">
        <div class="promo-banner">
            <img src="{{ asset($storeSettings['promo_banner_image'] ?? 'assets/images/promo-mid.png') }}" alt="Promo Banner" loading="lazy">
            <div class="promo-banner-overlay">
                <div class="promo-banner-content">
                    <h2>{{ $storeSettings['promo_banner_title'] ?? 'Free Ongkir' }}</h2>
                    <p style="color:#eee;margin-bottom:24px">{{ $storeSettings['promo_banner_desc'] ?? ('Untuk pembelian di atas ' . FormatHelper::price($storeSettings['free_shipping_min'] ?? 500000)) }}</p>
                    <a href="{{ $storeSettings['promo_banner_link'] ?? route('shop') }}" class="btn btn-primary btn-lg">{{ $storeSettings['promo_banner_cta'] ?? 'Belanja Sekarang' }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- Sale Products --}}
@if($saleProducts->count() > 0)
<section class="section">
    <div class="container">
        <div class="section-header reveal">
            <h2 class="section-title">🔥 Sale</h2>
            <a href="{{ route('shop', ['sale' => 'true']) }}" class="section-link">Lihat Semua <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px"><path d="m9 18 6-6-6-6"/></svg></a>
        </div>
        <div class="grid-4 reveal">
            @foreach($saleProducts->take(4) as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Best Sellers --}}
@if($featuredProducts->count() > 0)
<section class="section" style="background:#f9f9f9">
    <div class="container">
        <div class="section-header reveal">
            <h2 class="section-title">Best Sellers</h2>
            <a href="{{ route('shop', ['sort' => 'popular']) }}" class="section-link">Lihat Semua <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px"><path d="m9 18 6-6-6-6"/></svg></a>
        </div>
        <div class="grid-4 reveal">
            @foreach($featuredProducts as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Magazine --}}
@if($articles->count() > 0)
<section class="section">
    <div class="container">
        <div class="section-header reveal">
            <h2 class="section-title">Magazine</h2>
            <a href="{{ route('blog') }}" class="section-link">Lihat Semua <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px"><path d="m9 18 6-6-6-6"/></svg></a>
        </div>
        <div class="grid-3 reveal">
            @foreach($articles as $article)
                @include('partials.article-card', ['article' => $article])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Newsletter --}}
<section class="section-sm">
    <div class="container reveal">
        <div class="newsletter">
            <h2 class="newsletter-title">Stay Updated</h2>
            <p class="newsletter-desc">Daftar newsletter kami untuk mendapatkan info produk terbaru, promo eksklusif, dan konten menarik.</p>
            <form class="newsletter-form" onsubmit="event.preventDefault(); showToast('Terima kasih sudah subscribe! 🎉', 'success'); this.reset();">
                <input type="email" class="newsletter-input" placeholder="Email kamu..." required>
                <button type="submit" class="btn btn-primary">Subscribe</button>
            </form>
        </div>
    </div>
</section>

{{-- E-Commerce Platforms Section --}}
@include('partials.ecommerce-section')
@endsection
