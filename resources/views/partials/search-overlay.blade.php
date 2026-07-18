{{-- Search Overlay --}}
<div class="search-overlay" id="searchOverlay">
    <div class="search-modal">
        <div class="search-input-wrap">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            <input type="text" class="search-input" id="searchInput" placeholder="Cari produk..." autocomplete="off">
            <button onclick="closeSearch()" style="padding:4px">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
        </div>
        <div class="search-results" id="searchResults">
            <div class="search-hint">Ketik untuk mencari produk...</div>
        </div>
    </div>
</div>
