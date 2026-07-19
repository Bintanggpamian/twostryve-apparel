# Product Requirements Document (PRD)
# Website E-Commerce & Promosi Brand — [Nama Brand Anda]

**Versi:** 1.0
**Tanggal:** 17 Juli 2026
**Tech Stack:** PHP Laravel + MySQL + CMS Kustom (Filament/Laravel Admin)
**Status:** Draft untuk review

---

## 1. Ringkasan Eksekutif

Dibangun berdasarkan riset terhadap referensi **screamous.com** (toko fashion/apparel streetwear berbasis Shopify), dokumen ini merancang website e-commerce sekaligus media promosi brand, dibangun di atas **Laravel**, dengan **Content Management System (CMS)** internal sehingga pemilik bisnis dapat mengelola seluruh konten (produk, banner, artikel, halaman) tanpa bantuan developer — perubahan di CMS **langsung tampil otomatis** di website utama.

Ciri utama dari referensi yang akan ditiru & disempurnakan:
- Homepage dengan hero banner promosi + grid produk terbaru/diskon
- Navigasi kategori bertingkat (kategori → sub-kategori)
- Halaman detail produk dengan varian (warna, ukuran), galeri gambar, harga coret (diskon)
- Blog/"Magazine" untuk konten promosi & storytelling brand
- Halaman statis (FAQ, Size Guide, How to Shop, Return Policy, Contact Us)
- Bisa dibuka & belanja tanpa harus login (guest browsing & guest checkout)
- Search, cart, social media links, newsletter

Perbedaan penting sesuai kebutuhan Anda:
- Menggunakan **Laravel custom**, bukan Shopify/SaaS → kontrol penuh, tanpa biaya subscription platform, bisa dihosting sendiri
- **Payment gateway ditunda** — checkout diarahkan ke **form pemesanan manual** (data pembeli + pilihan produk + metode pembayaran manual seperti transfer/COD), sehingga admin memproses pesanan secara manual dulu
- **CMS terintegrasi penuh**, bukan sekadar admin panel bawaan platform pihak ketiga

---

## 2. Tujuan Produk (Goals)

| # | Tujuan | Metrik Keberhasilan |
|---|--------|----------------------|
| 1 | Website menjadi etalase promosi brand yang profesional | Bounce rate < 50%, avg. session > 2 menit |
| 2 | Memungkinkan pengunjung memesan produk tanpa harus login | Conversion rate form order > 3% dari visitor |
| 3 | Admin dapat mengelola seluruh konten mandiri lewat CMS | Waktu upload produk baru < 5 menit/produk |
| 4 | Website cepat, mobile-friendly, dan SEO-friendly | PageSpeed score > 85, mobile-first design |
| 5 | Skalabel untuk fase berikutnya (payment gateway, member area, dsb) | Arsitektur modular, siap integrasi tanpa refactor besar |

### Non-Goals (di luar scope versi ini)
- Integrasi payment gateway (Midtrans/Xendit/dll) — **fase berikutnya**
- Aplikasi mobile native
- Multi-warehouse/multi-gudang
- Marketplace multi-vendor (hanya single-brand store)

---

## 3. Target Pengguna & Persona

**1. Pengunjung/Pembeli (Guest & Registered)**
- Datang dari Instagram/TikTok Ads atau pencarian Google
- Ingin browsing katalog cepat, lihat detail produk, dan pesan tanpa ribet daftar akun
- Mayoritas akses dari mobile

**2. Admin/Owner (Anda)**
- Non-teknis, perlu antarmuka CMS yang mudah dipakai (seperti mengisi form, drag-n-drop gambar)
- Mengelola produk, stok, kategori, banner promosi, artikel/blog, dan pesanan masuk

**3. Staff Operasional (opsional, role tambahan)**
- Admin gudang/CS yang hanya perlu akses ke modul pesanan & stok, bukan pengaturan situs

---

## 4. Informasi Arsitektur (Sitemap)

