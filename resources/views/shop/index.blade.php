@extends('layouts.app')
@section('title', ($currentCategory ? $currentCategory->name : 'Semua Produk') . ' — TWOSTRYVE')

@section('content')
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a> <span class="sep">/</span> <span>Shop</span>
            @if($currentCategory)
                <span class="sep">/</span> <span>{{ $currentCategory->name }}</span>
            @endif
        </div>
        <div class="page-hero" style="background:transparent;border:none;padding:var(--space-8) 0 var(--space-4)">
            <h1 style="text-align:left">
                {{ request('sale') === 'true' ? '🔥 Sale Items' : ($currentCategory ? $currentCategory->name : 'Semua Produk') }}
            </h1>
        </div>

        <div class="shop-layout">
            <aside class="shop-sidebar" id="shopSidebar">
                <div class="filter-group">
                    <h4 class="filter-title">Kategori</h4>
                    <div class="filter-option {{ !$catSlug ? 'active' : '' }}"
                        onclick="window.location='{{ route('shop') }}'">
                        <span class="filter-checkbox"></span> Semua <span class="filter-count">{{ $totalProducts }}</span>
                    </div>
                    @foreach($categories as $cat)
                        <div class="filter-option {{ $catSlug === $cat->slug ? 'active' : '' }}"
                            onclick="window.location='{{ route('shop', ['cat' => $cat->slug]) }}'">
                            <span class="filter-checkbox"></span> {{ $cat->name }} <span
                                class="filter-count">{{ $cat->products_count }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="filter-group">
                    <h4 class="filter-title">Promo</h4>
                    <div class="filter-option {{ request('sale') === 'true' ? 'active' : '' }}"
                        onclick="window.location='{{ route('shop', ['sale' => 'true']) }}'">
                        <span class="filter-checkbox"></span> Sedang Diskon <span
                            class="filter-count">{{ $saleCount }}</span>
                    </div>
                </div>

                {{-- OFFICIAL E-COMMERCE STORES --}}
                <div class="filter-group" style="margin-top: 24px; padding-top: 20px; border-top: 1px solid #e2e8f0;">
                    <h4 class="filter-title" style="letter-spacing: 1px;">Official Marketplace</h4>
                    <div style="display: flex; flex-direction: column; gap: 8px; margin-top: 12px;">
                        @if(!empty($storeSettings['shopee_url']))
                            <a href="{{ $storeSettings['shopee_url'] }}" target="_blank"
                                class="sidebar-market-btn sidebar-market-shopee">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    style="width:16px;height:16px">
                                    <path
                                        d="M19 6h-3c0-2.21-1.79-4-4-4S8 3.79 8 6H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-7-2c1.1 0 2 .9 2 2h-4c0-1.1.9-2 2-2zm0 10c-2.21 0-4-1.79-4-4h2c0 1.1.9 2 2 2s2-.9 2-2h2c0 2.21-1.79 4-4 4z" />
                                </svg>
                                <span>Shopee Store</span>
                            </a>
                        @endif
                        @if(!empty($storeSettings['tokopedia_url']))
                            <a href="{{ $storeSettings['tokopedia_url'] }}" target="_blank"
                                class="sidebar-market-btn sidebar-market-tokopedia">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    style="width:16px;height:16px">
                                    <path d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 18a8 8 0 110-16 8 8 0 010 16z" />
                                </svg>
                                <span>Tokopedia</span>
                            </a>
                        @endif
                        @if(!empty($storeSettings['tiktok_url']))
                            <a href="{{ $storeSettings['tiktok_url'] }}" target="_blank"
                                class="sidebar-market-btn sidebar-market-tiktok">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    style="width:16px;height:16px">
                                    <path
                                        d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1 0-5.78 2.92 2.92 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 3 15.57 6.33 6.33 0 0 0 9.37 22a6.33 6.33 0 0 0 6.33-6.33V9.18a8.16 8.16 0 0 0 4.59 1.45v-3.3a4.85 4.85 0 0 1-.7-.64z" />
                                </svg>
                                <span>TikTok Shop</span>
                            </a>
                        @endif
                        @if(!empty($storeSettings['blibli_url']))
                            <a href="{{ $storeSettings['blibli_url'] }}" target="_blank"
                                class="sidebar-market-btn sidebar-market-blibli">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    style="width:16px;height:16px">
                                    <path d="M12 2L2 7l10 5 10-5-10-5z" />
                                </svg>
                                <span>Blibli Store</span>
                            </a>
                        @endif
                        @if(!empty($storeSettings['lazada_url']))
                            <a href="{{ $storeSettings['lazada_url'] }}" target="_blank"
                                class="sidebar-market-btn sidebar-market-lazada">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    style="width:16px;height:16px">
                                    <path
                                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                </svg>
                                <span>Lazada Flagship</span>
                            </a>
                        @endif
                        @if(!empty($storeSettings['whatsapp']))
                            <a href="https://wa.me/{{ $storeSettings['whatsapp'] }}?text=Halo,%20saya%20ingin%20order%20produk%20TWOSTRYVE"
                                target="_blank" class="sidebar-market-btn sidebar-market-whatsapp">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    style="width:16px;height:16px">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                </svg>
                                <span>WhatsApp CS</span>
                            </a>
                        @endif
                    </div>
                </div>
            </aside>

            <div>
                <div class="shop-toolbar">
                    <button class="btn btn-ghost filter-toggle-btn"
                        onclick="document.getElementById('shopSidebar').classList.toggle('show')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" style="width:16px;height:16px">
                            <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                        </svg> Filter
                    </button>
                    <span class="shop-result-count">{{ $products->total() }} produk ditemukan</span>
                    <div class="shop-sort">
                        <label>Sort:</label>
                        <select
                            onchange="window.location='{{ route('shop') }}?{{ $catSlug ? 'cat=' . $catSlug . '&' : '' }}{{ request('sale') === 'true' ? 'sale=true&' : '' }}sort=' + this.value">
                            <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="price-low" {{ $sort === 'price-low' ? 'selected' : '' }}>Termurah</option>
                            <option value="price-high" {{ $sort === 'price-high' ? 'selected' : '' }}>Termahal</option>
                            <option value="popular" {{ $sort === 'popular' ? 'selected' : '' }}>Terlaris</option>
                        </select>
                    </div>
                </div>

                @if($products->count() > 0)
                    <div class="product-grid">
                        @foreach($products as $product)
                            @include('partials.product-card', ['product' => $product])
                        @endforeach
                    </div>
                    <div style="margin-top:var(--space-8);display:flex;justify-content:center">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                            <path d="M3 6h18" />
                            <path d="M16 10a4 4 0 0 1-8 0" />
                        </svg>
                        <h3>Tidak ada produk</h3>
                        <p>Coba ubah filter atau cari produk lain.</p>
                        <a href="{{ route('shop') }}" class="btn btn-outline">Lihat Semua Produk</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection