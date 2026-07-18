<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Banner;
use App\Models\Article;
use App\Models\Page;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@twostryve.id'],
            [
                'name' => 'Admin TWOSTRYVE',
                'password' => Hash::make('admin123'),
            ]
        );

        // ==========================================
        // CATEGORIES (from data.js)
        // ==========================================
        $categories = [
            ['name' => 'T-Shirt', 'slug' => 't-shirt', 'image' => 'assets/images/cat-tshirt.png', 'product_count' => 12, 'sort_order' => 1],
            ['name' => 'Hoodie', 'slug' => 'hoodie', 'image' => 'assets/images/cat-hoodie.png', 'product_count' => 8, 'sort_order' => 2],
            ['name' => 'Jacket', 'slug' => 'jacket', 'image' => 'assets/images/product-3.png', 'product_count' => 5, 'sort_order' => 3],
            ['name' => 'Pants', 'slug' => 'pants', 'image' => 'assets/images/cat-pants.png', 'product_count' => 6, 'sort_order' => 4],
            ['name' => 'Accessories', 'slug' => 'accessories', 'image' => 'assets/images/product-6.png', 'product_count' => 4, 'sort_order' => 5],
        ];
        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        // ==========================================
        // PRODUCTS (from data.js — all 8 products)
        // ==========================================
        $productsData = [
            [
                'name' => 'Shadow Graphic Tee', 'slug' => 'shadow-graphic-tee', 'category' => 't-shirt',
                'description' => 'Kaos oversized dengan graphic print shadow bold di bagian depan. Dibuat dari bahan cotton combed 24s premium yang lembut dan nyaman. Cocok untuk tampilan streetwear sehari-hari.',
                'material' => '100% Cotton Combed 24s', 'weight' => 250, 'price' => 189000, 'sale_price' => 149000,
                'is_new' => true, 'is_featured' => true, 'sold_count' => 156,
                'images' => ['assets/images/product-1.png'],
                'variants' => [
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'S', 'stock' => 15, 'sku' => 'SGT-BLK-S'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'M', 'stock' => 22, 'sku' => 'SGT-BLK-M'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'L', 'stock' => 18, 'sku' => 'SGT-BLK-L'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'XL', 'stock' => 10, 'sku' => 'SGT-BLK-XL'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'XXL', 'stock' => 5, 'sku' => 'SGT-BLK-XXL'],
                    ['color_name' => 'White', 'color_hex' => '#f5f5f5', 'size' => 'S', 'stock' => 12, 'sku' => 'SGT-WHT-S'],
                    ['color_name' => 'White', 'color_hex' => '#f5f5f5', 'size' => 'M', 'stock' => 20, 'sku' => 'SGT-WHT-M'],
                    ['color_name' => 'White', 'color_hex' => '#f5f5f5', 'size' => 'L', 'stock' => 14, 'sku' => 'SGT-WHT-L'],
                    ['color_name' => 'White', 'color_hex' => '#f5f5f5', 'size' => 'XL', 'stock' => 8, 'sku' => 'SGT-WHT-XL'],
                    ['color_name' => 'White', 'color_hex' => '#f5f5f5', 'size' => 'XXL', 'stock' => 0, 'sku' => 'SGT-WHT-XXL'],
                ],
            ],
            [
                'name' => 'Essential Hoodie', 'slug' => 'essential-hoodie', 'category' => 'hoodie',
                'description' => 'Hoodie essential dengan desain minimalis dan embroidered logo di dada. Bahan fleece 280gsm tebal dan hangat. Hood dengan drawstring adjustable.',
                'material' => 'Cotton Fleece 280gsm', 'weight' => 450, 'price' => 329000, 'sale_price' => null,
                'is_new' => true, 'is_featured' => true, 'sold_count' => 89,
                'images' => ['assets/images/product-2.png'],
                'variants' => [
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'S', 'stock' => 8, 'sku' => 'EH-BLK-S'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'M', 'stock' => 15, 'sku' => 'EH-BLK-M'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'L', 'stock' => 20, 'sku' => 'EH-BLK-L'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'XL', 'stock' => 12, 'sku' => 'EH-BLK-XL'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'XXL', 'stock' => 6, 'sku' => 'EH-BLK-XXL'],
                    ['color_name' => 'Charcoal', 'color_hex' => '#333333', 'size' => 'M', 'stock' => 10, 'sku' => 'EH-CHR-M'],
                    ['color_name' => 'Charcoal', 'color_hex' => '#333333', 'size' => 'L', 'stock' => 14, 'sku' => 'EH-CHR-L'],
                    ['color_name' => 'Charcoal', 'color_hex' => '#333333', 'size' => 'XL', 'stock' => 7, 'sku' => 'EH-CHR-XL'],
                ],
            ],
            [
                'name' => 'Urban Windbreaker', 'slug' => 'urban-windbreaker', 'category' => 'jacket',
                'description' => 'Windbreaker jacket dengan desain urban modern. Water-resistant, lightweight, dan stylish. Dilengkapi reflective details untuk keamanan di malam hari.',
                'material' => 'Polyester Ripstop Water-Resistant', 'weight' => 350, 'price' => 459000, 'sale_price' => 389000,
                'is_new' => false, 'is_featured' => true, 'sold_count' => 203,
                'images' => ['assets/images/product-3.png'],
                'variants' => [
                    ['color_name' => 'Olive', 'color_hex' => '#4a5339', 'size' => 'M', 'stock' => 6, 'sku' => 'UW-OLV-M'],
                    ['color_name' => 'Olive', 'color_hex' => '#4a5339', 'size' => 'L', 'stock' => 10, 'sku' => 'UW-OLV-L'],
                    ['color_name' => 'Olive', 'color_hex' => '#4a5339', 'size' => 'XL', 'stock' => 8, 'sku' => 'UW-OLV-XL'],
                    ['color_name' => 'Olive', 'color_hex' => '#4a5339', 'size' => 'XXL', 'stock' => 3, 'sku' => 'UW-OLV-XXL'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'M', 'stock' => 7, 'sku' => 'UW-BLK-M'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'L', 'stock' => 12, 'sku' => 'UW-BLK-L'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'XL', 'stock' => 9, 'sku' => 'UW-BLK-XL'],
                ],
            ],
            [
                'name' => 'Tactical Cargo Pants', 'slug' => 'tactical-cargo-pants', 'category' => 'pants',
                'description' => 'Cargo pants dengan multiple pockets dan utility straps. Bahan ripstop yang kuat dan tahan lama. Desain terinspirasi dari military gear.',
                'material' => 'Cotton Ripstop 240gsm', 'weight' => 420, 'price' => 379000, 'sale_price' => 299000,
                'is_new' => false, 'is_featured' => false, 'sold_count' => 312,
                'images' => ['assets/images/product-4.png'],
                'variants' => [
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => '28', 'stock' => 5, 'sku' => 'TCP-BLK-28'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => '30', 'stock' => 12, 'sku' => 'TCP-BLK-30'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => '32', 'stock' => 18, 'sku' => 'TCP-BLK-32'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => '34', 'stock' => 10, 'sku' => 'TCP-BLK-34'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => '36', 'stock' => 4, 'sku' => 'TCP-BLK-36'],
                    ['color_name' => 'Olive', 'color_hex' => '#4a5339', 'size' => '30', 'stock' => 8, 'sku' => 'TCP-OLV-30'],
                    ['color_name' => 'Olive', 'color_hex' => '#4a5339', 'size' => '32', 'stock' => 14, 'sku' => 'TCP-OLV-32'],
                    ['color_name' => 'Olive', 'color_hex' => '#4a5339', 'size' => '34', 'stock' => 6, 'sku' => 'TCP-OLV-34'],
                ],
            ],
            [
                'name' => 'Rebel Graphic Tee', 'slug' => 'rebel-graphic-tee', 'category' => 't-shirt',
                'description' => 'Kaos oversized dengan graphic print rebel yang edgy. Cotton combed 24s premium yang breathable. Print menggunakan teknik DTF berkualitas tinggi.',
                'material' => '100% Cotton Combed 24s', 'weight' => 250, 'price' => 179000, 'sale_price' => null,
                'is_new' => true, 'is_featured' => false, 'sold_count' => 45,
                'images' => ['assets/images/product-5.png'],
                'variants' => [
                    ['color_name' => 'White', 'color_hex' => '#f5f5f5', 'size' => 'S', 'stock' => 20, 'sku' => 'RGT-WHT-S'],
                    ['color_name' => 'White', 'color_hex' => '#f5f5f5', 'size' => 'M', 'stock' => 25, 'sku' => 'RGT-WHT-M'],
                    ['color_name' => 'White', 'color_hex' => '#f5f5f5', 'size' => 'L', 'stock' => 22, 'sku' => 'RGT-WHT-L'],
                    ['color_name' => 'White', 'color_hex' => '#f5f5f5', 'size' => 'XL', 'stock' => 15, 'sku' => 'RGT-WHT-XL'],
                    ['color_name' => 'White', 'color_hex' => '#f5f5f5', 'size' => 'XXL', 'stock' => 8, 'sku' => 'RGT-WHT-XXL'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'M', 'stock' => 18, 'sku' => 'RGT-BLK-M'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'L', 'stock' => 20, 'sku' => 'RGT-BLK-L'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'XL', 'stock' => 10, 'sku' => 'RGT-BLK-XL'],
                ],
            ],
            [
                'name' => 'Stryve Snapback', 'slug' => 'stryve-snapback', 'category' => 'accessories',
                'description' => 'Snapback cap dengan embroidered TWOSTRYVE logo. Adjustable strap di belakang. Bahan cotton twill premium.',
                'material' => 'Cotton Twill', 'weight' => 100, 'price' => 149000, 'sale_price' => 119000,
                'is_new' => false, 'is_featured' => true, 'sold_count' => 178,
                'images' => ['assets/images/product-6.png'],
                'variants' => [
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'One Size', 'stock' => 30, 'sku' => 'SS-BLK-OS'],
                ],
            ],
            [
                'name' => 'Void Long Sleeve', 'slug' => 'void-long-sleeve', 'category' => 't-shirt',
                'description' => 'Long sleeve oversized dengan minimalist sleeve print details. Cotton combed 24s double knit untuk kenyamanan ekstra.',
                'material' => '100% Cotton Combed 24s', 'weight' => 300, 'price' => 219000, 'sale_price' => null,
                'is_new' => true, 'is_featured' => false, 'sold_count' => 67,
                'images' => ['assets/images/product-7.png'],
                'variants' => [
                    ['color_name' => 'Charcoal', 'color_hex' => '#333333', 'size' => 'S', 'stock' => 10, 'sku' => 'VLS-CHR-S'],
                    ['color_name' => 'Charcoal', 'color_hex' => '#333333', 'size' => 'M', 'stock' => 18, 'sku' => 'VLS-CHR-M'],
                    ['color_name' => 'Charcoal', 'color_hex' => '#333333', 'size' => 'L', 'stock' => 15, 'sku' => 'VLS-CHR-L'],
                    ['color_name' => 'Charcoal', 'color_hex' => '#333333', 'size' => 'XL', 'stock' => 8, 'sku' => 'VLS-CHR-XL'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'M', 'stock' => 14, 'sku' => 'VLS-BLK-M'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'L', 'stock' => 12, 'sku' => 'VLS-BLK-L'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'XL', 'stock' => 6, 'sku' => 'VLS-BLK-XL'],
                ],
            ],
            [
                'name' => 'Fury Graphic Tee', 'slug' => 'fury-graphic-tee', 'category' => 't-shirt',
                'description' => 'Kaos oversized dengan desain bold dan warna merah maroon yang kuat. Cotton combed 24s premium. Perfect untuk statement outfit.',
                'material' => '100% Cotton Combed 24s', 'weight' => 250, 'price' => 189000, 'sale_price' => 159000,
                'is_new' => false, 'is_featured' => true, 'sold_count' => 134,
                'images' => ['assets/images/product-8.png'],
                'variants' => [
                    ['color_name' => 'Maroon', 'color_hex' => '#6b1d2a', 'size' => 'S', 'stock' => 12, 'sku' => 'FGT-MRN-S'],
                    ['color_name' => 'Maroon', 'color_hex' => '#6b1d2a', 'size' => 'M', 'stock' => 20, 'sku' => 'FGT-MRN-M'],
                    ['color_name' => 'Maroon', 'color_hex' => '#6b1d2a', 'size' => 'L', 'stock' => 16, 'sku' => 'FGT-MRN-L'],
                    ['color_name' => 'Maroon', 'color_hex' => '#6b1d2a', 'size' => 'XL', 'stock' => 10, 'sku' => 'FGT-MRN-XL'],
                    ['color_name' => 'Maroon', 'color_hex' => '#6b1d2a', 'size' => 'XXL', 'stock' => 4, 'sku' => 'FGT-MRN-XXL'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'M', 'stock' => 15, 'sku' => 'FGT-BLK-M'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'L', 'stock' => 18, 'sku' => 'FGT-BLK-L'],
                    ['color_name' => 'Black', 'color_hex' => '#1a1a1a', 'size' => 'XL', 'stock' => 9, 'sku' => 'FGT-BLK-XL'],
                ],
            ],
        ];

        foreach ($productsData as $pData) {
            $cat = Category::where('slug', $pData['category'])->first();
            $product = Product::updateOrCreate(
                ['slug' => $pData['slug']],
                [
                    'category_id' => $cat?->id,
                    'name' => $pData['name'],
                    'description' => $pData['description'],
                    'material' => $pData['material'],
                    'weight' => $pData['weight'],
                    'price' => $pData['price'],
                    'sale_price' => $pData['sale_price'],
                    'is_new' => $pData['is_new'],
                    'is_featured' => $pData['is_featured'],
                    'sold_count' => $pData['sold_count'],
                ]
            );

            // Images
            $product->images()->delete();
            foreach ($pData['images'] as $i => $img) {
                $product->images()->create(['path' => $img, 'alt_text' => $pData['name'], 'sort_order' => $i]);
            }

            // Variants
            $product->variants()->delete();
            foreach ($pData['variants'] as $v) {
                $product->variants()->create($v);
            }
        }

        // ==========================================
        // BANNERS
        // ==========================================
        Banner::updateOrCreate(['title' => 'New Collection 2026'], [
            'tag' => 'New Arrival', 'cta' => 'Shop Now', 'link' => '/shop',
            'image' => 'assets/images/hero-1.png',
            'description' => 'Koleksi terbaru yang menggabungkan urban style dengan kenyamanan premium.',
            'sort_order' => 1,
        ]);
        Banner::updateOrCreate(['title' => 'Mega Sale Up to 50%'], [
            'tag' => 'Sale', 'cta' => 'Shop Sale', 'link' => '/shop?sale=true',
            'image' => 'assets/images/hero-2.png',
            'description' => 'Diskon besar-besaran untuk item pilihan. Jangan sampai kehabisan.',
            'sort_order' => 2,
        ]);

        // ==========================================
        // ARTICLES
        // ==========================================
        $articles = [
            [
                'title' => 'Panduan Style: Mix & Match Streetwear untuk Sehari-hari',
                'slug' => 'panduan-style-mix-match-streetwear',
                'tag' => 'Style Guide', 'read_time' => '5 min read',
                'cover_image' => 'assets/images/hero-1.png',
                'excerpt' => 'Tips dan trik bagaimana memadukan item streetwear untuk tampilan sehari-hari yang stylish tanpa berlebihan.',
                'content' => '<p>Streetwear bukan sekadar pakaian — ini adalah ekspresi diri.</p><h2>1. Mulai dari Basic</h2><p>Fondasi streetwear yang kuat dimulai dari basic essentials: kaos polos berkualitas, hoodie, dan celana yang pas.</p><h2>2. Layering is Key</h2><p>Teknik layering adalah salah satu kunci utama dalam streetwear.</p><h2>3. Aksesoris yang Tepat</h2><p>Snapback cap, crossbody bag, atau socks yang matching bisa elevate outfit kamu ke level berikutnya.</p>',
                'published_at' => '2026-07-15',
            ],
            [
                'title' => 'Behind The Brand: Cerita di Balik TWOSTRYVE',
                'slug' => 'behind-the-brand-twostryve',
                'tag' => 'Brand Story', 'read_time' => '4 min read',
                'cover_image' => 'assets/images/hero-2.png',
                'excerpt' => 'Mengenal lebih dekat filosofi dan perjalanan brand TWOSTRYVE dari awal hingga sekarang.',
                'content' => '<p>TWOSTRYVE lahir dari kecintaan terhadap budaya streetwear.</p><h2>Awal Mula</h2><p>Berawal dari sebuah mimpi sederhana — menciptakan brand lokal yang bisa bersaing.</p><h2>Filosofi Desain</h2><p>Setiap piece yang kami rancang memiliki cerita.</p>',
                'published_at' => '2026-07-10',
            ],
            [
                'title' => 'Tren Streetwear 2026: Warna, Siluet, dan Material',
                'slug' => 'tren-streetwear-2026',
                'tag' => 'Trend', 'read_time' => '6 min read',
                'cover_image' => 'assets/images/product-3.png',
                'excerpt' => 'Breakdown tren streetwear yang mendominasi tahun 2026 — dari earth tones hingga techwear influence.',
                'content' => '<p>Tahun 2026 membawa angin segar untuk dunia streetwear.</p><h2>Earth Tones Dominan</h2><p>Olive, khaki, brown mendominasi.</p><h2>Oversized Masih Berkuasa</h2><p>Siluet oversized masih menjadi favorit.</p>',
                'published_at' => '2026-07-05',
            ],
        ];
        foreach ($articles as $art) {
            Article::updateOrCreate(['slug' => $art['slug']], $art);
        }

        // ==========================================
        // PAGES (static content from PAGES_CONTENT)
        // ==========================================
        Page::updateOrCreate(['slug' => 'about'], [
            'title' => 'Tentang Kami', 'subtitle' => 'Mengenal lebih dekat TWOSTRYVE',
            'content' => '<p><strong>TWOSTRYVE</strong> adalah brand streetwear lokal yang lahir dari semangat untuk menghadirkan fashion urban berkualitas premium dengan harga yang terjangkau.</p><h2>Visi Kami</h2><p>Menjadi brand streetwear terdepan yang menginspirasi generasi muda untuk berani mengekspresikan diri melalui fashion.</p><h2>Misi Kami</h2><p>Menciptakan produk streetwear yang menggabungkan desain bold, material premium, dan kenyamanan.</p>',
        ]);
        Page::updateOrCreate(['slug' => 'return-policy'], [
            'title' => 'Kebijakan Retur', 'subtitle' => 'Return & Exchange Policy',
            'content' => '<h2>Ketentuan Umum</h2><p>Kami menerima pengembalian atau penukaran produk dalam waktu <strong>7 hari</strong> setelah produk diterima.</p><h2>Syarat Return/Tukar</h2><p>• Produk belum pernah dicuci atau dipakai<br>• Tag dan label masih terpasang<br>• Disertai bukti pembelian (No. Invoice)</p>',
        ]);
        Page::updateOrCreate(['slug' => 'terms'], [
            'title' => 'Syarat & Ketentuan', 'subtitle' => 'Terms and Conditions',
            'content' => '<p>Dengan mengakses dan menggunakan website TWOSTRYVE (twostryve.id), Anda dianggap telah membaca, memahami, dan menyetujui seluruh Syarat & Ketentuan.</p><h2>1. Informasi Umum</h2><p>Website ini dimiliki dan dioperasikan oleh TWOSTRYVE. Semua konten dilindungi oleh hak cipta.</p>',
        ]);

        // ==========================================
        // SETTINGS (from STORE object in data.js)
        // ==========================================
        $settings = [
            'store_name' => 'TWOSTRYVE',
            'tagline' => 'Streetwear Culture Redefined',
            'phone' => '628123456789',
            'email' => 'hello@twostryve.id',
            'address' => 'Jakarta, Indonesia',
            'whatsapp' => '628123456789',
            'instagram' => 'https://instagram.com/twostryve.id',
            'tiktok' => 'https://tiktok.com/@twostryve.id',
            'facebook' => 'https://facebook.com/twostryve.id',
            'bank_accounts' => [
                ['bank' => 'BCA', 'number' => '1234567890', 'name' => 'PT TWOSTRYVE INDONESIA'],
                ['bank' => 'Mandiri', 'number' => '0987654321', 'name' => 'PT TWOSTRYVE INDONESIA'],
            ],
            'shipping_cost' => 15000,
            'free_shipping_min' => 500000,
            'popup_enabled' => '1',
            'popup_title' => 'ONLINE STORE',
            'popup_subtitle' => 'Pilih platform e-commerce favorit kamu untuk berbelanja',
            'shopee_url' => 'https://shopee.co.id',
            'tokopedia_url' => 'https://tokopedia.com',
            'tiktok_url' => 'https://tiktok.com',
            'blibli_url' => 'https://blibli.com',
            'lazada_url' => 'https://lazada.co.id',
        ];
        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }
    }
}
