<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $settings = Setting::allFlat();
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);
        $freeShippingMin = $settings['free_shipping_min'] ?? 500000;
        $shippingCost = $settings['shipping_cost'] ?? 15000;
        $shipping = ($subtotal >= $freeShippingMin) ? 0 : (count($cart) > 0 ? $shippingCost : 0);
        $total = $subtotal + $shipping;

        return view('cart', compact('cart', 'subtotal', 'shipping', 'total', 'settings'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'color' => 'required|string',
            'size' => 'required|string',
            'qty' => 'integer|min:1|max:99',
        ]);

        $product = Product::with('images')->findOrFail($request->product_id);
        $cart = session('cart', []);
        $key = $product->id . '-' . $request->color . '-' . $request->size;
        $qty = $request->input('qty', 1);

        if (isset($cart[$key])) {
            $cart[$key]['qty'] += $qty;
        } else {
            $cart[$key] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'image' => $product->first_image,
                'color' => $request->color,
                'size' => $request->size,
                'price' => $product->display_price,
                'original_price' => $product->price,
                'qty' => $qty,
            ];
        }

        session(['cart' => $cart]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "{$product->name} ditambahkan ke keranjang!",
                'cart_count' => collect($cart)->sum('qty'),
                'cart' => array_values($cart),
            ]);
        }

        return back()->with('success', "{$product->name} ditambahkan ke keranjang!");
    }

    public function update(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'qty' => 'required|integer|min:0|max:99',
        ]);

        $cart = session('cart', []);

        if ($request->qty <= 0) {
            unset($cart[$request->key]);
        } else {
            if (isset($cart[$request->key])) {
                $cart[$request->key]['qty'] = $request->qty;
            }
        }

        session(['cart' => $cart]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'cart_count' => collect($cart)->sum('qty')]);
        }

        return back();
    }

    public function remove(Request $request)
    {
        $cart = session('cart', []);
        unset($cart[$request->key]);
        session(['cart' => $cart]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'cart_count' => collect($cart)->sum('qty')]);
        }

        return back();
    }

    public function clear()
    {
        session()->forget('cart');
        return back();
    }

    public function getJson()
    {
        $cart = session('cart', []);
        $settings = Setting::allFlat();
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);
        $freeShippingMin = $settings['free_shipping_min'] ?? 500000;
        $shippingCost = $settings['shipping_cost'] ?? 15000;
        $shipping = ($subtotal >= $freeShippingMin) ? 0 : (count($cart) > 0 ? $shippingCost : 0);

        return response()->json([
            'items' => array_values($cart),
            'count' => collect($cart)->sum('qty'),
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $subtotal + $shipping,
        ]);
    }
}
