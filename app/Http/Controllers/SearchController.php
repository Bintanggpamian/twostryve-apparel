<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q', '');
        $results = collect();

        if ($q) {
            $results = Product::active()
                ->with(['images', 'variants', 'category'])
                ->where(function ($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%")
                        ->orWhereHas('category', fn($cq) => $cq->where('name', 'like', "%{$q}%"));
                })
                ->take(20)->get();
        }

        return view('search', compact('q', 'results'));
    }

    public function api(Request $request)
    {
        $q = $request->input('q', '');
        if (!$q) return response()->json([]);

        $results = Product::active()
            ->with(['images'])
            ->where('name', 'like', "%{$q}%")
            ->take(8)->get()
            ->map(fn($p) => [
                'name' => $p->name,
                'slug' => $p->slug,
                'image' => $p->first_image,
                'price' => $p->display_price,
            ]);

        return response()->json($results);
    }
}
