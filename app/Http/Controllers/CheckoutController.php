<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Setting;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        if (empty($cart)) return redirect()->route('cart');

        $settings = Setting::allFlat();
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);
        $freeShippingMin = $settings['free_shipping_min'] ?? 500000;
        $shippingCost = $settings['shipping_cost'] ?? 15000;
        $shipping = ($subtotal >= $freeShippingMin) ? 0 : $shippingCost;
        $total = $subtotal + $shipping;

        return view('checkout', compact('cart', 'subtotal', 'shipping', 'total', 'settings'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'payment_method' => 'required|in:transfer,qris,cod',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) return redirect()->route('cart');

        $settings = Setting::allFlat();
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);
        $freeShippingMin = $settings['free_shipping_min'] ?? 500000;
        $shippingCost = $settings['shipping_cost'] ?? 15000;
        $shipping = ($subtotal >= $freeShippingMin) ? 0 : $shippingCost;
        $total = $subtotal + $shipping;

        $order = Order::create([
            'invoice' => Order::generateInvoice(),
            'customer_name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total,
            'payment_method' => $request->payment_method,
            'status' => 'new',
            'notes' => $request->notes,
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'product_name' => $item['name'],
                'color' => $item['color'],
                'size' => $item['size'],
                'qty' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['qty'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('order.success', ['invoice' => $order->invoice]);
    }
}
