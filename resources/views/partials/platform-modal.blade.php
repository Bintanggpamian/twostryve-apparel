{{-- Online Store Platform Links Modal Popup --}}
@if(($storeSettings['popup_enabled'] ?? '1') !== '0')
<div class="platform-modal-overlay" id="platformModalOverlay" onclick="if(event.target === this) closePlatformModal()">
    <div class="platform-modal">
        <button class="platform-modal-close" onclick="closePlatformModal()" aria-label="Close">&times;</button>
        <div class="platform-modal-header">
            <h3 class="platform-modal-title">{{ $storeSettings['popup_title'] ?? 'ONLINE STORE' }}</h3>
            <p class="platform-modal-subtitle">{{ $storeSettings['popup_subtitle'] ?? 'Pilih platform e-commerce favorit kamu untuk berbelanja' }}</p>
        </div>
        <div class="platform-links-list">
            <a href="javascript:void(0)" onclick="closePlatformModal()" class="platform-link-btn" style="background: transparent; border: 1px solid #1e293b; color: #0f172a !important; justify-content: center; font-weight: 700; padding: 14px;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px;height:18px;margin-right:8px"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                Lanjut Lihat Website
            </a>
            
            @if(!empty($storeSettings['shopee_url']))
            <a href="{{ $storeSettings['shopee_url'] }}" target="_blank" class="platform-link-btn" style="background: #ee4d2d; color: #fff; border: none; justify-content: center; font-weight: 700; padding: 14px;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width:20px;height:20px;margin-right:8px"><path d="M19 6h-3c0-2.21-1.79-4-4-4S8 3.79 8 6H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-7-2c1.1 0 2 .9 2 2h-4c0-1.1.9-2 2-2zm0 10c-2.21 0-4-1.79-4-4h2c0 1.1.9 2 2 2s2-.9 2-2h2c0 2.21-1.79 4-4 4z"/></svg>
                Order via Shopee
            </a>
            @else
            <a href="#" class="platform-link-btn" style="background: #ee4d2d; color: #fff; border: none; justify-content: center; font-weight: 700; padding: 14px;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width:20px;height:20px;margin-right:8px"><path d="M19 6h-3c0-2.21-1.79-4-4-4S8 3.79 8 6H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-7-2c1.1 0 2 .9 2 2h-4c0-1.1.9-2 2-2zm0 10c-2.21 0-4-1.79-4-4h2c0 1.1.9 2 2 2s2-.9 2-2h2c0 2.21-1.79 4-4 4z"/></svg>
                Order via Shopee
            </a>
            @endif

            @if(!empty($storeSettings['whatsapp']))
            <a href="https://wa.me/{{ $storeSettings['whatsapp'] }}?text=Halo,%20saya%20ingin%20tanya%20produk%20TWOSTRYVE" target="_blank" class="platform-link-btn" style="background: #25D366; color: #fff; border: none; justify-content: center; font-weight: 700; padding: 14px;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width:20px;height:20px;margin-right:8px"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                Tanya WhatsApp
            </a>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (!sessionStorage.getItem('platform_modal_shown')) {
            setTimeout(function() {
                const modal = document.getElementById('platformModalOverlay');
                if (modal) modal.classList.add('active');
            }, 600);
        }
    });

    function closePlatformModal() {
        const modal = document.getElementById('platformModalOverlay');
        if (modal) modal.classList.remove('active');
        sessionStorage.setItem('platform_modal_shown', 'true');
    }

    function openPlatformModal() {
        const modal = document.getElementById('platformModalOverlay');
        if (modal) modal.classList.add('active');
    }
</script>
@endif
