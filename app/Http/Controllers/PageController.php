<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Setting;

class PageController extends Controller
{
    public function about()
    {
        $page = Page::findBySlug('about');
        return view('pages.about', compact('page'));
    }

    public function faq()
    {
        return view('pages.faq');
    }

    public function sizeGuide()
    {
        $settings = Setting::allFlat();
        return view('pages.size-guide', compact('settings'));
    }

    public function howToShop()
    {
        $settings = Setting::allFlat();
        return view('pages.how-to-shop', compact('settings'));
    }

    public function returnPolicy()
    {
        $page = Page::findBySlug('return-policy');
        $settings = Setting::allFlat();
        return view('pages.return-policy', compact('page', 'settings'));
    }

    public function terms()
    {
        $page = Page::findBySlug('terms');
        return view('pages.terms', compact('page'));
    }

    public function contact()
    {
        $settings = Setting::allFlat();
        return view('pages.contact', compact('settings'));
    }
}
