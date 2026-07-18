<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function success(Request $request)
    {
        $invoice = $request->query('invoice');
        $order = Order::where('invoice', $invoice)->with('items')->first();
        $settings = Setting::allFlat();

        return view('order-success', compact('order', 'invoice', 'settings'));
    }

    public function track()
    {
        return view('track-order');
    }

    public function trackSearch(Request $request)
    {
        $query = $request->input('query');
        $order = Order::where('invoice', $query)
            ->orWhere('phone', $query)
            ->with('items')
            ->first();

        return view('track-order', compact('order', 'query'));
    }
}
