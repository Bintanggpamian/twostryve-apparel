{{-- Available E-Commerce Platforms Section (Ultra Elegan & Minimalist) --}}
<section class="ecommerce-section" style="padding: 70px 0; background: #0b0c0e; color: #ffffff; border-top: 1px solid rgba(255,255,255,0.08);">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div style="text-align: center; margin-bottom: 44px;">
            <span style="font-size: 11px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; color: #94a3b8; display: inline-block; margin-bottom: 10px;">Official Storefronts</span>
            <h2 style="font-family: 'Raleway', sans-serif; font-size: 26px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; margin: 0; color: #ffffff;">AVAILABLE ON E-COMMERCE</h2>
            <p style="font-size: 13px; color: #64748b; margin-top: 8px; max-width: 500px; margin-left: auto; margin-right: auto;">Temukan koleksi original TWOSTRYVE di platform e-commerce pilihan kamu</p>
        </div>

        <div style="display: flex; justify-content: center;">
            @if(!empty($storeSettings['shopee_url']))
            <a href="{{ $storeSettings['shopee_url'] }}" target="_blank" class="elegan-market-card" style="max-width: 300px; width: 100%; padding: 24px; border-color: #ee4d2d;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#ee4d2d" style="width:32px;height:32px;margin-bottom:12px;transition: transform 0.3s ease;"><path d="M19 6h-3c0-2.21-1.79-4-4-4S8 3.79 8 6H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-7-2c1.1 0 2 .9 2 2h-4c0-1.1.9-2 2-2zm0 10c-2.21 0-4-1.79-4-4h2c0 1.1.9 2 2 2s2-.9 2-2h2c0 2.21-1.79 4-4 4z"/></svg>
                <span style="font-size: 16px; font-weight: 700; letter-spacing: 1px;">Shopee Store</span>
            </a>
            @else
            <a href="#" class="elegan-market-card" style="max-width: 300px; width: 100%; padding: 24px; border-color: #ee4d2d;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#ee4d2d" style="width:32px;height:32px;margin-bottom:12px;transition: transform 0.3s ease;"><path d="M19 6h-3c0-2.21-1.79-4-4-4S8 3.79 8 6H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-7-2c1.1 0 2 .9 2 2h-4c0-1.1.9-2 2-2zm0 10c-2.21 0-4-1.79-4-4h2c0 1.1.9 2 2 2s2-.9 2-2h2c0 2.21-1.79 4-4 4z"/></svg>
                <span style="font-size: 16px; font-weight: 700; letter-spacing: 1px;">Shopee Store</span>
            </a>
            @endif
        </div>
    </div>
</section>
<style>
.elegan-market-card:hover svg {
    transform: scale(1.1);
}
.elegan-market-card:hover {
    box-shadow: 0 0 20px rgba(238, 77, 45, 0.2);
}
</style>