```
Website Utama (Public - tanpa login)
├── Home
│   ├── Hero Banner (slider promosi, dikelola CMS)
│   ├── Kategori Unggulan
│   ├── Produk Terbaru / New Arrivals
│   ├── Produk Diskon/Best Seller
│   ├── Artikel/Blog Terbaru
│   └── Newsletter signup
├── Shop / Semua Produk
│   ├── Filter: Kategori, Ukuran, Warna, Harga, Status (tersedia/habis)
│   ├── Sort: Terbaru, Termurah, Termahal, Terlaris
│   └── Pagination / infinite scroll
├── Kategori & Sub-kategori (dinamis dari CMS)
│   e.g. T-Shirt > Reglan, Long Sleeve, Bundling
├── Detail Produk
│   ├── Galeri gambar (multi-image, zoom)
│   ├── Varian: warna & ukuran (dengan stok per-varian)
│   ├── Harga coret + badge diskon %
│   ├── Deskripsi, size chart, bahan
│   ├── Tombol "Pesan Sekarang" → Form Order
│   ├── Produk terkait (related products)
│   └── Share ke social media
├── Keranjang (Cart) — session/cookie based, tanpa login
├── Form Pemesanan (Checkout tanpa payment gateway)
│   ├── Data pembeli (nama, no. HP/WA, email, alamat)
│   ├── Ringkasan pesanan & ongkir (manual/estimasi)
│   ├── Pilihan metode pembayaran manual (transfer bank/COD/QRIS statis)
│   └── Submit → generate No. Invoice + notifikasi ke Admin & pembeli
├── Blog / Magazine (artikel promosi, lookbook, event)
├── Halaman Statis (dikelola CMS, bisa tambah halaman baru)
│   ├── Tentang Kami
│   ├── FAQ
│   ├── Size Guide
│   ├── Cara Belanja (How to Shop)
│   ├── Kebijakan Retur
│   ├── Syarat & Ketentuan
│   └── Kontak Kami (form + peta + WA)
├── Cek Status Pesanan (input No. Invoice/No. HP)
├── Search (pencarian produk & artikel)
└── (Opsional) Login/Daftar Member — untuk histori order, wishlist

CMS / Admin Panel (login wajib, role-based)
├── Dashboard (ringkasan penjualan, pesanan baru, produk stok rendah)
├── Manajemen Produk
│   ├── CRUD produk, kategori, sub-kategori
│   ├── Manajemen varian (warna/ukuran) & stok per-varian
│   ├── Upload multi-gambar (drag & drop)
│   └── SEO field (meta title/description/slug per produk)
├── Manajemen Banner/Homepage
│   ├── Slider hero, promo banner, section "Produk Pilihan"
├── Manajemen Blog/Artikel
├── Manajemen Halaman Statis (page builder sederhana)
├── Manajemen Pesanan
│   ├── List pesanan masuk, ubah status (baru → diproses → dikirim → selesai/batal)
│   ├── Detail pesanan, cetak invoice/label pengiriman
│   └── Verifikasi bukti transfer manual (upload dari pembeli)
├── Manajemen Diskon/Promo (kode voucher / diskon otomatis)
├── Manajemen Pengguna & Role (Admin, Staff, CS)
├── Pengaturan Umum (info toko, WA, rekening bank, ongkir, social links)
└── Laporan (produk terlaris, omzet, kunjungan)
```

---

## 5. Functional Requirements (Kebutuhan Fungsional)

### 5.1 Website Publik

