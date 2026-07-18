<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index()
    {
        $query = Product::active()->with(['images', 'variants', 'category']);

        // Filter by category
        $catSlug = request('cat');
        if ($catSlug) {
            $query->inCategory($catSlug);
        }

        // Filter by sale
        if (request('sale') === 'true') {
            $query->onSale();
        }

        // Sort
        $sort = request('sort', 'newest');
        switch ($sort) {
            case 'price-low':
                $query->orderByRaw('COALESCE(sale_price, price) ASC');
                break;
            case 'price-high':
                $query->orderByRaw('COALESCE(sale_price, price) DESC');
                break;
            case 'popular':
                $query->orderBy('sold_count', 'desc');
                break;
            default: // newest
                $query->latest();
                break;
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::roots()->ordered()->withCount('products')->get();
        $currentCategory = $catSlug ? Category::where('slug', $catSlug)->first() : null;
        $totalProducts = Product::active()->count();
        $saleCount = Product::active()->onSale()->count();

        return view('shop.index', compact(
            'products', 'categories', 'currentCategory',
            'catSlug', 'sort', 'totalProducts', 'saleCount'
        ));
    }
}
