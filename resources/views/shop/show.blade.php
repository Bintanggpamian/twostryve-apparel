@extends('layouts.app')
@section('title', $product->name . ' — TWOSTRYVE')
@section('meta_description', Str::limit(strip_tags($product->description), 160))

@section('content')
@php
    use App\Helpers\FormatHelper;
    $discount = $product->discount_percent;
    $colors = $product->colors;
    $sizes = $product->sizes;
    $defaultColor = $colors[0]['name'] ?? 'Default';
    $defaultSize = $sizes[0] ?? 'M';
    $variants = $product->variants;
@endphp

<div class="container product-detail">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a> <span class="sep">/</span>
        <a href="{{ route('shop') }}">Shop</a> <span class="sep">/</span>
        <a href="{{ route('shop', ['cat' => $product->category?->slug]) }}">{{ $product->category?->name }}</a> <span class="sep">/</span>
        <span>{{ $product->name }}</span>
    </div>

    <div class="product-detail-grid">
        <div class="gallery reveal-left">
            <div class="gallery-main" onclick="openLightbox(this.querySelector('img').src)">
                <img src="{{ asset($product->first_image) }}" alt="{{ $product->name }}" id="galleryMainImg">
            </div>
            <div class="gallery-thumbs">
                @foreach($product->images as $i => $img)
                <div class="gallery-thumb {{ $i === 0 ? 'active' : '' }}" onclick="switchGalleryImage('{{ asset($img->path) }}', this)">
                    <img src="{{ asset($img->path) }}" alt="{{ $product->name }} {{ $i + 1 }}">
                </div>
                @endforeach
            </div>
        </div>

        <div class="product-info reveal-right">
            <h1 class="product-name">{{ $product->name }}</h1>

            <div class="product-price-section">
                @if($product->sale_price)
                    <span class="product-price product-price-sale">{{ FormatHelper::price($product->sale_price) }}</span>
                    <span class="product-price-original">{{ FormatHelper::price($product->price) }}</span>
                    <span class="product-discount-badge">-{{ $discount }}%</span>
                @else
                    <span class="product-price">{{ FormatHelper::price($product->price) }}</span>
                @endif
            </div>

            <p class="product-desc">{{ $product->description }}</p>

            <div class="product-purchase-area" style="margin-top: 24px;">
                @if(count($colors) > 0)
                <div class="variant-section">
                    <div class="variant-label">Warna Tersedia: </div>
                    <div class="color-swatches" style="pointer-events: none;">
                        @foreach($colors as $i => $c)
                        <div class="color-swatch {{ $i === 0 ? 'active' : '' }}" style="background:{{ $c['hex'] }}" title="{{ $c['name'] }}"></div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="variant-section">
                    <div class="variant-label">Ukuran Tersedia:</div>
                    <div class="size-options" style="pointer-events: none;">
                        @foreach($sizes as $i => $s)
                            <div class="size-option active">{{ $s }}</div>
                        @endforeach
                    </div>
                </div>

                <div class="product-actions" style="margin-top: 32px;">
                    @if(!empty($storeSettings['shopee_url']))
                    <a href="{{ $storeSettings['shopee_url'] }}" target="_blank" class="btn btn-lg" style="flex:1; background: #ee4d2d; color: #fff; border: none; font-weight: 700; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width:24px;height:24px"><path d="M19 6h-3c0-2.21-1.79-4-4-4S8 3.79 8 6H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-7-2c1.1 0 2 .9 2 2h-4c0-1.1.9-2 2-2zm0 10c-2.21 0-4-1.79-4-4h2c0 1.1.9 2 2 2s2-.9 2-2h2c0 2.21-1.79 4-4 4z"/></svg>
                        Lanjut Order di Shopee
                    </a>
                    @else
                    <a href="#" class="btn btn-lg" style="flex:1; background: #ee4d2d; color: #fff; border: none; font-weight: 700; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width:24px;height:24px"><path d="M19 6h-3c0-2.21-1.79-4-4-4S8 3.79 8 6H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-7-2c1.1 0 2 .9 2 2h-4c0-1.1.9-2 2-2zm0 10c-2.21 0-4-1.79-4-4h2c0 1.1.9 2 2 2s2-.9 2-2h2c0 2.21-1.79 4-4 4z"/></svg>
                        Lanjut Order di Shopee
                    </a>
                    @endif
                </div>
            </div>

            <div class="accordion" style="margin-top:var(--space-8)">
                <div class="accordion-item">
                    <button class="accordion-trigger" onclick="this.parentElement.classList.toggle('open')">
                        Detail Produk <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px"><path d="m6 9 6 6 6-6"/></svg>
                    </button>
                    <div class="accordion-content"><div class="accordion-content-inner">
                        <p><strong>Material:</strong> {{ $product->material }}</p>
                        <p><strong>Berat:</strong> {{ $product->weight }}g</p>
                        <p>{{ $product->description }}</p>
                    </div></div>
                </div>
                <div class="accordion-item">
                    <button class="accordion-trigger" onclick="this.parentElement.classList.toggle('open')">
                        Size Guide <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px"><path d="m6 9 6 6 6-6"/></svg>
                    </button>
                    <div class="accordion-content"><div class="accordion-content-inner">
                        <p>Lihat <a href="{{ route('size-guide') }}" style="color:var(--color-accent);text-decoration:underline">Size Guide lengkap</a> untuk panduan ukuran.</p>
                    </div></div>
                </div>
                <div class="accordion-item">
                    <button class="accordion-trigger" onclick="this.parentElement.classList.toggle('open')">
                        Pengiriman & Retur <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px"><path d="m6 9 6 6 6-6"/></svg>
                    </button>
                    <div class="accordion-content"><div class="accordion-content-inner">
                        <p>Pesanan diproses dalam 1-2 hari kerja. Free ongkir untuk pembelian di atas {{ FormatHelper::price($storeSettings['free_shipping_min'] ?? 500000) }}.</p>
                        <p>Return/tukar dalam 7 hari setelah diterima. <a href="{{ route('return-policy') }}" style="color:var(--color-accent);text-decoration:underline">Baca kebijakan retur</a>.</p>
                    </div></div>
                </div>
            </div>
        </div>
    </div>

    @if($related->count() > 0)
    <section class="section">
        <div class="section-header">
            <h2 class="section-title">Produk Terkait</h2>
        </div>
        <div class="grid-4">
            @foreach($related as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>
    @endif
</div>

@push('scripts')
<script>
    // Variant data from server
    const productVariants = {!! json_encode($variantsData) !!};

    function selectColor(btn) {
        document.querySelectorAll('.color-swatch').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const color = btn.dataset.color;
        document.getElementById('selectedColorName').textContent = color;
        document.getElementById('colorInput').value = color;

        // Update size availability
        document.querySelectorAll('.size-option').forEach(opt => {
            const v = productVariants.find(v => v.color === color && v.size === opt.dataset.size);
            const stock = v ? v.stock : 0;
            opt.dataset.stock = stock;
            opt.classList.toggle('disabled', stock === 0);
            opt.disabled = stock === 0;
        });
        updateStockInfo();
    }

    function selectSize(btn) {
        if (btn.disabled) return;
        document.querySelectorAll('.size-option').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        document.getElementById('selectedSizeName').textContent = btn.dataset.size;
        document.getElementById('sizeInput').value = btn.dataset.size;
        updateStockInfo();
    }

    function updateStockInfo() {
        const color = document.getElementById('colorInput').value;
        const size = document.getElementById('sizeInput').value;
        const v = productVariants.find(v => v.color === color && v.size === size);
        const stock = v ? v.stock : 0;
        const el = document.getElementById('stockInfo');
        const addBtn = document.getElementById('addToCartBtn');
        if (stock === 0) {
            el.className = 'stock-info out'; el.textContent = 'Stok habis';
            if (addBtn) { addBtn.disabled = true; addBtn.classList.add('disabled'); }
        } else if (stock <= 5) {
            el.className = 'stock-info low'; el.textContent = 'Sisa ' + stock + ' — Hampir habis!';
            if (addBtn) { addBtn.disabled = false; addBtn.classList.remove('disabled'); }
        } else {
            el.className = 'stock-info'; el.textContent = 'Stok tersedia (' + stock + ')';
            if (addBtn) { addBtn.disabled = false; addBtn.classList.remove('disabled'); }
        }
    }

    function changeQty(delta) {
        const input = document.getElementById('productQty');
        let val = parseInt(input.value) + delta;
        if (val < 1) val = 1; if (val > 99) val = 99;
        input.value = val;
    }

    updateStockInfo();
</script>
@endpush
@endsection