| ID | Fitur | Deskripsi | Prioritas |
|----|-------|-----------|-----------|
| F-01 | Browsing tanpa login | Semua halaman produk, kategori, blog bisa diakses tanpa akun | Must |
| F-02 | Katalog produk & filter | Filter kategori, ukuran, warna, rentang harga; sort harga/terbaru | Must |
| F-03 | Detail produk + varian | Pilih warna & ukuran, cek stok real-time per varian | Must |
| F-04 | Keranjang belanja | Simpan sementara di session/cookie, edit qty, hapus item | Must |
| F-05 | Form pemesanan (checkout) | Input data pembeli, alamat, catatan; tanpa payment gateway | Must |
| F-06 | Konfirmasi pesanan | Tampilkan No. Invoice, ringkasan, instruksi pembayaran manual | Must |
| F-07 | Upload bukti transfer | Pembeli bisa upload bukti bayar di halaman status pesanan | Should |
| F-08 | Cek status pesanan | Input No. Invoice/No. HP untuk cek status tanpa login | Should |
| F-09 | Blog/Magazine | List & detail artikel promosi | Must |
| F-10 | Halaman statis dinamis | FAQ, size guide, kebijakan, dll — dikelola dari CMS | Must |
| F-11 | Search | Cari produk & artikel berdasarkan kata kunci | Must |
| F-12 | Responsive/mobile-first | Tampil optimal di semua device | Must |
| F-13 | Integrasi WhatsApp | Tombol "Chat Admin" mengambang (floating) | Should |
| F-14 | Newsletter/Email capture | Form subscribe di footer/homepage | Could |
| F-15 | Wishlist (opsional, guest via cookie) | Simpan produk favorit | Could |
| F-16 | Login/Daftar member (opsional) | Untuk histori order & data tersimpan, tetap tidak wajib untuk belanja | Could |
| F-17 | SEO otomatis | Meta tag, sitemap.xml, schema markup produk | Must |

### 5.2 CMS / Admin Panel

| ID | Fitur | Deskripsi | Prioritas |
|----|-------|-----------|-----------|
| C-01 | CRUD Produk | Tambah/edit/hapus produk, kategori, varian, stok | Must |
| C-02 | Upload gambar multi & reorder | Drag-drop upload, atur urutan gambar galeri | Must |
| C-03 | Real-time publish | Perubahan di CMS langsung tampil di frontend (tanpa deploy ulang) | Must |
| C-04 | Manajemen Banner Homepage | Atur slider, promo section, tombol CTA | Must |
| C-05 | Manajemen Blog | Editor rich-text (WYSIWYG) untuk artikel | Must |
| C-06 | Page Builder Halaman Statis | Edit konten halaman (FAQ, Kontak dll) tanpa coding | Must |
| C-07 | Manajemen Pesanan | Lihat, ubah status, cetak invoice, catatan internal | Must |
| C-08 | Manajemen Diskon | Buat kode voucher / diskon otomatis per produk | Should |
| C-09 | Role & Permission | Admin, Staff CS, Manajer Konten — akses terbatas sesuai role | Should |
| C-10 | Dashboard Analitik | Grafik penjualan, produk terlaris, pesanan pending | Should |
| C-11 | Pengaturan Toko | No. rekening, WA CS, ongkir, social media, logo, favicon | Must |
| C-12 | Log Aktivitas Admin | Audit trail perubahan data penting | Could |
| C-13 | Export data pesanan/produk (Excel/CSV) | Untuk laporan & rekonsiliasi manual | Should |

---

## 6. Alur Pengguna Utama (User Flows)

### 6.1 Alur Belanja (Guest Checkout tanpa Login)
1. Pengunjung membuka Home → klik kategori/produk
2. Lihat detail produk → pilih warna & ukuran → cek stok tersedia
3. Klik "Tambah ke Keranjang" atau langsung "Pesan Sekarang"
4. Di halaman Keranjang → klik "Checkout"
5. Isi Form Pemesanan: Nama, No. WA, Alamat lengkap, Catatan, pilih metode pembayaran (Transfer Bank / QRIS statis / COD*)
6. Sistem generate **No. Invoice unik**, tampilkan ringkasan & instruksi pembayaran
7. Pembeli (opsional) upload bukti transfer
8. Sistem kirim notifikasi ke Admin (email/WA) + email/WA konfirmasi ke pembeli
9. Admin verifikasi manual di CMS → update status pesanan → kirim barang

