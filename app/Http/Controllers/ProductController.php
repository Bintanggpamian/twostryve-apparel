<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)->active()
            ->with(['images', 'variants', 'category'])
            ->firstOrFail();

        $related = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with(['images', 'variants', 'category'])
            ->take(4)->get();

        $variantsData = $product->variants->map(fn($v) => [
            'color' => $v->color_name,
            'hex' => $v->color_hex,
            'size' => $v->size,
            'stock' => $v->stock,
        ]);

        return view('shop.show', compact('product', 'related', 'variantsData'));
    }

    public function variantStock(int $id)
    {
        $product = Product::with('variants')->findOrFail($id);

        $variants = $product->variants->map(fn($v) => [
            'color' => $v->color_name,
            'size' => $v->size,
            'stock' => $v->stock,
            'sku' => $v->sku,
        ]);

        return response()->json(['variants' => $variants]);
    }
}
