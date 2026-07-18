/**
 * TWOSTRYVE Laravel - Frontend Interactivity
 * Replaces the SPA routing logic from old app.js with targeted UI enhancements.
 */

// ============= MOBILE MENU =============
const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const mobileNav = document.getElementById('mobileNav');
if (mobileMenuBtn && mobileNav) {
    mobileMenuBtn.addEventListener('click', () => {
        mobileMenuBtn.classList.toggle('active');
        mobileNav.classList.toggle('open');
        document.body.style.overflow = mobileNav.classList.contains('open') ? 'hidden' : '';
    });
    mobileNav.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            mobileMenuBtn.classList.remove('active');
            mobileNav.classList.remove('open');
            document.body.style.overflow = '';
        });
    });
}

// ============= HEADER SCROLL =============
let lastScroll = 0;
window.addEventListener('scroll', () => {
    const header = document.getElementById('siteHeader');
    if (!header) return;
    const st = window.scrollY;
    header.classList.toggle('scrolled', st > 50);
    if (st > lastScroll && st > 200) header.classList.add('hide');
    else header.classList.remove('hide');
    lastScroll = st;
});

// ============= HERO BANNER SLIDER =============
let heroIdx = 0;
let heroTimer = null;
function heroSlide(dir) {
    const slides = document.getElementById('heroSlides');
    const dots = document.querySelectorAll('.hero-dot');
    if (!slides || !dots.length) return;
    const total = dots.length;
    heroIdx = (heroIdx + dir + total) % total;
    slides.style.transform = `translateX(-${heroIdx * 100}%)`;
    dots.forEach((d, i) => d.classList.toggle('active', i === heroIdx));
    resetHeroTimer();
}
function heroGoTo(idx) {
    heroIdx = idx - 1;
    heroSlide(1);
}
function resetHeroTimer() {
    if (heroTimer) clearInterval(heroTimer);
    heroTimer = setInterval(() => heroSlide(1), 5000);
}
if (document.getElementById('heroSlides')) resetHeroTimer();

// ============= SEARCH OVERLAY =============
const searchBtn = document.getElementById('searchBtn');
const searchOverlay = document.getElementById('searchOverlay');
const searchInput = document.getElementById('searchInput');
if (searchBtn && searchOverlay) {
    searchBtn.addEventListener('click', () => {
        searchOverlay.classList.add('active');
        setTimeout(() => searchInput?.focus(), 300);
    });
    searchOverlay.addEventListener('click', (e) => {
        if (e.target === searchOverlay) closeSearch();
    });
}
function closeSearch() {
    searchOverlay?.classList.remove('active');
}

let searchDebounce = null;
if (searchInput) {
    searchInput.addEventListener('input', () => {
        clearTimeout(searchDebounce);
        searchDebounce = setTimeout(async () => {
            const q = searchInput.value.trim();
            const results = document.getElementById('searchResults');
            if (!q) { results.innerHTML = '<div class="search-hint">Ketik untuk mencari produk...</div>'; return; }
            try {
                const res = await fetch('/api/search?q=' + encodeURIComponent(q));
                const data = await res.json();
                if (data.length === 0) {
                    results.innerHTML = '<div class="search-hint">Tidak ada hasil untuk "' + q + '"</div>';
                } else {
                    results.innerHTML = data.map(p => `
                        <a href="/product/${p.slug}" class="search-result-item">
                            <img src="/${p.image}" alt="${p.name}" style="width:48px;height:48px;object-fit:cover;border-radius:6px">
                            <div><div style="font-weight:600">${p.name}</div><div style="font-size:12px;color:#888">Rp ${p.price.toLocaleString('id-ID')}</div></div>
                        </a>
                    `).join('');
                }
            } catch (e) {
                results.innerHTML = '<div class="search-hint">Gagal mencari. Coba lagi.</div>';
            }
        }, 300);
    });
    searchInput.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeSearch();
        if (e.key === 'Enter') {
            e.preventDefault();
            const q = searchInput.value.trim();
            if (q) { window.location.href = '/search?q=' + encodeURIComponent(q); }
        }
    });
}