*\*COD tergantung kebijakan bisnis, bisa dinonaktifkan di pengaturan.*

### 6.2 Alur Admin Mengelola Produk
1. Login ke CMS (`/admin`)
2. Menu Produk → "Tambah Produk Baru"
3. Isi nama, kategori, deskripsi, harga normal & harga diskon
4. Tambah varian (warna x ukuran) + stok masing-masing
5. Upload gambar produk (multi-upload, drag reorder)
6. Isi SEO (slug, meta title/desc) — auto-generate slug tapi bisa diedit
7. Klik "Publish" → produk otomatis tayang di frontend **tanpa perlu deploy**

### 6.3 Alur Verifikasi Pesanan
1. Admin buka menu Pesanan → lihat pesanan status "Baru"
2. Cek bukti transfer yang diupload pembeli
3. Ubah status → "Dibayar/Diverifikasi" → "Diproses" → "Dikirim" (input no. resi manual) → "Selesai"
4. Sistem otomatis kirim notifikasi update status ke pembeli (email/WA)

---

## 7. Kebutuhan Non-Fungsional

| Kategori | Kebutuhan |
|----------|-----------|
| **Performa** | Load time homepage < 3 detik; gunakan image lazy-load, CDN, cache (Redis/Laravel Cache) |
| **Skalabilitas** | Arsitektur modular Laravel (Service/Repository pattern) agar mudah tambah fitur (payment gateway di fase 2) |
| **Keamanan** | HTTPS wajib, validasi input (CSRF, XSS, SQL Injection protection bawaan Laravel), rate limiting form order untuk cegah spam, captcha di form order/kontak |
| **SEO** | Server-side rendering (Blade), sitemap.xml otomatis, meta tag dinamis, URL slug ramah SEO, schema.org Product markup |
| **Ketersediaan** | Uptime target 99.5%, backup database harian otomatis |
| **Aksesibilitas** | Kontras warna cukup, alt-text gambar wajib diisi di CMS, navigasi keyboard-friendly |
| **Kompatibilitas** | Cross-browser (Chrome, Safari, Firefox, Edge), responsive dari 360px–1920px |
| **Maintainability** | Kode mengikuti standar PSR-12, dokumentasi API internal, seed data & migration terstruktur |

---

## 8. Tech Stack & Arsitektur

**Backend:**
- Laravel 11.x (PHP 8.3+)
- database nanti saja dul 
- Laravel Sanctum (jika perlu API untuk mobile app di masa depan)
- Queue (database/redis driver) untuk kirim notifikasi email/WA async
- Laravel Storage (local/S3-compatible) untuk gambar produk

**Frontend Publik:**
- Blade Templating + Alpine.js untuk interaktivitas ringan (filter, slider, cart drawer)
- Tailwind CSS untuk styling cepat & konsisten
- Livewire (opsional) untuk komponen dinamis tanpa reload penuh (filter produk, cart update)

**CMS/Admin Panel:**
- **Filament PHP** (rekomendasi) — admin panel Laravel modern, cepat dibangun, mendukung CRUD, upload gambar, rich text editor, role & permission (via `spatie/laravel-permission`)
- Alternatif: Laravel Nova (berbayar) atau backpack/laravel-admin

**Integrasi Pendukung:**
- `spatie/laravel-medialibrary` — manajemen upload & resize gambar otomatis
- `spatie/laravel-sluggable` — auto slug SEO-friendly
- WA Notification via WhatsApp Business API/Fonnte/Wablas (untuk notifikasi pesanan) — opsional fase 1
- Mailtrap/SMTP (Mailgun/Sendgrid) untuk email notifikasi
- Google Analytics/Meta Pixel untuk tracking (sesuai kebutuhan ads)

