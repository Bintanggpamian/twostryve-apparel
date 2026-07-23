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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />
  <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet" />
  <style>
    :root {
      --bg-dark: #0c121e;
      --sidebar-bg: #111827;
      --card-bg-start: #172133;
      --card-bg-end: #111826;
      --accent-orange: #ee4d2d;
      --accent-orange-hover: #ff5738;
      --text-main: #f8fafc;
      --text-muted: #94a3b8;
      --border-dark: rgba(255, 255, 255, 0.07);
    }

    * { box-sizing: border-box; }
    body {
      background: var(--bg-dark);
      background-image: 
        radial-gradient(at 0% 0%, rgba(238, 77, 45, 0.08) 0px, transparent 50%),
        radial-gradient(at 100% 100%, rgba(30, 41, 59, 0.4) 0px, transparent 50%);
      font-family: 'Plus Jakarta Sans', sans-serif;
      color: var(--text-main);
      min-height: 100vh;
      margin: 0;
    }
    .admin-layout { display: flex; min-height: 100vh; }
    
    /* Executive Skeuomorphic Sidebar */
    .admin-sidebar {
      width: 270px;
      background: linear-gradient(180deg, #111827 0%, #0d131f 100%);
      color: #fff;
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0; bottom: 0; left: 0;
      z-index: 100;
      border-right: 1px solid rgba(255, 255, 255, 0.06);
      box-shadow: 10px 0 30px rgba(0, 0, 0, 0.4);
    }
    .admin-brand {
      padding: 24px 24px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.06);
      background: rgba(0, 0, 0, 0.2);
    }
    .admin-brand-title {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 20px;
      font-weight: 800;
      letter-spacing: 2px;
      color: #fff;
    }
    .admin-brand-title span { color: var(--accent-orange); }
    .admin-brand-sub {
      font-size: 10px;
      letter-spacing: 1px;
      color: var(--text-muted);
      margin-top: 4px;
      text-transform: uppercase;
      font-weight: 600;
    }

    .admin-nav { padding: 16px 12px; flex: 1; overflow-y: auto; }
    .admin-nav-group-title {
      padding: 14px 16px 6px;
      font-size: 10px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      color: #64748b;
    }
    .admin-nav-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 16px;
      color: #94a3b8;
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.2s ease;
      cursor: pointer;
      border: 1px solid transparent;
      border-radius: 12px;
      background: transparent;
      width: 100%;
      text-align: left;
      margin-bottom: 4px;
    }
    .admin-nav-item:hover {
      color: #fff;
      background: rgba(255, 255, 255, 0.03);
      border-color: rgba(255, 255, 255, 0.05);
      transform: translateX(3px);
    }
    .admin-nav-item.active {
      color: #fff;
      background: linear-gradient(145deg, #1e293b, #111827);
      border: 1px solid rgba(238, 77, 45, 0.35);
      box-shadow: 
        inset 2px 2px 4px #090e17, 
        inset -2px -2px 4px #1b263b,
        0 4px 14px rgba(0, 0, 0, 0.35);
    }
    .admin-nav-icon { width: 18px; height: 18px; opacity: 0.75; stroke-width: 2; flex-shrink: 0; }
    .admin-nav-item.active .admin-nav-icon { opacity: 1; color: var(--accent-orange); }
    
    /* Main Content Area */
    .admin-main { margin-left: 270px; flex: 1; padding: 36px 40px; }
    .admin-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 32px;
      background: linear-gradient(145deg, var(--card-bg-start), var(--card-bg-end));
      padding: 22px 28px;
      border: 1px solid var(--border-dark);
      border-radius: 20px;
      box-shadow: 
        16px 16px 40px #060910, 
        -12px -12px 32px #1a273e,
        inset 1px 1px 1px rgba(255, 255, 255, 0.1);
    }
    .admin-title {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 20px;
      font-weight: 700;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      color: #fff;
    }

    /* Skeuomorphic Stat Cards */
    .admin-stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 32px; }
    .stat-card {
      background: linear-gradient(145deg, #182337, #0f1624);
      border: 1px solid var(--border-dark);
      padding: 22px;
      border-radius: 16px;
      box-shadow: 
        inset 3px 3px 6px #080d16, 
        inset -3px -3px 6px #1d2c46,
        0 8px 20px rgba(0, 0, 0, 0.3);
    }
    .stat-label {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      color: var(--text-muted);
      margin-bottom: 8px;
    }
    .stat-value {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 26px;
      font-weight: 800;
      color: #fff;
      text-shadow: 0 2px 10px rgba(0,0,0,0.5);
    }

    /* Skeuomorphic Cards & Containers */
    .admin-card {
      background: linear-gradient(145deg, var(--card-bg-start), var(--card-bg-end));
      border: 1px solid var(--border-dark);
      padding: 28px;
      margin-bottom: 28px;
      border-radius: 20px;
      box-shadow: 
        16px 16px 40px #060910, 
        -12px -12px 32px #1a273e,
        inset 1px 1px 1px rgba(255, 255, 255, 0.1);
    }

    /* Tables */
    .admin-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      font-size: 13px;
      background: rgba(15, 22, 36, 0.6);
      border: 1px solid var(--border-dark);
      border-radius: 14px;
      overflow: hidden;
      box-shadow: inset 2px 2px 5px #070b13, inset -2px -2px 5px #1a273e;
    }
    .admin-table th {
      background: #0d1422;
      color: #94a3b8;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      padding: 16px 18px;
      text-align: left;
      border-bottom: 1px solid var(--border-dark);
    }
    .admin-table td {
      padding: 16px 18px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.04);
      vertical-align: middle;
      color: #e2e8f0;
    }
    .admin-table tr:hover td { background: rgba(255, 255, 255, 0.02); }
    .admin-table tr:last-child td { border-bottom: none; }

    .status-badge {
      padding: 4px 10px;
      font-size: 10px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      border-radius: 6px;
      display: inline-block;
    }
    .tab-pane { display: none; }
    .tab-pane.active { display: block; }
    
    /* Inset Form Controls */
    .form-group { margin-bottom: 22px; }
    .form-label {
      display: block;
      font-size: 11px;
      font-weight: 700;
      margin-bottom: 8px;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: #cbd5e1;
    }
    .form-input, .form-textarea, .form-select {
      width: 100%;
      background: #0f1624;
      border: 1px solid rgba(255, 255, 255, 0.06);
      border-radius: 12px;
      padding: 12px 16px;
      font-family: inherit;
      font-size: 13.5px;
      color: #fff;
      outline: none;
      box-shadow: 
        inset 4px 4px 8px #070b13, 
        inset -3px -3px 6px #1a273e;
      transition: all 0.25s ease;
    }
    .form-input:focus, .form-textarea:focus, .form-select:focus {
      border-color: var(--accent-orange);
      box-shadow: 
        inset 4px 4px 8px #070b13, 
        inset -3px -3px 6px #1a273e,
        0 0 12px rgba(238, 77, 45, 0.35);
    }
    .form-select option { background: #111826; color: #fff; }

    .alert-success {
      background: rgba(52, 211, 153, 0.12);
      color: #6ee7b7;
      padding: 14px 22px;
      margin-bottom: 28px;
      font-size: 13px;
      border: 1px solid rgba(52, 211, 153, 0.3);
      border-radius: 12px;
      font-weight: 600;
    }

    /* Skeuomorphic 3D Buttons */
    .btn {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 13px;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      padding: 12px 22px;
      border-radius: 10px;
      cursor: pointer;
      border: none;
      transition: all 0.15s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      text-decoration: none;
    }
    .btn-primary {
      background: linear-gradient(145deg, var(--accent-orange-hover), var(--accent-orange));
      color: #fff;
      box-shadow: 
        5px 5px 14px #060a12, 
        -4px -4px 10px #1e2c45,
        inset 0 1px 0 rgba(255, 255, 255, 0.3);
    }
    .btn-primary:hover {
      background: linear-gradient(145deg, #ff6b4d, #f14422);
      box-shadow: 7px 7px 18px #060a12, -5px -5px 12px #1e2c45;
    }
    .btn-primary:active {
      transform: translateY(2px);
      box-shadow: inset 3px 3px 8px rgba(0,0,0,0.6);
    }

    .btn-outline {
      background: linear-gradient(145deg, #1e293b, #111827);
      color: #cbd5e1;
      border: 1px solid rgba(255, 255, 255, 0.12);
      box-shadow: 4px 4px 10px #060a12, -3px -3px 8px #1c2a42;
    }
    .btn-outline:hover { color: #fff; border-color: rgba(255, 255, 255, 0.3); }

    .btn-edit {
      background: linear-gradient(145deg, #1e293b, #111827);
      color: #60a5fa;
      padding: 6px 14px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 700;
      border: 1px solid rgba(96, 165, 250, 0.3);
      cursor: pointer;
      margin-right: 6px;
      box-shadow: 2px 2px 6px #060a12;
      transition: all 0.15s;
    }
    .btn-edit:hover { background: rgba(96, 165, 250, 0.15); color: #93c5fd; }

    .btn-delete {
      background: linear-gradient(145deg, #2a1215, #1c0d0f);
      color: #fca5a5;
      padding: 6px 14px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 700;
      border: 1px solid rgba(239, 68, 68, 0.3);
      cursor: pointer;
      box-shadow: 2px 2px 6px #060a12;
      transition: all 0.15s;
    }
    .btn-delete:hover { background: rgba(239, 68, 68, 0.2); color: #f87171; }

    /* Quill Editor Dark Theme Overrides */
    .ql-toolbar.ql-snow {
      background: #0f1624 !important;
      border-color: rgba(255, 255, 255, 0.1) !important;
      border-top-left-radius: 12px;
      border-top-right-radius: 12px;
    }
    .ql-container.ql-snow {
      background: #0b101b !important;
      border-color: rgba(255, 255, 255, 0.1) !important;
      color: #fff !important;
      border-bottom-left-radius: 12px;
      border-bottom-right-radius: 12px;
    }
    .ql-stroke { stroke: #cbd5e1 !important; }
    /* Animated Checkmark SVG Styling */
    .checkmark-circle {
      stroke-dasharray: 166; stroke-dashoffset: 166; stroke-width: 3;
      stroke-miterlimit: 10; stroke: #34d399; fill: none;
      animation: strokeCheckCircle 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
    }
    .checkmark-check {
      transform-origin: 50% 50%; stroke-dasharray: 48; stroke-dashoffset: 48;
      stroke: #34d399; animation: strokeCheckMark 0.4s cubic-bezier(0.65, 0, 0.45, 1) 0.3s forwards;
    }
    @keyframes strokeCheckCircle { 100% { stroke-dashoffset: 0; } }
    @keyframes strokeCheckMark { 100% { stroke-dashoffset: 0; } }

    .modal-backdrop-blur {
      position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
      background: rgba(12, 18, 30, 0.85); backdrop-filter: blur(10px);
      z-index: 999999; display: flex; align-items: center; justify-content: center;
      animation: fadeInModal 0.25s ease forwards;
    }
    @keyframes fadeInModal { from { opacity: 0; } to { opacity: 1; } }
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
        <button class="admin-nav-item" onclick="switchTab('homelayout', this)">
          <svg class="admin-nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V6z M8 10h8 M8 14h4" /></svg>
          Layout Beranda
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
      <div style="padding:20px 24px; border-top:1px solid rgba(255,255,255,0.08); background:rgba(0,0,0,0.2);">
        <div style="display:flex; align-items:center; gap:12px; margin-bottom:14px;">
          <div style="width:38px; height:38px; border-radius:50%; background:linear-gradient(145deg, #ee4d2d, #ff6b4d); color:#fff; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:14px; box-shadow:0 4px 10px rgba(238,77,45,0.4); flex-shrink:0;">
            {{ strtoupper(substr(Auth::user()?->name ?? 'A', 0, 1)) }}
          </div>
          <div style="min-width:0; flex:1;">
            <div style="font-size:13px; font-weight:700; color:#fff; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ Auth::user()?->name ?? 'Admin' }}</div>
            <div style="font-size:11px; color:#64748b; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ Auth::user()?->email ?? 'admin@twostryve.id' }}</div>
          </div>
        </div>
        <div style="display:flex; gap:8px;">
          <a href="{{ route('home') }}" target="_blank" class="btn btn-outline" style="flex:1; color:#fff; border-color:rgba(255,255,255,0.2); text-align:center; font-size:11px; padding:8px 4px; display:inline-block; text-decoration:none;">
            Pratinjau ↗
          </a>
          <form action="{{ route('admin.logout') }}" method="POST" style="flex:1;">
            @csrf
            <button type="submit" class="btn" style="width:100%; background:linear-gradient(145deg, #ef4444, #dc2626); color:#fff; border:none; text-align:center; font-size:11px; padding:8px 4px; font-weight:700; border-radius:6px; cursor:pointer; box-shadow:0 4px 10px rgba(220,38,38,0.3);">
              🚪 Logout
            </button>
          </form>
        </div>
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
        <div><span class="status-badge" style="background:rgba(52,211,153,0.12);color:#34d399;border:1px solid rgba(52,211,153,0.3);box-shadow:0 0 12px rgba(52,211,153,0.2);">🟢 SYSTEM ONLINE & SECURED</span></div>
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

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 24px; align-items: start;">
          <div class="admin-card" style="margin-bottom:0">
            <h3 style="font-family:'Space Grotesk',sans-serif;font-size:16px;letter-spacing:1px;margin-bottom:16px;text-transform:uppercase">Pesanan Terbaru</h3>
            <div style="overflow-x:auto">
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
                    <td>{{ $order->customer_name }}</td>
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

          <div class="admin-card" style="margin-bottom:0">
            <h3 style="font-family:'Space Grotesk',sans-serif;font-size:16px;letter-spacing:1px;margin-bottom:16px;text-transform:uppercase">Log Aktifitas</h3>
            <div style="display:flex;flex-direction:column;gap:12px;">
              @forelse($activityLogs ?? [] as $log)
                <div style="display:flex;gap:12px;padding-bottom:12px;border-bottom:1px solid rgba(255,255,255,0.06);">
                  <div style="width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;background:{{ $log->type === 'order' ? 'rgba(52,211,153,0.15)' : 'rgba(96,165,250,0.15)' }};color:{{ $log->type === 'order' ? '#34d399' : '#60a5fa' }};border:1px solid {{ $log->type === 'order' ? 'rgba(52,211,153,0.3)' : 'rgba(96,165,250,0.3)' }}">
                    @if($log->type === 'order')
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    @else
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/></svg>
                    @endif
                  </div>
                  <div>
                    <div style="font-size:13px;font-weight:600;color:#f8fafc;line-height:1.4">{{ $log->description }}</div>
                    <div style="font-size:11px;color:#94a3b8;margin-top:2px">{{ $log->created_at->diffForHumans() }}</div>
                  </div>
                </div>
              @empty
                <div style="text-align:center;font-size:13px;color:#94a3b8;padding:20px 0;">Belum ada log aktifitas.</div>
              @endforelse
            </div>
          </div>
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
              <div style="font-size:11px; color:#ff8c73; font-weight:700; margin-bottom:6px; display:flex; align-items:center; gap:6px; background:rgba(238, 77, 45, 0.12); padding:6px 12px; border-radius:6px; border:1px dashed rgba(238, 77, 45, 0.4)">
                <span>📐 Ukuran Rekomendasi Section Logo: 300 × 120 px (Rasio 5:2 PNG Transparan)</span>
              </div>
              <input type="file" class="form-input auto-crop-input" name="site_logo_file" accept="image/*" data-crop-ratio="2.5" data-crop-guide="Logo Toko: 300 × 120 px (Rasio 5:2 PNG)">
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
              <div style="font-size:11px; color:#ff8c73; font-weight:700; margin-bottom:6px; display:flex; align-items:center; gap:6px; background:rgba(238, 77, 45, 0.12); padding:6px 12px; border-radius:6px; border:1px dashed rgba(238, 77, 45, 0.4)">
                <span>📐 Ukuran Rekomendasi Section Produk: 800 × 800 px atau 1000 × 1000 px (Rasio Presisi 1:1 Persegi)</span>
              </div>
              <input type="file" class="form-input auto-crop-input" name="image" accept="image/*" data-crop-ratio="1" data-crop-guide="Gambar Produk: 800 × 800 px (Rasio 1:1 Persegi)">
            </div>
            <div class="form-group">
              <label class="form-label">Deskripsi Produk</label>
              <textarea class="form-textarea" name="description" id="productDesc" required rows="3" placeholder="Deskripsi lengkap produk..."></textarea>
            </div>

            <div class="form-group" style="border: 1px solid #e2e8f0; padding: 16px; border-radius: 8px;">
              <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                <label class="form-label" style="margin-bottom:0">Atur Varian (Warna & Ukuran)</label>
                <button type="button" class="btn btn-sm btn-outline" onclick="addVariantRow()">+ Tambah Varian</button>
              </div>
              <div id="variantContainer" style="display:flex; flex-direction:column; gap:10px;">
                <!-- Variant rows injected by JS -->
              </div>
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
              <div style="font-size:11px; color:#ff8c73; font-weight:700; margin-bottom:6px; display:flex; align-items:center; gap:6px; background:rgba(238, 77, 45, 0.12); padding:6px 12px; border-radius:6px; border:1px dashed rgba(238, 77, 45, 0.4)">
                <span>📐 Ukuran Rekomendasi Section Kategori: 600 × 600 px (Rasio Presisi 1:1 Persegi)</span>
              </div>
              <input type="file" class="form-input auto-crop-input" name="image" accept="image/*" data-crop-ratio="1" data-crop-guide="Gambar Kategori: 600 × 600 px (Rasio 1:1 Persegi)">
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
              <div class="form-group"><label class="form-label">Judul Banner (Opsional)</label><input type="text" class="form-input" name="title" id="bannerTitle" placeholder="misal: SUMMER COLLECTION 2026 (Boleh Kosong)"></div>
              <div class="form-group"><label class="form-label">Tag Sub-judul (Opsional)</label><input type="text" class="form-input" name="tag" id="bannerTag" placeholder="misal: LIMITED DROP (Boleh Kosong)"></div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
              <div class="form-group"><label class="form-label">Teks Tombol CTA (Opsional)</label><input type="text" class="form-input" name="cta" id="bannerCta" placeholder="misal: Shop Now (Boleh Kosong)"></div>
              <div class="form-group"><label class="form-label">Link Tujuan (Opsional)</label><input type="text" class="form-input" name="link" id="bannerLink" placeholder="misal: /shop (Boleh Kosong)"></div>
            </div>
            <div class="form-group">
              <label class="form-label">Upload Gambar Hero Banner (Wajib saat tambah baru)</label>
              <div style="font-size:11px; color:#ff8c73; font-weight:700; margin-bottom:6px; display:flex; align-items:center; gap:6px; background:rgba(238, 77, 45, 0.12); padding:6px 12px; border-radius:6px; border:1px dashed rgba(238, 77, 45, 0.4)">
                <span>📐 Ukuran Rekomendasi Section Hero Banner: 1920 × 800 px (Rasio 21:9 / 16:9 Landscape)</span>
              </div>
              <input type="file" class="form-input auto-crop-input" name="image" accept="image/*" data-crop-ratio="2.4" data-crop-guide="Hero Banner: 1920 × 800 px (Rasio 21:9)">
            </div>
            <div class="form-group"><label class="form-label">Deskripsi Singkat (Opsional)</label><textarea class="form-textarea" name="description" id="bannerDesc" rows="2" placeholder="Deskripsi banner singkat (Boleh Kosong)"></textarea></div>
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
              <div style="font-size:11px; color:#ff8c73; font-weight:700; margin-bottom:6px; display:flex; align-items:center; gap:6px; background:rgba(238, 77, 45, 0.12); padding:6px 12px; border-radius:6px; border:1px dashed rgba(238, 77, 45, 0.4)">
                <span>📐 Ukuran Rekomendasi Section Promo Banner: 1200 × 500 px (Rasio 12:5 Wide)</span>
              </div>
              <input type="file" class="form-input auto-crop-input" name="promo_banner_file" accept="image/*" data-crop-ratio="2.4" data-crop-guide="Promo Banner Mid: 1200 × 500 px (Rasio 12:5 Wide)">
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
            <div class="form-group">
              <label class="form-label">Upload Cover Gambar Artikel (Kosongkan jika tidak diubah)</label>
              <div style="font-size:11px; color:#ff8c73; font-weight:700; margin-bottom:6px; display:flex; align-items:center; gap:6px; background:rgba(238, 77, 45, 0.12); padding:6px 12px; border-radius:6px; border:1px dashed rgba(238, 77, 45, 0.4)">
                <span>📐 Ukuran Rekomendasi Section Artikel: 1200 × 630 px (Rasio 16:9 Landscape)</span>
              </div>
              <input type="file" class="form-input auto-crop-input" name="cover_image" accept="image/*" data-crop-ratio="1.904" data-crop-guide="Cover Artikel: 1200 × 630 px (Rasio 16:9 Landscape)">
            </div>
            <div class="form-group"><label class="form-label">Ringkasan (Excerpt)</label><textarea class="form-textarea" name="excerpt" id="articleExcerpt" required rows="2" placeholder="Ringkasan singkat artikel..."></textarea></div>
            <div class="form-group">
              <label class="form-label">Isi Lengkap Artikel (Visual Editor — Bebas Edit Font, Ukuran, Nomor, Bold, & Warna)</label>
              <div style="background:#fff; border-radius:6px; border:1px solid #cbd5e1; overflow:hidden;">
                <div id="articleQuillEditor" style="min-height:240px; font-size:14px;"></div>
              </div>
              <textarea name="content" id="articleContent" style="display:none;"></textarea>
            </div>
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
            <div class="form-group">
              <label class="form-label">Isi Konten Halaman (Visual Editor — Bebas Edit Font, Ukuran, Nomor, Bold, & Warna)</label>
              <div style="background:#fff; border-radius:6px; border:1px solid #cbd5e1; overflow:hidden;">
                <div id="pageQuillEditor" style="min-height:280px; font-size:14px;"></div>
              </div>
              <textarea name="content" id="pageContentInput" style="display:none;"></textarea>
            </div>
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

      {{-- LAYOUT BERANDA TAB --}}
      <div id="tab-homelayout" class="tab-pane">
        <div class="admin-card">
          <h3 style="font-family:'Space Grotesk',sans-serif;font-size:16px;letter-spacing:1px;margin-bottom:16px;text-transform:uppercase">Pengaturan Section Halaman Utama</h3>
          <p style="margin-bottom: 24px; color: var(--admin-text-muted);">Pilih section mana saja yang ingin ditampilkan (ON) atau disembunyikan (OFF) di halaman utama website pengunjung.</p>
          <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            <input type="hidden" name="_active_tab" value="homelayout">
            
            <div style="display:flex; flex-direction:column; gap:20px; max-width:600px;">
              
              <div style="display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid #e2e8f0; padding-bottom:16px;">
                <div>
                  <strong style="display:block;margin-bottom:4px">Kategori Produk</strong>
                  <span style="font-size:13px;color:#64748b">Menampilkan kotak kategori (T-Shirt, Hoodie, dll)</span>
                </div>
                <select name="show_section_categories" class="form-input" style="width:120px; margin-bottom:0">
                  <option value="1" {{ ($settings['show_section_categories'] ?? '1') == '1' ? 'selected' : '' }}>ON (Tampil)</option>
                  <option value="0" {{ ($settings['show_section_categories'] ?? '1') == '0' ? 'selected' : '' }}>OFF (Sembunyi)</option>
                </select>
              </div>

              <div style="display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid #e2e8f0; padding-bottom:16px;">
                <div>
                  <strong style="display:block;margin-bottom:4px">New Arrivals</strong>
                  <span style="font-size:13px;color:#64748b">Menampilkan produk terbaru yang diunggah ke toko</span>
                </div>
                <select name="show_section_new_arrivals" class="form-input" style="width:120px; margin-bottom:0">
                  <option value="1" {{ ($settings['show_section_new_arrivals'] ?? '1') == '1' ? 'selected' : '' }}>ON (Tampil)</option>
                  <option value="0" {{ ($settings['show_section_new_arrivals'] ?? '1') == '0' ? 'selected' : '' }}>OFF (Sembunyi)</option>
                </select>
              </div>

              <div style="display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid #e2e8f0; padding-bottom:16px;">
                <div>
                  <strong style="display:block;margin-bottom:4px">Sale Products</strong>
                  <span style="font-size:13px;color:#64748b">Menampilkan produk-produk yang sedang diskon (🔥 Sale)</span>
                </div>
                <select name="show_section_sale" class="form-input" style="width:120px; margin-bottom:0">
                  <option value="1" {{ ($settings['show_section_sale'] ?? '1') == '1' ? 'selected' : '' }}>ON (Tampil)</option>
                  <option value="0" {{ ($settings['show_section_sale'] ?? '1') == '0' ? 'selected' : '' }}>OFF (Sembunyi)</option>
                </select>
              </div>

              <div style="display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid #e2e8f0; padding-bottom:16px;">
                <div>
                  <strong style="display:block;margin-bottom:4px">Best Sellers</strong>
                  <span style="font-size:13px;color:#64748b">Menampilkan produk unggulan (Featured)</span>
                </div>
                <select name="show_section_best_sellers" class="form-input" style="width:120px; margin-bottom:0">
                  <option value="1" {{ ($settings['show_section_best_sellers'] ?? '1') == '1' ? 'selected' : '' }}>ON (Tampil)</option>
                  <option value="0" {{ ($settings['show_section_best_sellers'] ?? '1') == '0' ? 'selected' : '' }}>OFF (Sembunyi)</option>
                </select>
              </div>

              <div style="display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid #e2e8f0; padding-bottom:16px;">
                <div>
                  <strong style="display:block;margin-bottom:4px">Magazine (Artikel Blog)</strong>
                  <span style="font-size:13px;color:#64748b">Menampilkan daftar artikel blog terbaru di halaman depan</span>
                </div>
                <select name="show_section_magazine" class="form-input" style="width:120px; margin-bottom:0">
                  <option value="1" {{ ($settings['show_section_magazine'] ?? '1') == '1' ? 'selected' : '' }}>ON (Tampil)</option>
                  <option value="0" {{ ($settings['show_section_magazine'] ?? '1') == '0' ? 'selected' : '' }}>OFF (Sembunyi)</option>
                </select>
              </div>

              <div style="display:flex; justify-content:space-between; align-items:center;">
                <div>
                  <strong style="display:block;margin-bottom:4px">Newsletter (Form Berlangganan)</strong>
                  <span style="font-size:13px;color:#64748b">Menampilkan form untuk memasukkan email newsletter</span>
                </div>
                <select name="show_section_newsletter" class="form-input" style="width:120px; margin-bottom:0">
                  <option value="1" {{ ($settings['show_section_newsletter'] ?? '1') == '1' ? 'selected' : '' }}>ON (Tampil)</option>
                  <option value="0" {{ ($settings['show_section_newsletter'] ?? '1') == '0' ? 'selected' : '' }}>OFF (Sembunyi)</option>
                </select>
              </div>
              
            </div>

            <div style="margin-top: 32px;">
              <button type="submit" class="btn btn-primary">Simpan Layout Halaman Utama</button>
            </div>
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

      // Populate variants
      const container = document.getElementById('variantContainer');
      container.innerHTML = ''; // clear
      if (p.variants && p.variants.length > 0) {
        p.variants.forEach(v => {
          addVariantRow(v.id, v.color_name, v.color_hex, v.size, v.stock);
        });
      } else {
        addVariantRow();
      }

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
      document.getElementById('variantContainer').innerHTML = '';
      addVariantRow();
    }

    function addVariantRow(id = '', color_name = '', color_hex = '#000000', size = 'M', stock = 10) {
      const container = document.getElementById('variantContainer');
      const row = document.createElement('div');
      row.style.display = 'grid';
      row.style.gridTemplateColumns = '2fr 1fr 1fr 1fr auto';
      row.style.gap = '10px';
      row.style.alignItems = 'center';
      
      row.innerHTML = `
        <input type="hidden" name="variant_ids[]" value="${id}">
        <input type="text" class="form-input" name="variant_color_names[]" value="${color_name}" placeholder="Nama Warna (cth: Hitam)" required style="margin-bottom:0">
        <input type="color" class="form-input" name="variant_color_hexes[]" value="${color_hex}" style="padding:0; height:42px; margin-bottom:0; cursor:pointer;" required>
        <input type="text" class="form-input" name="variant_sizes[]" value="${size}" placeholder="Ukuran" required style="margin-bottom:0">
        <input type="number" class="form-input" name="variant_stocks[]" value="${stock}" placeholder="Stok" min="0" required style="margin-bottom:0">
        <button type="button" class="btn btn-delete" style="padding:10px;" onclick="this.parentElement.remove()">Hapus</button>
      `;
      container.appendChild(row);
    }
    
    // Initialize one row if empty
    document.addEventListener('DOMContentLoaded', function() {
      if(document.getElementById('variantContainer') && document.getElementById('variantContainer').innerHTML.trim() === '') {
        addVariantRow();
      }
    });


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
      if (typeof articleQuill !== 'undefined' && articleQuill) {
        articleQuill.root.innerHTML = a.content || '';
      }
      document.getElementById('articleContent').value = a.content || '';
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
      if (typeof articleQuill !== 'undefined' && articleQuill) {
        articleQuill.root.innerHTML = '';
      }
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
        if (typeof pageQuill !== 'undefined' && pageQuill) {
          pageQuill.root.innerHTML = p.content || '';
        }
        document.getElementById('pageContentInput').value = p.content || '';
      }
    }
  </script>

  <!-- CROPPER.JS CDN & IMAGE CROPPER MODAL -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

  <div id="imageCropModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(15,23,42,0.85); backdrop-filter:blur(8px); z-index:99999; align-items:center; justify-content:center;">
    <div style="background:#fff; width:92%; max-width:850px; border-radius:12px; overflow:hidden; box-shadow:0 25px 50px -12px rgba(0,0,0,0.5); display:flex; flex-direction:column; max-height:92vh;">
      <div style="padding:18px 24px; background:#0f172a; color:#fff; display:flex; justify-content:space-between; align-items:center;">
        <div>
          <h3 style="margin:0; font-family:'Space Grotesk',sans-serif; font-size:16px; letter-spacing:0.5px; text-transform:uppercase;">
            <span style="color:#ee4d2d">✂️</span> Sesuaikan & Crop Ukuran Foto Section
          </h3>
          <p style="margin:4px 0 0; font-size:12px; color:#94a3b8;" id="cropSectionSpecGuide">
            Spesifikasi Ideal Section: -
          </p>
        </div>
        <button type="button" onclick="closeImageCropModal()" style="background:transparent; border:none; color:#fff; font-size:24px; cursor:pointer; line-height:1;">&times;</button>
      </div>

      <div style="padding:20px; flex:1; overflow:hidden; display:flex; flex-direction:column; background:#f8fafc; align-items:center; justify-content:center;">
        <div style="width:100%; height:400px; background:#0f172a; border-radius:8px; overflow:hidden; display:flex; align-items:center; justify-content:center;">
          <img id="cropperTargetImg" src="" style="max-width:100%; max-height:100%; display:block;">
        </div>

        <div style="width:100%; margin-top:16px; display:flex; flex-wrap:wrap; gap:12px; align-items:center; justify-content:space-between; background:#fff; padding:12px 16px; border:1px solid #e2e8f0; border-radius:8px;">
          <div style="display:flex; align-items:center; gap:6px; flex-wrap:wrap;">
            <span style="font-size:11px; font-weight:700; color:#475569; text-transform:uppercase; margin-right:4px;">Pilih Preset Rasio:</span>
            <button type="button" style="padding:4px 10px; background:#f1f5f9; border:1px solid #cbd5e1; border-radius:4px; font-size:11px; font-weight:600; cursor:pointer;" onclick="setCropAspectRatio(1/1, '1:1 Persegi')">1:1</button>
            <button type="button" style="padding:4px 10px; background:#f1f5f9; border:1px solid #cbd5e1; border-radius:4px; font-size:11px; font-weight:600; cursor:pointer;" onclick="setCropAspectRatio(2.4, '21:9 Hero Banner')">21:9</button>
            <button type="button" style="padding:4px 10px; background:#f1f5f9; border:1px solid #cbd5e1; border-radius:4px; font-size:11px; font-weight:600; cursor:pointer;" onclick="setCropAspectRatio(2.4, '12:5 Promo Mid')">12:5</button>
            <button type="button" style="padding:4px 10px; background:#f1f5f9; border:1px solid #cbd5e1; border-radius:4px; font-size:11px; font-weight:600; cursor:pointer;" onclick="setCropAspectRatio(1.904, '16:9 Cover Artikel')">16:9</button>
            <button type="button" style="padding:4px 10px; background:#f1f5f9; border:1px solid #cbd5e1; border-radius:4px; font-size:11px; font-weight:600; cursor:pointer;" onclick="setCropAspectRatio(NaN, 'Free Crop (Bebas)')">Bebas</button>
          </div>
          <div style="display:flex; align-items:center; gap:6px;">
            <button type="button" onclick="cropperObj?.rotate(-90)" style="padding:6px 12px; background:#f1f5f9; border:1px solid #cbd5e1; border-radius:4px; font-size:12px; font-weight:600; cursor:pointer;">↺ Putar</button>
            <button type="button" onclick="cropperObj?.zoom(0.1)" style="padding:6px 12px; background:#f1f5f9; border:1px solid #cbd5e1; border-radius:4px; font-size:12px; font-weight:600; cursor:pointer;">🔍 +</button>
            <button type="button" onclick="cropperObj?.zoom(-0.1)" style="padding:6px 12px; background:#f1f5f9; border:1px solid #cbd5e1; border-radius:4px; font-size:12px; font-weight:600; cursor:pointer;">🔍 -</button>
          </div>
        </div>
      </div>

      <div style="padding:16px 24px; background:#fff; border-top:1px solid #e2e8f0; display:flex; justify-content:space-between; align-items:center;">
        <span style="font-size:12px; color:#64748b; font-weight:600;" id="cropDimensionsLive">Hasil Crop Siap Diunggah</span>
        <div style="display:flex; gap:10px;">
          <button type="button" onclick="closeImageCropModal()" style="padding:10px 18px; background:#f1f5f9; border:1px solid #cbd5e1; color:#0f172a; border-radius:6px; font-size:13px; font-weight:600; cursor:pointer;">Batal</button>
          <button type="button" onclick="applyImageCrop()" style="padding:10px 24px; background:#ee4d2d; color:#fff; border:none; border-radius:6px; font-size:13px; font-weight:700; cursor:pointer; box-shadow:0 4px 12px rgba(238,77,45,0.3);">✓ Terapkan & Sesuaikan Ukuran</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    let cropperObj = null;
    let activeFileInput = null;

    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.auto-crop-input').forEach(input => {
        input.addEventListener('change', function(e) {
          if (this.files && this.files[0]) {
            activeFileInput = this;
            openImageCropModal(this.files[0]);
          }
        });
      });
    });

    function openImageCropModal(file) {
      const modal = document.getElementById('imageCropModal');
      const targetImg = document.getElementById('cropperTargetImg');
      const guideText = document.getElementById('cropSectionSpecGuide');
      const initialRatio = activeFileInput ? parseFloat(activeFileInput.dataset.cropRatio || NaN) : NaN;

      if (activeFileInput && activeFileInput.dataset.cropGuide) {
        guideText.textContent = 'Spesifikasi Ideal Section: ' + activeFileInput.dataset.cropGuide;
      } else {
        guideText.textContent = 'Spesifikasi Ideal Section: Bebas / Sesuai Pilihan';
      }

      const reader = new FileReader();
      reader.onload = function(e) {
        targetImg.src = e.target.result;
        modal.style.display = 'flex';

        if (cropperObj) cropperObj.destroy();
        cropperObj = new Cropper(targetImg, {
          aspectRatio: isNaN(initialRatio) ? NaN : initialRatio,
          viewMode: 1,
          autoCropArea: 0.95,
          responsive: true,
          restore: false,
          checkCrossOrigin: false,
        });
      };
      reader.readAsDataURL(file);
    }

    function setCropAspectRatio(ratio, label) {
      if (cropperObj) {
        cropperObj.setAspectRatio(ratio);
        document.getElementById('cropDimensionsLive').textContent = 'Preset Diterapkan: ' + label;
      }
    }

    function closeImageCropModal() {
      const modal = document.getElementById('imageCropModal');
      modal.style.display = 'none';
      if (cropperObj) {
        cropperObj.destroy();
        cropperObj = null;
      }
    }

    function applyImageCrop() {
      if (!cropperObj || !activeFileInput) return;

      const canvas = cropperObj.getCroppedCanvas({
        imageSmoothingEnabled: true,
        imageSmoothingQuality: 'high',
      });

      if (!canvas) return;

      canvas.toBlob((blob) => {
        if (!blob) return;

        const originalName = activeFileInput.files[0] ? activeFileInput.files[0].name : 'cropped-image.png';
        const croppedFile = new File([blob], originalName, { type: blob.type || 'image/png' });

        const container = new DataTransfer();
        container.items.add(croppedFile);
        activeFileInput.files = container.files;

        let previewBadge = activeFileInput.parentElement.querySelector('.crop-preview-badge');
        if (!previewBadge) {
          previewBadge = document.createElement('div');
          previewBadge.className = 'crop-preview-badge';
          previewBadge.style.cssText = 'margin-top:8px; font-size:12px; color:#166534; font-weight:700; background:#f0fdf4; padding:6px 12px; border-radius:4px; border:1px solid #bbf7d0; display:inline-flex; align-items:center; gap:6px;';
          activeFileInput.parentElement.appendChild(previewBadge);
        }
        previewBadge.innerHTML = '✓ Ukuran Foto Berhasil Disesuaikan (' + Math.round(canvas.width) + ' × ' + Math.round(canvas.height) + ' px)';

        closeImageCropModal();
      }, 'image/png', 0.95);
    }
  </script>

  <!-- QUILL.JS WYSIWYG EDITOR -->
  <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
  <script>
    let articleQuill = null;
    let pageQuill = null;

    document.addEventListener('DOMContentLoaded', () => {
      const toolbarOptions = [
        [{ 'header': [1, 2, 3, false] }, { 'font': [] }],
        ['bold', 'italic', 'underline', 'strike'],
        [{ 'color': [] }, { 'background': [] }],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'align': [] }],
        [{ 'indent': '-1'}, { 'indent': '+1' }],
        ['blockquote', 'code-block', 'link'],
        ['clean']
      ];

      // Article Quill Editor
      const articleContainer = document.getElementById('articleQuillEditor');
      if (articleContainer) {
        articleQuill = new Quill('#articleQuillEditor', {
          theme: 'snow',
          placeholder: 'Tulis isi artikel lengkap di sini secara visual...',
          modules: { toolbar: toolbarOptions }
        });

        articleQuill.on('text-change', () => {
          document.getElementById('articleContent').value = articleQuill.root.innerHTML;
        });
      }

      // Page Quill Editor
      const pageContainer = document.getElementById('pageQuillEditor');
      if (pageContainer) {
        pageQuill = new Quill('#pageQuillEditor', {
          theme: 'snow',
          placeholder: 'Tulis konten halaman di sini secara visual...',
          modules: { toolbar: toolbarOptions }
        });

        pageQuill.on('text-change', () => {
          document.getElementById('pageContentInput').value = pageQuill.root.innerHTML;
        });

        // Load initial active page
        const selectElem = document.querySelector('select[name="slug"]');
        if (selectElem) {
          loadPageContent(selectElem.value || 'about');
        }
      }
    });

    // Sync on form submit
    document.querySelectorAll('form').forEach(form => {
      form.addEventListener('submit', () => {
        if (articleQuill && document.getElementById('articleContent')) {
          document.getElementById('articleContent').value = articleQuill.root.innerHTML;
        }
        if (pageQuill && document.getElementById('pageContentInput')) {
          document.getElementById('pageContentInput').value = pageQuill.root.innerHTML;
        }
      });
    });
  </script>

  <!-- CONFIRM SAVE MODAL -->
  <div id="confirmSaveModal" style="display:none;" class="modal-backdrop-blur">
    <div style="background: linear-gradient(145deg, #172133, #111826); width: 90%; max-width: 480px; border-radius: 24px; padding: 32px 28px; border: 1px solid rgba(255, 255, 255, 0.12); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.85), inset 1px 1px 1px rgba(255,255,255,0.15); text-align: center; position: relative;">
      
      <div style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(145deg, #182337, #0f1624); border: 1px solid rgba(238,77,45,0.4); box-shadow: inset 3px 3px 6px #080d16, inset -3px -3px 6px #1d2c46, 0 0 20px rgba(238,77,45,0.25); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ee4d2d" stroke-width="2" style="width:28px;height:28px;"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
      </div>

      <h3 style="font-family:'Space Grotesk',sans-serif; font-size:18px; font-weight:700; color:#fff; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">Konfirmasi Perubahan</h3>
      <p style="font-size:13.5px; color:#cbd5e1; line-height:1.5; margin-bottom:28px;" id="confirmSaveDetails">
        Apakah Anda yakin sudah fix dan ingin menyimpan perubahan data ini?
      </p>

      <div style="display:flex; gap:12px;">
        <button type="button" onclick="cancelSaveAction()" class="btn btn-outline" style="flex:1; justify-content:center; font-size:11px; padding:12px;">
          ✏️ Belum (Lanjut Edit)
        </button>
        <button type="button" onclick="executeSaveAction()" class="btn btn-primary" style="flex:1; justify-content:center; font-size:11px; padding:12px;">
          ✓ Ya, Simpan Perubahan
        </button>
      </div>
    </div>
  </div>

  <!-- ANIMATED CHECKMARK SUCCESS MODAL -->
  <div id="successCheckModal" style="display:none;" class="modal-backdrop-blur">
    <div style="background: linear-gradient(145deg, #172133, #111826); width: 90%; max-width: 440px; border-radius: 24px; padding: 36px 28px; border: 1px solid rgba(52, 211, 153, 0.35); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.85), 0 0 35px rgba(52, 211, 153, 0.25); text-align: center; position: relative;">
      
      <div style="width: 80px; height: 80px; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;">
        <svg class="checkmark-svg" viewBox="0 0 52 52" style="width:72px; height:72px;">
          <circle class="checkmark-circle" cx="26" cy="26" r="23"/>
          <path class="checkmark-check" fill="none" stroke-width="3.5" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
        </svg>
      </div>

      <h3 style="font-family:'Space Grotesk',sans-serif; font-size:20px; font-weight:800; color:#34d399; margin-bottom:8px; text-transform:uppercase; letter-spacing:1px;" id="successModalTitle">Berhasil Disimpan!</h3>
      <p style="font-size:13.5px; color:#e2e8f0; line-height:1.5; margin-bottom:20px;" id="successModalMessage">
        Data dan perubahan berhasil tersimpan ke sistem database.
      </p>

      <div style="width: 100%; height: 4px; background: rgba(255,255,255,0.1); border-radius: 2px; overflow: hidden;">
        <div id="successProgressBar" style="width: 100%; height: 100%; background: #34d399; transition: width 1.5s linear;"></div>
      </div>
    </div>
  </div>

  <script>
    let targetPendingForm = null;

    document.addEventListener('DOMContentLoaded', () => {
      // Intercept all form submissions in admin panel
      document.querySelectorAll('form').forEach(form => {
        if (form.action.includes('/admin/logout') || form.getAttribute('on-submit-no-modal') === 'true') return;

        form.addEventListener('submit', function(e) {
          if (this.dataset.confirmed === 'true') {
            return true;
          }

          e.preventDefault();
          targetPendingForm = this;

          let formSectionName = 'data halaman';
          const cardHeader = this.closest('.admin-card')?.querySelector('h3, h1, .admin-title');
          const submitBtn = this.querySelector('button[type="submit"]');

          if (cardHeader && cardHeader.textContent.trim()) {
            formSectionName = '"' + cardHeader.textContent.trim().replace(/^Form\s+/i, '') + '"';
          } else if (submitBtn && submitBtn.textContent.trim()) {
            formSectionName = '"' + submitBtn.textContent.trim() + '"';
          }

          document.getElementById('confirmSaveDetails').innerHTML = 
            'Apakah Anda yakin sudah fix dan ingin menyimpan perubahan pada <strong>' + formSectionName + '</strong>?';

          document.getElementById('confirmSaveModal').style.display = 'flex';
        });
      });

      // Trigger success animation if redirected with flash message
      @if(session('success'))
        showSuccessCheckmarkModal("{{ session('success') }}");
      @endif
    });

    function cancelSaveAction() {
      document.getElementById('confirmSaveModal').style.display = 'none';
      targetPendingForm = null;
    }

    function executeSaveAction() {
      if (!targetPendingForm) return;

      document.getElementById('confirmSaveModal').style.display = 'none';

      // Sync Quill textareas before submit
      if (typeof articleQuill !== 'undefined' && articleQuill && document.getElementById('articleContent')) {
        document.getElementById('articleContent').value = articleQuill.root.innerHTML;
      }
      if (typeof pageQuill !== 'undefined' && pageQuill && document.getElementById('pageContentInput')) {
        document.getElementById('pageContentInput').value = pageQuill.root.innerHTML;
      }

      // Show Animated Checkmark
      document.getElementById('successModalTitle').textContent = 'Perubahan Tersimpan!';
      document.getElementById('successModalMessage').textContent = 'Memproses dan memperbarui data di sistem...';
      document.getElementById('successCheckModal').style.display = 'flex';

      setTimeout(() => {
        const progressBar = document.getElementById('successProgressBar');
        if (progressBar) progressBar.style.width = '0%';
      }, 50);

      setTimeout(() => {
        targetPendingForm.dataset.confirmed = 'true';
        targetPendingForm.submit();
      }, 850);
    }

    function showSuccessCheckmarkModal(msg) {
      const modal = document.getElementById('successCheckModal');
      if (!modal) return;
      document.getElementById('successModalTitle').textContent = '✓ Berhasil Disimpan!';
      document.getElementById('successModalMessage').textContent = msg || 'Data telah berhasil diperbarui di sistem.';
      modal.style.display = 'flex';

      setTimeout(() => {
        const progressBar = document.getElementById('successProgressBar');
        if (progressBar) progressBar.style.width = '0%';
      }, 50);

      setTimeout(() => {
        modal.style.display = 'none';
      }, 2400);
    }
  </script>
</body>
</html>
