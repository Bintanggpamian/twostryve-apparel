@php
    use App\Helpers\FormatHelper;
    $discount = FormatHelper::discountPercent($product->price, $product->sale_price);
    $firstImage = $product->first_image;
    $colors = $product->colors;
@endphp
<a href="{{ route('product.show', $product->slug) }}" class="product-card" data-product-id="{{ $product->id }}">
    <div class="product-card-image">
        <img src="{{ asset($firstImage) }}" alt="{{ $product->name }}" loading="lazy">
        <div class="product-card-badges">
            @if($product->is_new)
                <span class="badge badge-new">New</span>
            @endif
            @if($discount > 0)
                <span class="badge badge-sale">-{{ $discount }}%</span>
            @endif
        </div>
        <div class="product-card-actions">
            <form action="{{ route('cart.add') }}" method="POST" onclick="event.stopPropagation();" style="display:inline">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="color" value="{{ $colors[0]['name'] ?? 'Default' }}">
                <input type="hidden" name="size" value="{{ $product->sizes[0] ?? 'M' }}">
                <input type="hidden" name="qty" value="1">
                <button type="submit" class="product-card-action-btn" onclick="event.preventDefault(); event.stopPropagation(); this.closest('form').submit();" aria-label="Tambah ke keranjang">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                </button>
            </form>
        </div>
    </div>
    <div class="product-card-body">
        <div class="product-card-category">{{ $product->category?->name ?? '' }}</div>
        <h3 class="product-card-name">{{ $product->name }}</h3>
        <div class="product-card-price">
            <span class="price-current">{{ FormatHelper::price($product->display_price) }}</span>
            @if($product->sale_price)
                <span class="price-original">{{ FormatHelper::price($product->price) }}</span>
            @endif
        </div>
        @if(count($colors) > 1)
            <div class="product-card-colors">
                @foreach($colors as $c)
                    <span class="color-dot" style="background:{{ $c['hex'] }}" title="{{ $c['name'] }}"></span>
                @endforeach
            </div>
        @endif
    </div>
</a>
