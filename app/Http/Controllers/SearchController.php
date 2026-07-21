<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q', '');
        $results = [
            'products' => collect(),
            'articles' => collect(),
            'categories' => collect(),
        ];

        if ($q) {
            $results['products'] = Product::active()
                ->with(['images', 'variants', 'category'])
                ->where(function ($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%")
                        ->orWhereHas('category', fn($cq) => $cq->where('name', 'like', "%{$q}%"));
                })
                ->take(20)->get();

            $results['articles'] = Article::active()->published()
                ->where('title', 'like', "%{$q}%")
                ->orWhere('tag', 'like', "%{$q}%")
                ->take(10)->get();

            $results['categories'] = Category::where('name', 'like', "%{$q}%")
                ->take(10)->get();
        }

        return view('search', compact('q', 'results'));
    }

    public function api(Request $request)
    {
        $q = $request->input('q', '');
        if (!$q) return response()->json([]);

        $products = Product::active()
            ->with(['images'])
            ->where('name', 'like', "%{$q}%")
            ->orWhereHas('category', fn($cq) => $cq->where('name', 'like', "%{$q}%"))
            ->take(5)->get()
            ->map(fn($p) => [
                'type' => 'product',
                'name' => $p->name,
                'slug' => $p->slug,
                'image' => $p->first_image,
                'price' => $p->display_price,
            ]);

        $articles = Article::active()->published()
            ->where('title', 'like', "%{$q}%")
            ->take(3)->get()
            ->map(fn($a) => [
                'type' => 'article',
                'name' => $a->title,
                'slug' => $a->slug,
                'image' => $a->cover_image ? asset($a->cover_image) : null,
                'desc' => $a->excerpt,
            ]);

        $categories = Category::where('name', 'like', "%{$q}%")
            ->take(3)->get()
            ->map(fn($c) => [
                'type' => 'category',
                'name' => $c->name,
                'slug' => $c->slug,
                'image' => $c->image ? asset($c->image) : null,
                'desc' => $c->product_count . ' Produk',
            ]);

        $results = [
            'products' => $products,
            'articles' => $articles,
            'categories' => $categories,
        ];

        return response()->json($results);
    }
}
