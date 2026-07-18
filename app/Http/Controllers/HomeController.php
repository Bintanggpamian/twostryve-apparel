<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Article;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::active()->ordered()->get();
        $categories = Category::roots()->ordered()->get();
        $newProducts = Product::active()->with(['images', 'variants', 'category'])
            ->latest()->take(8)->get();
        $saleProducts = Product::active()->onSale()->with(['images', 'variants', 'category'])
            ->take(4)->get();
        $featuredProducts = Product::active()->featured()->with(['images', 'variants', 'category'])
            ->take(4)->get();
        $articles = Article::active()->published()->latest('published_at')->take(3)->get();
        $settings = Setting::allFlat();

        return view('home', compact(
            'banners', 'categories', 'newProducts', 'saleProducts',
            'featuredProducts', 'articles', 'settings'
        ));
    }
}
