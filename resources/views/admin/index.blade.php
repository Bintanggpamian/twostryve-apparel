<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TWOSTRYVE — Executive Control Panel</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <style>
    :root {
      --admin-sidebar-bg: #111213;
      --admin-sidebar-hover: #1c1d1f;
      --admin-accent: #111213;
      --admin-border: #e2e8f0;
      --admin-text-main: #0f172a;
      --admin-text-muted: #64748b;
    }
    body { background: #f8fafc; font-family: 'Plus Jakarta Sans', sans-serif; color: var(--admin-text-main); }
    .admin-layout { display: flex; min-height: 100vh; }
    
    /* Sleek Sidebar */
    .admin-sidebar {
      width: 270px;
      background: var(--admin-sidebar-bg);
      color: #fff;
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0; bottom: 0; left: 0;
      z-index: 100;
      border-right: 1px solid rgba(255,255,255,0.08);
    }
    .admin-brand {
      padding: 24px 28px;
      border-bottom: 1px solid rgba(255,255,255,0.08);
    }
    .admin-brand-title {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 20px;
      font-weight: 800;
      letter-spacing: 2px;
      color: #fff;
    }
    .admin-brand-title span { color: #888; }
    .admin-brand-sub {
      font-size: 10px;
      letter-spacing: 1px;
      color: #64748b;
      margin-top: 4px;
      text-transform: uppercase;
      font-weight: 600;
    }
    .admin-nav { padding: 20px 0; flex: 1; overflow-y: auto; }
    .admin-nav-group-title {
      padding: 12px 28px 6px;
      font-size: 10px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      color: #475569;
    }
    .admin-nav-item {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 12px 28px;
      color: #94a3b8;
      font-size: 13px;
      font-weight: 500;
      text-decoration: none;
      transition: all 0.2s ease;
      cursor: pointer;
      border: none;
      background: transparent;
      width: 100%;
      text-align: left;
    }
    .admin-nav-item:hover { color: #fff; background: var(--admin-sidebar-hover); }
    .admin-nav-item.active {
      color: #fff;
      background: var(--admin-sidebar-hover);
      border-left: 3px solid #fff;
      font-weight: 600;
    }
    .admin-nav-icon { width: 18px; height: 18px; opacity: 0.8; stroke-width: 2; flex-shrink: 0; }
    .admin-nav-item.active .admin-nav-icon { opacity: 1; }
    
    /* Main Area */
    .admin-main { margin-left: 270px; flex: 1; padding: 36px 44px; }
    .admin-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 32px;
      background: #fff;
      padding: 20px 28px;
      border: 1px solid var(--admin-border);
      border-radius: 8px;
    }
    .admin-title {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 20px;
      font-weight: 700;
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }
    .admin-stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 32px; }
    .stat-card { background: #fff; border: 1px solid var(--admin-border); padding: 22px; border-radius: 8px; }
    .stat-label { font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: var(--admin-text-muted); margin-bottom: 8px; }
    .stat-value { font-family: 'Space Grotesk', sans-serif; font-size: 26px; font-weight: 800; color: #0f172a; }
    .admin-card { background: #fff; border: 1px solid var(--admin-border); padding: 28px; margin-bottom: 28px; border-radius: 8px; }
    .admin-table { width: 100%; border-collapse: collapse; font-size: 13px; background: #fff; border: 1px solid var(--admin-border); border-radius: 8px; overflow: hidden; }
    .admin-table th {
      background: #0f172a;
      color: #fff;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      padding: 14px 18px;
      text-align: left;
    }
    .admin-table td { padding: 14px 18px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
    .status-badge { padding: 4px 10px; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; border-radius: 4px; display: inline-block; }
    .tab-pane { display: none; }
    .tab-pane.active { display: block; }
    .form-group { margin-bottom: 20px; }
    .form-label { display: block; font-size: 12px; font-weight: 700; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; color: #334155; }
    .form-input, .form-textarea, .form-select {
      width: 100%; padding: 11px 16px; border: 1px solid #cbd5e1; font-family: inherit; font-size: 13px; outline: none; border-radius: 6px; transition: border-color 0.15s;
    }
    .form-input:focus, .form-textarea:focus, .form-select:focus { border-color: #0f172a; }
    .alert-success { background: #f0fdf4; color: #166534; padding: 14px 22px; margin-bottom: 28px; font-size: 13px; border: 1px solid #bbf7d0; border-radius: 6px; font-weight: 600; }
    .btn-edit { background: #f1f5f9; color: #0f172a; padding: 5px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; border: 1px solid #cbd5e1; cursor: pointer; margin-right: 6px; }
    .btn-edit:hover { background: #e2e8f0; }
    .btn-delete { background: #fef2f2; color: #dc2626; padding: 5px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; border: 1px solid #fecaca; cursor: pointer; }
    .btn-delete:hover { background: #fee2e2; }
  </style>
</head>
<body>
  @php use App\Helpers\FormatHelper; @endphp

  <div class="admin-layout">
    <!-- Sleek Minimal Sidebar -->
    <aside class="admin-sidebar">
      <div class="admin-brand">
        <div class="admin-brand-title">TWO<span>STRYVE</span></div>
        <div class="admin-brand-sub">Management Console</div>
      </div>
      <nav class="admin-nav">
        <div class="admin-nav-group-title">Overview</div>
        <button class="admin-nav-item active" onclick="switchTab('dashboard', this)">
          <svg class="admin-nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
          Dashboard
        </button>

        <div class="admin-nav-group-title">Branding & Layout</div>
        <button class="admin-nav-item" onclick="switchTab('branding', this)">
          <svg class="admin-nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
          Logo & Header
        </button>
        <button class="admin-nav-item" onclick="switchTab('banners', this)">
          <svg class="admin-nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
          Hero Sliders
        </button>
        <button class="admin-nav-item" onclick="switchTab('promobanner', this)">
          <svg class="admin-nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
          Promo Banner
        </button>

        <div class="admin-nav-group-title">Katalog & Produk</div>
        <button class="admin-nav-item" onclick="switchTab('products', this)">
          <svg class="admin-nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
          Produk Toko
        </button>
        <button class="admin-nav-item" onclick="switchTab('categories', this)">
          <svg class="admin-nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
          Kategori
        </button>

        <div class="admin-nav-group-title">Konten & Transaksi</div>
        <button class="admin-nav-item" onclick="switchTab('articles', this)">
          <svg class="admin-nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
          Artikel Blog
        </button>
        <button class="admin-nav-item" onclick="switchTab('pages', this)">
          <svg class="admin-nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
          Halaman Statis
        </button>
        <button class="admin-nav-item" onclick="switchTab('orders', this)">
          <svg class="admin-nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
          Pesanan (Orders)
        </button>

        <div class="admin-nav-group-title">Pengaturan & E-Commerce</div>
        <button class="admin-nav-item" onclick="switchTab('platforms', this)">
          <svg class="admin-nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
          E-Commerce Pop-up
        </button>
        <button class="admin-nav-item" onclick="switchTab('settings', this)">
          <svg class="admin-nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/></svg>
          Kontak & Sosmed
        </button>
      </nav>
      <div style="padding:24px;border-top:1px solid rgba(255,255,255,0.08)">
        <a href="{{ route('home') }}" target="_blank" class="btn btn-outline" style="width:100%;color:#fff;border-color:rgba(255,255,255,0.2);text-align:center;font-size:12px;padding:10px">
          Pratinjau Website ↗
        </a>
      </div>
    </aside>

    <!-- Main Content Area -->
    <main class="admin-main">
      @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
      @endif
      @if(session('error'))
        <div style="background:#fef2f2;color:#dc2626;padding:14px 22px;margin-bottom:28px;font-size:13px;border:1px solid #fecaca;border-radius:6px;font-weight:600">{{ session('error') }}</div>
      @endif

      <div class="admin-header">
        <h1 class="admin-title" id="pageTitle">Dashboard Overview</h1>
        <div><span class="status-badge" style="background:#f1f5f9;color:#0f172a;border:1px solid #cbd5e1">Database Synchronized</span></div>
      </div>

      {{-- DASHBOARD TAB --}}
      <div id="tab-dashboard" class="tab-pane active">
        <div class="admin-stats-grid">
          <div class="stat-card">
            <div class="stat-label">Total Pendapatan</div>
            <div class="stat-value">{{ FormatHelper::price($stats['total_revenue']) }}</div>
          </div>
          <div class="stat-card">
            <div class="stat-label">Total Pesanan</div>
            <div class="stat-value">{{ $stats['total_orders'] }}</div>
          </div>
          <div class="stat-card">
            <div class="stat-label">Total Produk</div>
            <div class="stat-value">{{ $stats['total_products'] }}</div>
          </div>
          <div class="stat-card">
            <div class="stat-label">Total Kategori</div>
            <div class="stat-value">{{ $stats['total_categories'] }}</div>
          </div>
        </div>

        <div class="admin-card">
          <h3 style="font-family:'Space Grotesk',sans-serif;font-size:16px;letter-spacing:1px;margin-bottom:16px;text-transform:uppercase">Pesanan Terbaru</h3>
          <table class="admin-table">
            <thead>
              <tr>
                <th>Invoice</th><th>Tanggal</th><th>Pelanggan</th><th>Total</th><th>Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($orders->take(5) as $order)
              <tr>
                <td style="font-weight:700">{{ $order->invoice }}</td>
                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $order->customer_name }} ({{ $order->customer_phone }})</td>
                <td style="font-weight:700">{{ FormatHelper::price($order->total) }}</td>
                <td><span class="status-badge" style="background:#0f172a;color:#fff">{{ strtoupper($order->status) }}</span></td>
              </tr>
              @empty
              <tr><td colspan="5" style="text-align:center">Belum ada pesanan.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      {{-- BRANDING & LOGO TAB --}}
      <div id="tab-branding" class="tab-pane">
        <div class="admin-card">
          <h3 style="font-family:'Space Grotesk',sans-serif;font-size:16px;letter-spacing:1px;margin-bottom:16px;text-transform:uppercase">Pengaturan Logo & Header Announcement</h3>
          <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_active_tab" value="branding">
            <div class="form-group">
              <label class="form-label">Upload Gambar Logo Baru</label>
              <input type="file" class="form-input" name="site_logo_file" accept="image/*">
              @if(!empty($settings['site_logo']))
                <div style="margin-top:10px;font-size:12px;color:#64748b">Logo Aktif: <br><img src="{{ asset($settings['site_logo']) }}" style="max-height:40px;margin-top:6px;background:#1e293b;padding:6px;border-radius:4px"></div>
              @endif
            </div>
            <div class="form-group">
              <label class="form-label">Logo Teks HTML (Alternatif)</label>
              <input type="text" class="form-input" name="site_logo_html" value="{{ $settings['site_logo_html'] ?? 'TWO<span>STRYVE</span>' }}">
              <small style="color:#64748b">Bisa gunakan tag span untuk highlight warna.</small>
            </div>
            <div class="form-group">
              <label class="form-label">Teks Bar Pengumuman Atas (Announcement Bar)</label>
              <input type="text" class="form-input" name="announcement_text" value="{{ $settings['announcement_text'] ?? '🔥 FREE ONGKIR untuk pembelian di atas Rp 500.000 — Shop Now' }}">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Pengaturan Logo</button>
          </form>
        </div>
      </div>

      {{-- PRODUCTS TAB --}}
      <div id="tab-products" class="tab-pane">
        <div class="admin-card">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
            <h3 style="font-family:'Space Grotesk',sans-serif;font-size:16px;letter-spacing:1px;text-transform:uppercase" id="productFormTitle">Form Tambah / Edit Produk</h3>
            <button type="button" id="btnCancelProductEdit" onclick="cancelProductEdit()" style="display:none" class="btn btn-sm btn-outline">Batal Edit</button>
          </div>
          <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
            @csrf
            <input type="hidden" name="_active_tab" value="products">
            <input type="hidden" name="id" id="productId">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
              <div class="form-group">
                <label class="form-label">Nama Produk</label>
                <input type="text" class="form-input" name="name" id="productName" required placeholder="misal: Streetwear Graphic Tee">
              </div>
              <div class="form-group">
                <label class="form-label">Kategori</label>
                <select class="form-select" name="category_id" id="productCategory" required>
                  @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
              <div class="form-group">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" class="form-input" name="price" id="productPrice" required placeholder="189000">
              </div>
              <div class="form-group">
                <label class="form-label">Harga Diskon (Rp, Opsional)</label>
                <input type="number" class="form-input" name="sale_price" id="productSalePrice" placeholder="149000">
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Upload Foto Produk (Biarkan kosong jika tidak diubah)</label>
              <input type="file" class="form-input" name="image" accept="image/*">
            </div>
            <div class="form-group">
              <label class="form-label">Deskripsi Produk</label>
              <textarea class="form-textarea" name="description" id="productDesc" required rows="3" placeholder="Deskripsi lengkap produk..."></textarea>
            </div>
            <div style="display:flex;gap:20px;margin-bottom:20px">
              <label><input type="checkbox" name="is_featured" id="productFeatured" value="1"> Best Seller / Featured</label>
              <label><input type="checkbox" name="is_new" id="productNew" value="1"> New Arrival</label>
            </div>
            <button type="submit" class="btn btn-primary" id="btnSubmitProduct">Simpan Produk</button>
          </form>
        </div>

        <div class="admin-card">
          <h3 style="font-family:'Space Grotesk',sans-serif;font-size:16px;letter-spacing:1px;margin-bottom:16px;text-transform:uppercase">Daftar Produk Toko ({{ $products->count() }})</h3>
          <table class="admin-table">
            <thead>
              <tr>
                <th>Gambar</th><th>Nama Produk</th><th>Kategori</th><th>Harga</th><th>Sale</th><th>Aksi Update / Hapus</th>
              </tr>
            </thead>
            <tbody>
              @foreach($products as $p)
              <tr>
                <td><img src="{{ asset($p->first_image) }}" style="width:40px;height:40px;object-fit:cover;border-radius:4px"></td>
                <td style="font-weight:600">{{ $p->name }}</td>
                <td>{{ $p->category?->name }}</td>
                <td>{{ FormatHelper::price($p->price) }}</td>
                <td>{{ $p->sale_price ? FormatHelper::price($p->sale_price) : '-' }}</td>
                <td>
                  <button type="button" class="btn-edit" onclick='editProduct(@json($p))'>Edit / Update</button>
                  <form action="{{ route('admin.products.delete', $p->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')" style="display:inline">
                    @csrf @method('DELETE')
                    <input type="hidden" name="_active_tab" value="products">
                    <button type="submit" class="btn-delete">Hapus</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      {{-- CATEGORIES TAB --}}
      <div id="tab-categories" class="tab-pane">
        <div class="admin-card">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
            <h3 style="font-family:'Space Grotesk',sans-serif;font-size:16px;letter-spacing:1px;text-transform:uppercase" id="categoryFormTitle">Tambah / Edit Kategori</h3>
            <button type="button" id="btnCancelCategoryEdit" onclick="cancelCategoryEdit()" style="display:none" class="btn btn-sm btn-outline">Batal Edit</button>
          </div>
          <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_active_tab" value="categories">
            <input type="hidden" name="id" id="categoryId">
            <div class="form-group">
              <label class="form-label">Nama Kategori</label>
              <input type="text" class="form-input" name="name" id="categoryName" required placeholder="misal: Outerwear">
            </div>
            <div class="form-group">
              <label class="form-label">Upload Gambar Kategori (Biarkan kosong jika tidak diubah)</label>
              <input type="file" class="form-input" name="image" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary" id="btnSubmitCategory">Simpan Kategori</button>
          </form>
        </div>

        <div class="admin-card">
          <h3 style="font-family:'Space Grotesk',sans-serif;font-size:16px;letter-spacing:1px;margin-bottom:16px;text-transform:uppercase">Daftar Kategori</h3>
          <table class="admin-table">
            <thead><tr><th>Gambar</th><th>Nama</th><th>Slug</th><th>Jumlah Produk</th><th>Aksi Update / Hapus</th></tr></thead>
            <tbody>
              @foreach($categories as $c)
              <tr>
                <td><img src="{{ asset($c->image) }}" style="width:40px;height:40px;object-fit:cover;border-radius:4px"></td>
                <td style="font-weight:600">{{ $c->name }}</td>
                <td>{{ $c->slug }}</td>
                <td>{{ $c->products()->count() }}</td>
                <td>
                  <button type="button" class="btn-edit" onclick='editCategory(@json($c))'>Edit / Update</button>
                  <form action="{{ route('admin.categories.delete', $c->id) }}" method="POST" onsubmit="return confirm('Hapus kategori?')" style="display:inline">
                    @csrf @method('DELETE')
                    <input type="hidden" name="_active_tab" value="categories">
                    <button type="submit" class="btn-delete">Hapus</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      {{-- HERO BANNERS TAB --}}
      <div id="tab-banners" class="tab-pane">
        <div class="admin-card">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
            <h3 style="font-family:'Space Grotesk',sans-serif;font-size:16px;letter-spacing:1px;text-transform:uppercase" id="bannerFormTitle">Tambah / Edit Hero Banner</h3>
            <button type="button" id="btnCancelBannerEdit" onclick="cancelBannerEdit()" style="display:none" class="btn btn-sm btn-outline">Batal Edit</button>
          </div>
          <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_active_tab" value="banners">
            <input type="hidden" name="id" id="bannerId">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
              <div class="form-group"><label class="form-label">Judul Banner</label><input type="text" class="form-input" name="title" id="bannerTitle" required placeholder="SUMMER COLLECTION 2026"></div>
              <div class="form-group"><label class="form-label">Tag Sub-judul</label><input type="text" class="form-input" name="tag" id="bannerTag" required placeholder="LIMITED DROP"></div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
              <div class="form-group"><label class="form-label">Teks Tombol CTA</label><input type="text" class="form-input" name="cta" id="bannerCta" value="Shop Now" required></div>
              <div class="form-group"><label class="form-label">Link Tujuan</label><input type="text" class="form-input" name="link" id="bannerLink" value="/shop" required></div>
            </div>
            <div class="form-group"><label class="form-label">Upload Gambar Hero Banner (Kosongkan jika tidak diubah)</label><input type="file" class="form-input" name="image" accept="image/*"></div>
            <div class="form-group"><label class="form-label">Deskripsi Singkat</label><textarea class="form-textarea" name="description" id="bannerDesc" required rows="2"></textarea></div>
            <button type="submit" class="btn btn-primary" id="btnSubmitBanner">Simpan Hero Banner</button>
          </form>
        </div>

        <div class="admin-card">
          <h3 style="font-family:'Space Grotesk',sans-serif;font-size:16px;letter-spacing:1px;margin-bottom:16px;text-transform:uppercase">Daftar Hero Banner</h3>
          <table class="admin-table">
            <thead><tr><th>Gambar</th><th>Judul</th><th>Tag</th><th>CTA Link</th><th>Aksi Update / Hapus</th></tr></thead>
            <tbody>
              @foreach($banners as $b)
              <tr>
                <td><img src="{{ asset($b->image) }}" style="width:60px;height:35px;object-fit:cover;border-radius:4px"></td>
                <td style="font-weight:600">{{ $b->title }}</td>
                <td>{{ $b->tag }}</td>
                <td>{{ $b->link }}</td>
                <td>
                  <button type="button" class="btn-edit" onclick='editBanner(@json($b))'>Edit / Update</button>
                  <form action="{{ route('admin.banners.delete', $b->id) }}" method="POST" onsubmit="return confirm('Hapus banner?')" style="display:inline">
                    @csrf @method('DELETE')
                    <input type="hidden" name="_active_tab" value="banners">
                    <button type="submit" class="btn-delete">Hapus</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      {{-- PROMO BANNER TAB --}}
      <div id="tab-promobanner" class="tab-pane">
        <div class="admin-card">
          <h3 style="font-family:'Space Grotesk',sans-serif;font-size:16px;letter-spacing:1px;margin-bottom:16px;text-transform:uppercase">Pengaturan Section Promo Banner (Tengah Homepage)</h3>
          <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_active_tab" value="promobanner">
            <div class="form-group">
              <label class="form-label">Upload Gambar Banner Mid Promo</label>
              <input type="file" class="form-input" name="promo_banner_file" accept="image/*">
              @if(!empty($settings['promo_banner_image']))
                <div style="margin-top:10px;font-size:12px;color:#64748b">Gambar Promo Aktif: <br><img src="{{ asset($settings['promo_banner_image']) }}" style="max-height:80px;margin-top:6px;border-radius:4px"></div>
              @endif
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
              <div class="form-group"><label class="form-label">Judul Promo Banner</label><input type="text" class="form-input" name="promo_banner_title" value="{{ $settings['promo_banner_title'] ?? 'Free Ongkir' }}"></div>
              <div class="form-group"><label class="form-label">Teks Tombol CTA</label><input type="text" class="form-input" name="promo_banner_cta" value="{{ $settings['promo_banner_cta'] ?? 'Belanja Sekarang' }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Sub-Judul / Keterangan Promo</label><input type="text" class="form-input" name="promo_banner_desc" value="{{ $settings['promo_banner_desc'] ?? 'Untuk pembelian di atas Rp 500.000' }}"></div>
            <div class="form-group"><label class="form-label">Link Tujuan Tombol</label><input type="text" class="form-input" name="promo_banner_link" value="{{ $settings['promo_banner_link'] ?? '/shop' }}"></div>
            <button type="submit" class="btn btn-primary">Simpan Promo Banner Mid</button>
          </form>
        </div>
      </div>

      {{-- ARTICLES TAB --}}
      <div id="tab-articles" class="tab-pane">
        <div class="admin-card">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
            <h3 style="font-family:'Space Grotesk',sans-serif;font-size:16px;letter-spacing:1px;text-transform:uppercase" id="articleFormTitle">Tambah / Edit Artikel Blog</h3>
            <button type="button" id="btnCancelArticleEdit" onclick="cancelArticleEdit()" style="display:none" class="btn btn-sm btn-outline">Batal Edit</button>
          </div>
          <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_active_tab" value="articles">
            <input type="hidden" name="id" id="articleId">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
              <div class="form-group"><label class="form-label">Judul Artikel</label><input type="text" class="form-input" name="title" id="articleTitle" required placeholder="misal: Tren Streetwear 2026"></div>
              <div class="form-group"><label class="form-label">Tag / Kategori Artikel</label><input type="text" class="form-input" name="tag" id="articleTag" required placeholder="Style Guide"></div>
            </div>
            <div class="form-group"><label class="form-label">Waktu Baca (Estimasi)</label><input type="text" class="form-input" name="read_time" id="articleReadTime" value="5 min read" required></div>
            <div class="form-group"><label class="form-label">Upload Cover Gambar Artikel (Kosongkan jika tidak diubah)</label><input type="file" class="form-input" name="cover_image" accept="image/*"></div>
            <div class="form-group"><label class="form-label">Ringkasan (Excerpt)</label><textarea class="form-textarea" name="excerpt" id="articleExcerpt" required rows="2" placeholder="Ringkasan singkat artikel..."></textarea></div>
            <div class="form-group"><label class="form-label">Isi Lengkap Artikel (HTML didukung)</label><textarea class="form-textarea" name="content" id="articleContent" required rows="6" placeholder="<p>Isi artikel lengkap...</p>"></textarea></div>
            <button type="submit" class="btn btn-primary" id="btnSubmitArticle">Terbitkan Artikel</button>
          </form>
        </div>

        <div class="admin-card">
          <h3 style="font-family:'Space Grotesk',sans-serif;font-size:16px;letter-spacing:1px;margin-bottom:16px;text-transform:uppercase">Daftar Artikel Blog ({{ $articles->count() }})</h3>
          <table class="admin-table">
            <thead><tr><th>Cover</th><th>Judul</th><th>Tag</th><th>Tanggal Published</th><th>Aksi Update / Hapus</th></tr></thead>
            <tbody>
              @foreach($articles as $a)
              <tr>
                <td><img src="{{ asset($a->cover_image) }}" style="width:50px;height:35px;object-fit:cover;border-radius:4px"></td>
                <td style="font-weight:600">{{ $a->title }}</td>
                <td>{{ $a->tag }}</td>
                <td>{{ $a->published_at?->format('d/m/Y') }}</td>
                <td>
                  <button type="button" class="btn-edit" onclick='editArticle(@json($a))'>Edit / Update</button>
                  <form action="{{ route('admin.articles.delete', $a->id) }}" method="POST" onsubmit="return confirm('Hapus artikel?')" style="display:inline">
                    @csrf @method('DELETE')
                    <input type="hidden" name="_active_tab" value="articles">
                    <button type="submit" class="btn-delete">Hapus</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      {{-- PAGES TAB --}}
      <div id="tab-pages" class="tab-pane">
        <div class="admin-card">
          <h3 style="font-family:'Space Grotesk',sans-serif;font-size:16px;letter-spacing:1px;margin-bottom:16px;text-transform:uppercase">Edit Konten Halaman Statis</h3>
          <form action="{{ route('admin.pages.update') }}" method="POST">
            @csrf
            <div class="form-group">
              <label class="form-label">Pilih Halaman yang Ingin Di-edit</label>
              <select name="slug" class="form-select" onchange="loadPageContent(this.value)">
                <option value="about">Tentang Kami (About)</option>
                <option value="faq">FAQ (Pertanyaan Umum)</option>
                <option value="size-guide">Size Guide</option>
                <option value="how-to-shop">Cara Belanja</option>
                <option value="return-policy">Kebijakan Retur</option>
                <option value="terms">Syarat & Ketentuan</option>
              </select>
            </div>
            <div class="form-group"><label class="form-label">Judul Utama Halaman</label><input type="text" class="form-input" id="pageTitleInput" name="title" required value="Tentang Kami"></div>
            <div class="form-group"><label class="form-label">Sub-judul Halaman</label><input type="text" class="form-input" id="pageSubtitleInput" name="subtitle" value="Mengenal lebih dekat TWOSTRYVE"></div>
            <div class="form-group"><label class="form-label">Isi Konten Halaman (HTML didukung)</label><textarea class="form-textarea" id="pageContentInput" name="content" required rows="8"><p>TWOSTRYVE adalah brand streetwear lokal...</p></textarea></div>
            <button type="submit" class="btn btn-primary">Simpan Konten Halaman</button>
          </form>
        </div>
      </div>

      {{-- ORDERS TAB --}}
      <div id="tab-orders" class="tab-pane">
        <div class="admin-card">
          <h3 style="font-family:'Space Grotesk',sans-serif;font-size:16px;letter-spacing:1px;margin-bottom:16px;text-transform:uppercase">Kelola Pesanan Masuk ({{ $orders->count() }})</h3>
          <table class="admin-table">
            <thead>
              <tr><th>Invoice</th><th>Pelanggan</th><th>Metode</th><th>Total</th><th>Status Saat Ini</th><th>Ubah Status</th></tr>
            </thead>
            <tbody>
              @foreach($orders as $o)
              <tr>
                <td style="font-weight:700">{{ $o->invoice }}</td>
                <td>{{ $o->customer_name }}<br><small style="color:#64748b">{{ $o->customer_phone }}</small></td>
                <td>{{ strtoupper($o->payment_method) }}</td>
                <td style="font-weight:700">{{ FormatHelper::price($o->total) }}</td>
                <td><span class="status-badge" style="background:#0f172a;color:#fff">{{ strtoupper($o->status) }}</span></td>
                <td>
                  <form action="{{ route('admin.orders.status', $o->id) }}" method="POST" style="display:flex;gap:6px">
                    @csrf
                    <select name="status" class="form-select" style="padding:6px 10px;font-size:12px">
                      <option value="pending_payment" {{ $o->status === 'pending_payment' ? 'selected' : '' }}>Pending Payment</option>
                      <option value="paid" {{ $o->status === 'paid' ? 'selected' : '' }}>Paid</option>
                      <option value="processing" {{ $o->status === 'processing' ? 'selected' : '' }}>Processing</option>
                      <option value="shipped" {{ $o->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                      <option value="completed" {{ $o->status === 'completed' ? 'selected' : '' }}>Completed</option>
                      <option value="cancelled" {{ $o->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-outline">Update</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      {{-- PLATFORMS POPUP TAB --}}
      <div id="tab-platforms" class="tab-pane">
        <div class="admin-card">
          <h3 style="font-family:'Space Grotesk',sans-serif;font-size:16px;letter-spacing:1px;margin-bottom:16px;text-transform:uppercase">Pengaturan Pop-up Online Store & Platform Marketplace</h3>
          <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            <div class="form-group">
              <label class="form-label">Status Pop-up Modal Saat Pertama Buka Website</label>
              <select name="popup_enabled" class="form-select">
                <option value="1" {{ ($settings['popup_enabled'] ?? '1') === '1' ? 'selected' : '' }}>Aktif (Tampilkan Pop-up)</option>
                <option value="0" {{ ($settings['popup_enabled'] ?? '1') === '0' ? 'selected' : '' }}>Nonaktifkan Pop-up</option>
              </select>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
              <div class="form-group">
                <label class="form-label">Judul Pop-up Modal</label>
                <input type="text" class="form-input" name="popup_title" value="{{ $settings['popup_title'] ?? 'ONLINE STORE' }}">
              </div>
              <div class="form-group">
                <label class="form-label">Sub-judul Pop-up Modal</label>
                <input type="text" class="form-input" name="popup_subtitle" value="{{ $settings['popup_subtitle'] ?? 'Pilih platform e-commerce favorit kamu untuk berbelanja' }}">
              </div>
            </div>

            <h4 style="font-family:'Space Grotesk',sans-serif;font-size:14px;margin:24px 0 12px;text-transform:uppercase;color:#475569">Link Platform E-Commerce (Marketplace)</h4>
            
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
              <div class="form-group">
                <label class="form-label">Link Shopee Store</label>
                <input type="text" class="form-input" name="shopee_url" value="{{ $settings['shopee_url'] ?? '#' }}" placeholder="https://shopee.co.id/twostryve">
              </div>
              <div class="form-group">
                <label class="form-label">Link Tokopedia Store</label>
                <input type="text" class="form-input" name="tokopedia_url" value="{{ $settings['tokopedia_url'] ?? '#' }}" placeholder="https://tokopedia.com/twostryve">
              </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
              <div class="form-group">
                <label class="form-label">Link TikTok Shop</label>
                <input type="text" class="form-input" name="tiktok_url" value="{{ $settings['tiktok_url'] ?? '#' }}" placeholder="https://tiktok.com/@twostryve">
              </div>
              <div class="form-group">
                <label class="form-label">Link Blibli Store</label>
                <input type="text" class="form-input" name="blibli_url" value="{{ $settings['blibli_url'] ?? '#' }}" placeholder="https://blibli.com/twostryve">
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Link Lazada Flagship</label>
              <input type="text" class="form-input" name="lazada_url" value="{{ $settings['lazada_url'] ?? '#' }}" placeholder="https://lazada.co.id/shop/twostryve">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Link E-Commerce & Pop-up</button>
          </form>
        </div>
      </div>

      {{-- SETTINGS TAB --}}
      <div id="tab-settings" class="tab-pane">
        <div class="admin-card">
          <h3 style="font-family:'Space Grotesk',sans-serif;font-size:16px;letter-spacing:1px;margin-bottom:16px;text-transform:uppercase">Pengaturan Kontak & Media Sosial</h3>
          <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
              <div class="form-group">
                <label class="form-label">Nomor WhatsApp CS</label>
                <input type="text" class="form-input" name="whatsapp" value="{{ $settings['whatsapp'] ?? '628123456789' }}">
              </div>
              <div class="form-group">
                <label class="form-label">Email Kontak</label>
                <input type="email" class="form-input" name="email" value="{{ $settings['email'] ?? 'support@twostryve.id' }}">
              </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
              <div class="form-group">
                <label class="form-label">Instagram Link</label>
                <input type="text" class="form-input" name="instagram" value="{{ $settings['instagram'] ?? '#' }}">
              </div>
              <div class="form-group">
                <label class="form-label">TikTok Link</label>
                <input type="text" class="form-input" name="tiktok" value="{{ $settings['tiktok'] ?? '#' }}">
              </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
              <div class="form-group">
                <label class="form-label">Batas Minimal Free Ongkir (Rp)</label>
                <input type="number" class="form-input" name="free_shipping_min" value="{{ $settings['free_shipping_min'] ?? '500000' }}">
              </div>
              <div class="form-group">
                <label class="form-label">Tagline Brand</label>
                <input type="text" class="form-input" name="tagline" value="{{ $settings['tagline'] ?? 'Streetwear Culture Redefined' }}">
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Alamat Lengkap Toko / Warehouse</label>
              <textarea class="form-textarea" name="address" rows="2">{{ $settings['address'] ?? 'Jakarta South, Indonesia' }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Kontak & Sosmed</button>
          </form>
        </div>
      </div>

    </main>
  </div>

  <script>
    const pagesData = @json($pages->keyBy('slug'));
    let currentActiveTab = 'dashboard';

    function switchTab(tabId, btn) {
      if (!btn) {
        btn = document.querySelector(`.admin-nav-item[onclick*="'${tabId}'"]`);
      }
      const targetPane = document.getElementById('tab-' + tabId);
      if (targetPane && btn) {
        document.querySelectorAll('.tab-pane').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.admin-nav-item').forEach(el => el.classList.remove('active'));
        targetPane.classList.add('active');
        btn.classList.add('active');
        document.getElementById('pageTitle').textContent = btn.textContent.trim();
        currentActiveTab = tabId;
        localStorage.setItem('admin_active_tab', tabId);
        if (history.pushState) {
          history.pushState(null, null, '#tab-' + tabId);
        } else {
          location.hash = '#tab-' + tabId;
        }
        
        document.querySelectorAll('input[name="_active_tab"]').forEach(input => {
          input.value = tabId;
        });
      }
    }

    document.addEventListener('DOMContentLoaded', function() {
      const hashTab = window.location.hash ? window.location.hash.replace('#tab-', '').replace('#', '') : null;
      const sessionTab = "{{ session('active_tab') }}";
      const savedTab = sessionTab || hashTab || localStorage.getItem('admin_active_tab') || 'dashboard';
      
      switchTab(savedTab);
    });

    function editProduct(p) {
      document.getElementById('productId').value = p.id;
      document.getElementById('productName').value = p.name;
      document.getElementById('productCategory').value = p.category_id;
      document.getElementById('productPrice').value = p.price;
      document.getElementById('productSalePrice').value = p.sale_price || '';
      document.getElementById('productDesc').value = p.description;
      document.getElementById('productFeatured').checked = p.is_featured == 1;
      document.getElementById('productNew').checked = p.is_new == 1;

      document.getElementById('productFormTitle').textContent = 'Update Produk #' + p.id + ' (' + p.name + ')';
      document.getElementById('btnSubmitProduct').textContent = 'Simpan Perubahan Produk';
      document.getElementById('btnCancelProductEdit').style.display = 'inline-block';
      window.scrollTo({ top: document.getElementById('productForm').offsetTop - 100, behavior: 'smooth' });
    }

    function cancelProductEdit() {
      document.getElementById('productForm').reset();
      document.getElementById('productId').value = '';
      document.getElementById('productFormTitle').textContent = 'Form Tambah / Edit Produk';
      document.getElementById('btnSubmitProduct').textContent = 'Simpan Produk Baru';
      document.getElementById('btnCancelProductEdit').style.display = 'none';
    }

    function editCategory(c) {
      document.getElementById('categoryId').value = c.id;
      document.getElementById('categoryName').value = c.name;
      document.getElementById('categoryFormTitle').textContent = 'Edit Kategori #' + c.id + ' (' + c.name + ')';
      document.getElementById('btnSubmitCategory').textContent = 'Simpan Perubahan Kategori';
      document.getElementById('btnCancelCategoryEdit').style.display = 'inline-block';
    }

    function cancelCategoryEdit() {
      document.getElementById('categoryId').value = '';
      document.getElementById('categoryName').value = '';
      document.getElementById('categoryFormTitle').textContent = 'Tambah / Edit Kategori';
      document.getElementById('btnSubmitCategory').textContent = 'Simpan Kategori';
      document.getElementById('btnCancelCategoryEdit').style.display = 'none';
    }

    function editBanner(b) {
      document.getElementById('bannerId').value = b.id;
      document.getElementById('bannerTitle').value = b.title;
      document.getElementById('bannerTag').value = b.tag;
      document.getElementById('bannerCta').value = b.cta;
      document.getElementById('bannerLink').value = b.link;
      document.getElementById('bannerDesc').value = b.description;
      document.getElementById('bannerFormTitle').textContent = 'Edit Hero Banner #' + b.id;
      document.getElementById('btnSubmitBanner').textContent = 'Simpan Perubahan Banner';
      document.getElementById('btnCancelBannerEdit').style.display = 'inline-block';
    }

    function cancelBannerEdit() {
      document.getElementById('bannerId').value = '';
      document.getElementById('bannerTitle').value = '';
      document.getElementById('bannerTag').value = '';
      document.getElementById('bannerCta').value = 'Shop Now';
      document.getElementById('bannerLink').value = '/shop';
      document.getElementById('bannerDesc').value = '';
      document.getElementById('bannerFormTitle').textContent = 'Tambah / Edit Hero Banner';
      document.getElementById('btnSubmitBanner').textContent = 'Simpan Hero Banner';
      document.getElementById('btnCancelBannerEdit').style.display = 'none';
    }

    function editArticle(a) {
      document.getElementById('articleId').value = a.id;
      document.getElementById('articleTitle').value = a.title;
      document.getElementById('articleTag').value = a.tag;
      document.getElementById('articleReadTime').value = a.read_time;
      document.getElementById('articleExcerpt').value = a.excerpt;
      document.getElementById('articleContent').value = a.content;
      document.getElementById('articleFormTitle').textContent = 'Edit Artikel #' + a.id;
      document.getElementById('btnSubmitArticle').textContent = 'Simpan Perubahan Artikel';
      document.getElementById('btnCancelArticleEdit').style.display = 'inline-block';
    }

    function cancelArticleEdit() {
      document.getElementById('articleId').value = '';
      document.getElementById('articleTitle').value = '';
      document.getElementById('articleTag').value = '';
      document.getElementById('articleReadTime').value = '5 min read';
      document.getElementById('articleExcerpt').value = '';
      document.getElementById('articleContent').value = '';
      document.getElementById('articleFormTitle').textContent = 'Tambah / Edit Artikel Blog';
      document.getElementById('btnSubmitArticle').textContent = 'Terbitkan Artikel';
      document.getElementById('btnCancelArticleEdit').style.display = 'none';
    }

    function loadPageContent(slug) {
      const p = pagesData[slug];
      if (p) {
        document.getElementById('pageTitleInput').value = p.title;
        document.getElementById('pageSubtitleInput').value = p.subtitle || '';
        document.getElementById('pageContentInput').value = p.content;
      }
    }
  </script>
</body>
</html>