**Hosting/Deployment:**
- VPS (misal DigitalOcean/Niagahoster/Biznet) dengan Nginx + PHP-FPM, atau shared hosting cPanel yang support Laravel
- CI/CD sederhana via GitHub Actions (opsional) atau deploy manual via Git pull + `php artisan migrate`

> Catatan penting soal "auto terganti tanpa deploy": karena CMS dan website publik berada dalam **satu aplikasi Laravel yang sama** (shared database), begitu admin klik "Publish/Save" di CMS, data langsung tersimpan di database dan otomatis tampil di halaman publik saat direfresh — tidak perlu proses deploy ulang kode.

---

## 9. Rancangan Struktur Data (Ringkasan Entity)

```
users            (admin, staff — role based)
customers        (opsional, untuk member; guest tidak wajib punya akun)
categories       (id, name, slug, parent_id [untuk sub-kategori], image, order)
products         (id, name, slug, description, category_id, price, sale_price,
                  sku, is_active, meta_title, meta_description, created_by)
product_variants (id, product_id, color, size, stock, sku_variant, extra_price)
product_images   (id, product_id, image_path, order, alt_text)
orders           (id, invoice_no, customer_name, phone, email, address,
                  subtotal, shipping_cost, total, payment_method, status,
                  payment_proof_path, notes, created_at)
order_items      (id, order_id, product_id, variant_id, qty, price, subtotal)
banners          (id, title, image, link_url, position, is_active, order)
articles         (id, title, slug, content, cover_image, published_at, is_active)
pages            (id, title, slug, content, meta_title, meta_description)  -- untuk halaman statis dinamis
discounts        (id, code, type[percentage/fixed], value, min_purchase, expired_at)
settings         (key, value) -- no rekening, WA CS, ongkir default, social links, dll
```

---

## 10. Perbandingan & Poin Peningkatan dari Referensi (screamous.com)

| Aspek di Referensi | Kelemahan/Catatan | Peningkatan yang Diusulkan |
|---|---|---|
| Berbasis Shopify (SaaS) | Biaya subscription bulanan, ketergantungan platform, kustomisasi terbatas | Laravel custom → biaya hosting saja, kontrol penuh source code |
| Checkout langsung ke payment gateway | Anda belum siap pasang payment gateway | Form order manual dulu + status "menunggu pembayaran", upgrade mudah ke Midtrans/Xendit di fase 2 tanpa ubah struktur data |
| Konfirmasi pesanan via **Google Form terpisah** | Tidak terhubung dengan sistem order, data terpisah, rawan human error | Semua terintegrasi 1 sistem: order → invoice otomatis → upload bukti bayar → tracking status, semua dalam 1 database |
| Filter produk terbatas | Filter dasar kategori saja | Filter kombinasi: kategori, ukuran, warna, rentang harga, ketersediaan stok |
| Tidak ada tracking pesanan mandiri | Pembeli harus WA admin untuk tanya status | Halaman "Cek Status Pesanan" mandiri via No. Invoice/No. HP |
| SEO bergantung theme Shopify | Kurang fleksibel atur meta per halaman | Setiap produk/artikel/halaman punya field SEO custom yang bisa diedit admin |
| Tidak ada dashboard analitik penjualan terpusat | Data ada di Shopify admin (berbayar) | Dashboard ringkas di CMS: omzet, produk terlaris, stok menipis |
| Loading gambar besar (300x300 & original) | Bisa lambat di koneksi lemah | Image optimization otomatis (resize & convert WebP) via `spatie/medialibrary` |
| WA Chat tidak terlihat langsung di beberapa halaman | Miss opportunity closing | Floating WA button di semua halaman publik |

---

## 11. Roadmap / Fase Pengembangan

**Fase 1 — MVP (Prioritas Utama, sesuai kebutuhan Anda saat ini)**
- Homepage, katalog produk, detail produk + varian
- Keranjang & Form Pemesanan manual (tanpa payment gateway)
- CMS: manajemen produk, kategori, banner, blog, halaman statis, pesanan
- Halaman statis (FAQ, Size Guide, dll), search, responsive design
- Notifikasi email pesanan baru ke admin

