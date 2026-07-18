<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Share common data to all views
        View::composer('*', function ($view) {
            static $shared = null;
            if ($shared === null) {
                try {
                    if (Schema::hasTable('categories') && Schema::hasTable('settings')) {
                        $shared = [
                            'navCategories' => Category::roots()->ordered()->get(),
                            'storeSettings' => Setting::allFlat(),
                        ];
                    } else {
                        $shared = [
                            'navCategories' => collect(),
                            'storeSettings' => [],
                        ];
                    }
                } catch (\Exception $e) {
                    $shared = [
                        'navCategories' => collect(),
                        'storeSettings' => [],
                    ];
                }
            }
            $view->with($shared);
        });
    }

    public function register(): void {}
}
