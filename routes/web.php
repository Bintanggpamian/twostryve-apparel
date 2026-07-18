<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;

// Public routes (tanpa login)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// Cart (session-based)
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

// Orders
Route::get('/order-success', [OrderController::class, 'success'])->name('order.success');
Route::get('/track-order', [OrderController::class, 'track'])->name('order.track');
Route::post('/track-order', [OrderController::class, 'trackSearch'])->name('order.track.search');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/article/{slug}', [BlogController::class, 'show'])->name('article.show');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Static pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/size-guide', [PageController::class, 'sizeGuide'])->name('size-guide');
Route::get('/how-to-shop', [PageController::class, 'howToShop'])->name('how-to-shop');
Route::get('/return-policy', [PageController::class, 'returnPolicy'])->name('return-policy');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Admin Panel (Custom Full CMS)
Route::prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->name('admin');
    
    // Products CRUD
    Route::post('/products', [\App\Http\Controllers\AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::delete('/products/{id}', [\App\Http\Controllers\AdminController::class, 'deleteProduct'])->name('admin.products.delete');

    // Categories CRUD
    Route::post('/categories', [\App\Http\Controllers\AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::delete('/categories/{id}', [\App\Http\Controllers\AdminController::class, 'deleteCategory'])->name('admin.categories.delete');

    // Banners CRUD
    Route::post('/banners', [\App\Http\Controllers\AdminController::class, 'storeBanner'])->name('admin.banners.store');
    Route::delete('/banners/{id}', [\App\Http\Controllers\AdminController::class, 'deleteBanner'])->name('admin.banners.delete');

    // Articles / Blog CRUD
    Route::post('/articles', [\App\Http\Controllers\AdminController::class, 'storeArticle'])->name('admin.articles.store');
    Route::delete('/articles/{id}', [\App\Http\Controllers\AdminController::class, 'deleteArticle'])->name('admin.articles.delete');

    // Pages Content Update
    Route::post('/pages', [\App\Http\Controllers\AdminController::class, 'updatePage'])->name('admin.pages.update');

    // Orders Status Update
    Route::post('/orders/{id}/status', [\App\Http\Controllers\AdminController::class, 'updateOrderStatus'])->name('admin.orders.status');

    // Settings Update
    Route::post('/settings', [\App\Http\Controllers\AdminController::class, 'updateSettings'])->name('admin.settings.update');
});
// API endpoints (AJAX)
Route::get('/api/cart', [CartController::class, 'getJson'])->name('api.cart');
Route::get('/api/search', [SearchController::class, 'api'])->name('api.search');
Route::get('/api/product/{id}/variant-stock', [ProductController::class, 'variantStock'])->name('api.variant.stock');