**Fase 2 — Penyempurnaan**
- Integrasi payment gateway (Midtrans/Xendit — QRIS, VA, e-wallet)
- Integrasi WhatsApp API otomatis untuk notifikasi status pesanan
- Member area (login, histori order, wishlist)
- Kode voucher/diskon otomatis, program membership

**Fase 3 — Skalasi**
- Dashboard analitik lanjutan (funnel, retensi pelanggan)
- Integrasi ekspedisi (cek ongkir otomatis via RajaOngkir API)
- Multi-admin dengan role granular
- App mobile (opsional, via API Laravel Sanctum)

---

## 12. Asumsi & Risiko

**Asumsi:**
- Pemilik bisnis akan menyediakan konten awal (foto produk, deskripsi, copy promosi)
- Volume pesanan awal masih bisa ditangani proses verifikasi manual
- Hosting/VPS akan disediakan terpisah dari biaya development

**Risiko & Mitigasi:**
| Risiko | Mitigasi |
|--------|----------|
| Tanpa payment gateway, potensi pesanan fiktif/spam | Tambahkan captcha, validasi No. HP, konfirmasi WA manual sebelum proses kirim |
| Admin non-teknis kesulitan pakai CMS | CMS dirancang sederhana (Filament) + buat panduan penggunaan (SOP/video tutorial) |
| Stok tidak sinkron saat pesanan ramai | Sistem kurangi stok otomatis saat status "Diverifikasi/Dibayar", bukan saat submit form saja |
| Trafik tinggi saat promo/flash sale | Terapkan caching halaman produk & queue untuk notifikasi agar server tidak overload |

---

## 13. Kriteria Sukses (Definition of Done — Fase 1)

- [ ] Website dapat diakses publik tanpa login, semua halaman utama berfungsi
- [ ] Admin bisa CRUD produk, kategori, banner, artikel, halaman statis dari CMS, dan perubahan langsung tampil di website tanpa perlu bantuan developer
- [ ] Pengunjung dapat memilih varian produk, memasukkan ke keranjang, dan mengisi form pemesanan hingga mendapat No. Invoice
- [ ] Admin menerima notifikasi pesanan baru dan dapat mengubah status pesanan dari CMS
- [ ] Website responsif di mobile & desktop, lolos uji dasar SEO (meta tag, sitemap)
- [ ] Tidak ada payment gateway aktif — pembayaran manual dikonfirmasi lewat upload bukti/WA

---

## 14. Lampiran — Rekomendasi Struktur Halaman Homepage

1. **Header**: Logo, menu kategori (dropdown multi-level), search icon, cart icon, floating WA
2. **Hero Section**: Banner slider promosi (dikelola CMS, ganti gambar & link kapan saja)
3. **Kategori Unggulan**: Grid kategori dengan gambar (klik → ke katalog kategori)
4. **New Arrivals**: Grid produk terbaru (auto dari tanggal input produk terbaru)
5. **Produk Diskon/Best Seller**: Bisa manual pilih via CMS (flag "featured")
6. **Banner Promosi Tengah**: Bisa diganti sesuai campaign (misal diskon akhir tahun)
7. **Artikel/Magazine Terbaru**: 3 artikel terbaru
8. **Newsletter Signup**
9. **Footer**: Menu halaman statis, social media, info kontak, metode pembayaran (logo bank/QRIS), copyright

---

**Catatan Akhir:** Dokumen ini adalah baseline PRD yang bisa terus disesuaikan seiring diskusi lebih lanjut — misalnya nama brand final, palet warna/branding, daftar kategori produk spesifik, dan kebijakan pengiriman/retur. Saya siap bantu breakdown ke **user stories teknis** atau **desain wireframe (mockup)** sebagai langkah selanjutnya jika dibutuhkan.
