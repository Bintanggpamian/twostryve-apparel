<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Article;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_revenue' => Order::where('status', '!=', 'cancelled')->sum('total'),
            'total_orders' => Order::count(),
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
        ];
        
        $orders = Order::orderBy('created_at', 'desc')->get();
        $products = Product::with('category', 'images', 'variants')->orderBy('created_at', 'desc')->get();
        $categories = Category::orderBy('sort_order', 'asc')->get();
        $banners = Banner::orderBy('sort_order', 'asc')->get();
        $articles = Article::orderBy('published_at', 'desc')->get();
        $pages = Page::all();
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('admin.index', compact(
            'stats', 'orders', 'products', 'categories', 'banners', 'articles', 'pages', 'settings'
        ));
    }

    private function uploadFile($file, $folder = 'assets/images'): string
    {
        $filename = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path($folder);
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        $file->move($destinationPath, $filename);
        return $folder . '/' . $filename;
    }

    private function redirectTab(Request $request, string $defaultTab, string $message)
    {
        $tab = $request->input('_active_tab', $defaultTab);
        return redirect()->to(url('/admin') . '#tab-' . $tab)
            ->with('active_tab', $tab)
            ->with('success', $message);
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'id' => 'nullable|integer|exists:products,id',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'description' => 'required|string',
            'is_featured' => 'nullable|boolean',
            'is_new' => 'nullable|boolean',
        ]);

        $slug = Str::slug($validated['name']);
        $product = Product::updateOrCreate(
            ['id' => $request->id],
            [
                'name' => $validated['name'],
                'slug' => $slug,
                'category_id' => $validated['category_id'],
                'price' => $validated['price'],
                'sale_price' => $validated['sale_price'] ?? null,
                'description' => $validated['description'],
                'is_featured' => $request->has('is_featured'),
                'is_new' => $request->has('is_new'),
                'is_active' => true,
            ]
        );

        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'));
            $product->images()->delete(); // Update image
            $product->images()->create(['path' => $imagePath, 'sort_order' => 1]);
        } elseif (!$product->images()->exists()) {
            $product->images()->create(['path' => 'assets/images/product-1.png', 'sort_order' => 1]);
        }

        if (!$product->variants()->exists()) {
            $product->variants()->create([
                'color_name' => 'Default',
                'color_hex' => '#1a1a1a',
                'size' => 'M',
                'stock' => 10,
                'sku' => strtoupper(Str::random(8)),
            ]);
        }

        $message = $request->id ? 'Produk berhasil diperbarui!' : 'Produk berhasil ditambahkan!';
        return $this->redirectTab($request, 'products', $message);
    }

    public function deleteProduct(Request $request, $id)
    {
        Product::findOrFail($id)->delete();
        return $this->redirectTab($request, 'products', 'Produk berhasil dihapus!');
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'id' => 'nullable|integer|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        $category = Category::find($request->id);
        $imagePath = $category ? $category->image : 'assets/images/cat-tshirt.png';

        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'));
        }

        Category::updateOrCreate(
            ['id' => $request->id],
            [
                'name' => $validated['name'],
                'slug' => Str::slug($validated['name']),
                'image' => $imagePath,
            ]
        );

        $message = $request->id ? 'Kategori berhasil diperbarui!' : 'Kategori berhasil ditambahkan!';
        return $this->redirectTab($request, 'categories', $message);
    }

    public function deleteCategory(Request $request, $id)
    {
        Category::findOrFail($id)->delete();
        return $this->redirectTab($request, 'categories', 'Kategori berhasil dihapus!');
    }

    public function storeBanner(Request $request)
    {
        $validated = $request->validate([
            'id' => 'nullable|integer|exists:banners,id',
            'title' => 'required|string|max:255',
            'tag' => 'required|string',
            'cta' => 'required|string',
            'link' => 'required|string',
            'description' => 'required|string',
        ]);

        $banner = Banner::find($request->id);
        $imagePath = $banner ? $banner->image : 'assets/images/hero-1.png';

        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'));
        }

        Banner::updateOrCreate(
            ['id' => $request->id],
            array_merge($validated, ['image' => $imagePath, 'is_active' => true])
        );

        $message = $request->id ? 'Hero Banner berhasil diperbarui!' : 'Hero Banner berhasil ditambahkan!';
        return $this->redirectTab($request, 'banners', $message);
    }

    public function deleteBanner(Request $request, $id)
    {
        Banner::findOrFail($id)->delete();
        return $this->redirectTab($request, 'banners', 'Hero Banner berhasil dihapus!');
    }

    public function storeArticle(Request $request)
    {
        $validated = $request->validate([
            'id' => 'nullable|integer|exists:articles,id',
            'title' => 'required|string|max:255',
            'tag' => 'required|string',
            'read_time' => 'required|string',
            'excerpt' => 'required|string',
            'content' => 'required|string',
        ]);

        $article = Article::find($request->id);
        $coverImage = $article ? $article->cover_image : 'assets/images/hero-1.png';

        if ($request->hasFile('cover_image')) {
            $coverImage = $this->uploadFile($request->file('cover_image'));
        }

        Article::updateOrCreate(
            ['id' => $request->id],
            [
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']),
                'tag' => $validated['tag'],
                'read_time' => $validated['read_time'],
                'excerpt' => $validated['excerpt'],
                'content' => $validated['content'],
                'cover_image' => $coverImage,
                'published_at' => $article ? $article->published_at : now(),
                'is_active' => true,
            ]
        );

        $message = $request->id ? 'Artikel berhasil diperbarui!' : 'Artikel berhasil diterbitkan!';
        return $this->redirectTab($request, 'articles', $message);
    }

    public function deleteArticle(Request $request, $id)
    {
        Article::findOrFail($id)->delete();
        return $this->redirectTab($request, 'articles', 'Artikel berhasil dihapus!');
    }

    public function updatePage(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|string',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'content' => 'required|string',
        ]);

        Page::updateOrCreate(
            ['slug' => $validated['slug']],
            $validated
        );

        return $this->redirectTab($request, 'pages', 'Halaman ' . strtoupper($validated['slug']) . ' berhasil diperbarui!');
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return $this->redirectTab($request, 'orders', 'Status pesanan ' . $order->invoice . ' diperbarui ke ' . strtoupper($request->status));
    }

    public function updateSettings(Request $request)
    {
        $settingsData = $request->except(['_token', '_active_tab', 'site_logo_file', 'promo_banner_file']);

        // Upload Logo
        if ($request->hasFile('site_logo_file')) {
            $settingsData['site_logo'] = $this->uploadFile($request->file('site_logo_file'));
        }

        // Upload Promo Banner Image
        if ($request->hasFile('promo_banner_file')) {
            $settingsData['promo_banner_image'] = $this->uploadFile($request->file('promo_banner_file'));
        }

        foreach ($settingsData as $key => $val) {
            Setting::set($key, $val);
        }

        $defaultTab = 'settings';
        if ($request->has('popup_enabled') || $request->has('shopee_url')) {
            $defaultTab = 'platforms';
        } elseif ($request->has('site_logo_html') || $request->hasFile('site_logo_file')) {
            $defaultTab = 'branding';
        } elseif ($request->has('promo_banner_title') || $request->hasFile('promo_banner_file')) {
            $defaultTab = 'promobanner';
        }

        return $this->redirectTab($request, $defaultTab, 'Pengaturan berhasil diperbarui!');
    }
}
