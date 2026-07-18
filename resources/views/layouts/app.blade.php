<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'TWOSTRYVE — Brand streetwear lokal dengan kualitas premium. Kaos, hoodie, jacket, celana, dan aksesoris streetwear terbaik.')">
    <meta name="keywords" content="twostryve, streetwear, fashion, kaos, hoodie, jacket, cargo pants, brand lokal, indonesia">
    <meta name="author" content="TWOSTRYVE">
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta property="og:title" content="@yield('title', 'TWOSTRYVE — Streetwear Culture Redefined')">
    <meta property="og:description" content="@yield('meta_description', 'Brand streetwear lokal dengan kualitas premium.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('assets/images/hero-1.png'))">

    <title>@yield('title', 'TWOSTRYVE — Streetwear Culture Redefined')</title>

    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🔥</text></svg>">

    {{-- Original CSS from the static site --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@600;700;800;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @stack('styles')
</head>
<body>
    {{-- Announcement Bar --}}
    @php $freeShippingMin = $storeSettings['free_shipping_min'] ?? 500000; @endphp
    <div class="announcement-bar">{!! $storeSettings['announcement_text'] ?? ('🔥 FREE ONGKIR untuk pembelian di atas ' . App\Helpers\FormatHelper::price($freeShippingMin) . ' — <a href="' . route('shop') . '" style="text-decoration:underline">Shop Now</a>') !!}</div>

    {{-- Header --}}
    <header class="header {{ request()->routeIs('home') ? 'header--home' : '' }}" id="siteHeader">
        <div class="header-inner">
            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Menu">
                <span></span><span></span><span></span>
            </button>
            <a href="{{ route('home') }}" class="header-logo">
                @if(!empty($storeSettings['site_logo']))
                    <img src="{{ asset($storeSettings['site_logo']) }}" alt="{{ $storeSettings['site_name'] ?? 'TWOSTRYVE' }}" style="max-height:56px;height:auto;object-fit:contain">
                @else
                    {!! $storeSettings['site_logo_html'] ?? 'TWO<span>STRYVE</span>' !!}
                @endif
            </a>
            <nav class="header-nav" id="headerNav">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <div class="nav-dropdown">
                    <a href="{{ route('shop') }}" class="nav-link nav-dropdown-trigger {{ request()->routeIs('shop') ? 'active' : '' }}">
                        Shop <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:14px;height:14px"><path d="m6 9 6 6 6-6"/></svg>
                    </a>
                    <div class="nav-dropdown-menu">
                        <a href="{{ route('shop') }}" class="nav-dropdown-item">Semua Produk</a>
                        @foreach($navCategories as $cat)
                            <a href="{{ route('shop', ['cat' => $cat->slug]) }}" class="nav-dropdown-item">{{ $cat->name }}</a>
                        @endforeach
                    </div>
                </div>
                <a href="{{ route('blog') }}" class="nav-link {{ request()->routeIs('blog') ? 'active' : '' }}">Blog</a>
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Kontak</a>
            </nav>
            <div class="header-actions">
                <button class="header-action-btn" id="searchBtn" aria-label="Cari produk">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </button>
                <a href="{{ route('cart') }}" class="header-action-btn" aria-label="Keranjang">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                    <span class="cart-badge {{ collect(session('cart', []))->sum('qty') > 0 ? 'show' : '' }}" id="cartBadge">{{ collect(session('cart', []))->sum('qty') }}</span>
                </a>
            </div>
        </div>
    </header>

    {{-- Mobile Nav --}}
    <nav class="mobile-nav" id="mobileNav">
        <a href="{{ route('home') }}" class="mobile-nav-link">Home</a>
        <a href="{{ route('shop') }}" class="mobile-nav-link">Shop</a>
        <div class="mobile-nav-sub">
            @foreach($navCategories as $cat)
                <a href="{{ route('shop', ['cat' => $cat->slug]) }}" class="mobile-nav-link" style="font-family:var(--font-body);font-size:1rem;padding:0.5rem 0">{{ $cat->name }}</a>
            @endforeach
        </div>
        <a href="{{ route('blog') }}" class="mobile-nav-link">Blog</a>
        <a href="{{ route('about') }}" class="mobile-nav-link">About</a>
        <a href="{{ route('faq') }}" class="mobile-nav-link">FAQ</a>
        <a href="{{ route('contact') }}" class="mobile-nav-link">Kontak</a>
        <a href="{{ route('order.track') }}" class="mobile-nav-link">Cek Pesanan</a>
    </nav>

    {{-- Main Content --}}
    <main id="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="footer-brand-name">TWO<span>STRYVE</span></div>
                    <p class="footer-brand-desc">{{ $storeSettings['tagline'] ?? 'Streetwear Culture Redefined' }}. Brand streetwear lokal dengan kualitas premium dan desain yang berani.</p>
                    <div class="footer-socials">
                        <a href="{{ $storeSettings['instagram'] ?? '#' }}" target="_blank" class="footer-social-link" aria-label="Instagram"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg></a>
                        <a href="{{ $storeSettings['tiktok'] ?? '#' }}" target="_blank" class="footer-social-link" aria-label="TikTok"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1 0-5.78 2.92 2.92 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 3 15.57 6.33 6.33 0 0 0 9.37 22a6.33 6.33 0 0 0 6.33-6.33V9.18a8.16 8.16 0 0 0 4.59 1.45v-3.3a4.85 4.85 0 0 1-.7-.64z"/></svg></a>
                        <a href="{{ $storeSettings['facebook'] ?? '#' }}" target="_blank" class="footer-social-link" aria-label="Facebook"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
                    </div>
                </div>
                <div>
                    <h4 class="footer-heading">Shop</h4>
                    <div class="footer-links">
                        <a href="{{ route('shop') }}" class="footer-link">Semua Produk</a>
                        @foreach($navCategories->take(4) as $cat)
                            <a href="{{ route('shop', ['cat' => $cat->slug]) }}" class="footer-link">{{ $cat->name }}</a>
                        @endforeach
                    </div>
                </div>
                <div>
                    <h4 class="footer-heading">Info</h4>
                    <div class="footer-links">
                        <a href="{{ route('about') }}" class="footer-link">Tentang Kami</a>
                        <a href="{{ route('faq') }}" class="footer-link">FAQ</a>
                        <a href="{{ route('size-guide') }}" class="footer-link">Size Guide</a>
                        <a href="{{ route('how-to-shop') }}" class="footer-link">Cara Belanja</a>
                        <a href="{{ route('order.track') }}" class="footer-link">Cek Pesanan</a>
                    </div>
                </div>
                <div>
                    <h4 class="footer-heading">Kebijakan</h4>
                    <div class="footer-links">
                        <a href="{{ route('return-policy') }}" class="footer-link">Kebijakan Retur</a>
                        <a href="{{ route('terms') }}" class="footer-link">Syarat & Ketentuan</a>
                        <a href="{{ route('contact') }}" class="footer-link">Kontak Kami</a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="footer-copyright">&copy; {{ date('Y') }} TWOSTRYVE. All rights reserved.</p>
                <div class="footer-payment-methods">
                    <span class="footer-payment-badge">BCA</span>
                    <span class="footer-payment-badge">Mandiri</span>
                    <span class="footer-payment-badge">QRIS</span>
                    <span class="footer-payment-badge">COD</span>
                </div>
            </div>
        </div>
    </footer>

    {{-- Floating WhatsApp --}}
    @php $wa = $storeSettings['whatsapp'] ?? '628123456789'; @endphp
    <div class="wa-float">
        <span class="wa-float-label">Chat Admin</span>
        <a href="https://wa.me/{{ $wa }}?text=Halo,%20saya%20ingin%20bertanya%20tentang%20produk%20TWOSTRYVE" target="_blank" class="wa-float-btn" aria-label="Chat WhatsApp">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
        </a>
    </div>

    {{-- Back to Top --}}
    <button class="back-to-top" id="backToTop" aria-label="Kembali ke atas">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
    </button>

    {{-- Toast Container --}}
    <div class="toast-container" id="toastContainer"></div>

    {{-- Search Overlay --}}
    @include('partials.search-overlay')

    {{-- Platform Store Modal --}}
    @include('partials.platform-modal')

    {{-- Schema.org --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Store",
        "name": "TWOSTRYVE",
        "description": "Brand streetwear lokal dengan kualitas premium.",
        "url": "{{ url('/') }}",
        "contactPoint": {
            "@@type": "ContactPoint",
            "telephone": "+{{ $storeSettings['phone'] ?? '628123456789' }}",
            "contactType": "customer service",
            "availableLanguage": "Indonesian"
        }
    }
    </script>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