// ============= BACK TO TOP =============
const backToTopBtn = document.getElementById('backToTop');
if (backToTopBtn) {
    window.addEventListener('scroll', () => {
        backToTopBtn.classList.toggle('show', window.scrollY > 600);
    });
    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

// ============= TOAST =============
function showToast(message, type = 'success', duration = 3000) {
    const container = document.getElementById('toastContainer');
    if (!container) return;
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `<span>${message}</span><button onclick="this.parentElement.remove()">×</button>`;
    container.appendChild(toast);
    setTimeout(() => toast.classList.add('show'), 10);
    setTimeout(() => { toast.classList.remove('show'); setTimeout(() => toast.remove(), 300); }, duration);
}

// ============= GALLERY (Product Page) =============
function switchGalleryImage(src, thumb) {
    const main = document.getElementById('galleryMainImg');
    if (main) main.src = src;
    document.querySelectorAll('.gallery-thumb').forEach(t => t.classList.remove('active'));
    if (thumb) thumb.classList.add('active');
}

function openLightbox(src) {
    const overlay = document.createElement('div');
    overlay.className = 'lightbox-overlay';
    overlay.innerHTML = `<div class="lightbox-content"><img src="${src}" alt="Product Image"><button class="lightbox-close" onclick="this.closest('.lightbox-overlay').remove()">×</button></div>`;
    overlay.addEventListener('click', (e) => { if (e.target === overlay) overlay.remove(); });
    document.body.appendChild(overlay);
}

// ============= SCROLL REVEAL =============
const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('revealed'); revealObserver.unobserve(e.target); }});
}, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

// ============= 2-STAGE FLY TO CART ANIMATION =============
function flyToCart(sourceElem, imgSrc) {
    const cartIcon = document.querySelector('.header-actions a[href*="cart"]') || document.querySelector('.cart-badge') || document.querySelector('.header-action-btn');
    if (!sourceElem || !cartIcon) return;

    const srcRect = sourceElem.getBoundingClientRect();
    const cartRect = cartIcon.getBoundingClientRect();
    const centerX = window.innerWidth / 2 - 32;
    const centerY = window.innerHeight / 2 - 32;

    const flyItem = document.createElement('div');
    flyItem.className = 'flying-cart-item';
    if (imgSrc) {
        flyItem.style.backgroundImage = `url(${imgSrc})`;
    } else {
        flyItem.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" style="width:32px;height:32px;margin:13px"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4zM3 6h18M16 10a4 4 0 01-8 0"/></svg>`;
    }

    // Start position
    flyItem.style.left = `${srcRect.left + srcRect.width / 2 - 32}px`;
    flyItem.style.top = `${srcRect.top + srcRect.height / 2 - 32}px`;
    flyItem.style.transform = 'scale(0.6)';
    document.body.appendChild(flyItem);

    // Stage 1: Move to center & enlarge
    setTimeout(() => {
        flyItem.style.left = `${centerX}px`;
        flyItem.style.top = `${centerY}px`;
        flyItem.style.transform = 'scale(1.25)';
        flyItem.style.boxShadow = '0 20px 50px rgba(0,0,0,0.6)';
    }, 30);

    // Stage 2: Fly to top right cart icon
    setTimeout(() => {
        flyItem.style.left = `${cartRect.left + cartRect.width / 2 - 16}px`;
        flyItem.style.top = `${cartRect.top + cartRect.height / 2 - 16}px`;
        flyItem.style.transform = 'scale(0.25)';
        flyItem.style.opacity = '0';
    }, 500);

    // Stage 3: Remove & bump cart icon
    setTimeout(() => {
        flyItem.remove();
        cartIcon.classList.add('cart-bump');
        setTimeout(() => cartIcon.classList.remove('cart-bump'), 400);
    }, 1050);
}

// Global listener for Add to Cart buttons
document.addEventListener('submit', (e) => {
    if (e.target && e.target.action && e.target.action.includes('/cart/add')) {
        const btn = e.target.querySelector('button[type="submit"]') || e.target;
        const card = e.target.closest('.product-card') || e.target.closest('.product-detail-layout');
        const img = card ? card.querySelector('img') : null;
        const imgSrc = img ? img.src : null;
        flyToCart(btn, imgSrc);
    }
});

// ============= FLASH MESSAGES =============
document.addEventListener('DOMContentLoaded', () => {
    const flashSuccess = document.querySelector('meta[name="flash-success"]');
    if (flashSuccess) showToast(flashSuccess.content, 'success');
});
