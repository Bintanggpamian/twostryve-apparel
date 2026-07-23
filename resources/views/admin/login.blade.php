<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TWOSTRYVE — Admin Executive Login</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg-dark: #0c121e;
      --card-bg-start: #172133;
      --card-bg-end: #111826;
      --accent-orange: #ee4d2d;
      --accent-orange-hover: #ff5738;
      --text-main: #f8fafc;
      --text-muted: #94a3b8;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: var(--bg-dark);
      background-image: 
        radial-gradient(at 0% 0%, rgba(238, 77, 45, 0.12) 0px, transparent 50%),
        radial-gradient(at 100% 100%, rgba(30, 41, 59, 0.5) 0px, transparent 50%);
      color: var(--text-main);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      overflow-x: hidden;
    }

    /* Skeuomorphic Container Card */
    .login-card {
      width: 100%;
      max-width: 440px;
      background: linear-gradient(145deg, var(--card-bg-start), var(--card-bg-end));
      border-radius: 24px;
      padding: 44px 36px;
      border: 1px solid rgba(255, 255, 255, 0.08);
      box-shadow: 
        20px 20px 50px #060910, 
        -15px -15px 40px #1a273e,
        inset 1px 1px 1px rgba(255, 255, 255, 0.15);
      position: relative;
    }

    /* Brand Header Emblem */
    .brand-emblem {
      background: linear-gradient(145deg, #0d1422, #182338);
      padding: 26px 20px;
      border-radius: 20px;
      border: 1px solid rgba(255, 255, 255, 0.08);
      box-shadow: 
        inset 4px 4px 8px #080d16, 
        inset -4px -4px 8px #1d2c46,
        0 10px 25px rgba(0,0,0,0.5);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      gap: 12px;
      margin-bottom: 32px;
    }

    .brand-logo-text {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 32px;
      font-weight: 900;
      letter-spacing: 5px;
      color: #ffffff;
      text-transform: uppercase;
      text-shadow: 0 4px 15px rgba(0,0,0,0.6);
      line-height: 1;
    }
    .brand-logo-text span { 
      color: var(--accent-orange); 
      text-shadow: 0 0 20px rgba(238, 77, 45, 0.5);
    }

    /* Glowing LED Indicator */
    .led-status {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      color: #34d399;
      background: rgba(16, 185, 129, 0.1);
      padding: 4px 10px;
      border-radius: 20px;
      border: 1px solid rgba(52, 211, 153, 0.2);
    }
    .led-dot {
      width: 7px;
      height: 7px;
      background: #34d399;
      border-radius: 50%;
      box-shadow: 0 0 10px #34d399;
      animation: ledPulse 2s infinite;
    }
    @keyframes ledPulse {
      0%, 100% { opacity: 1; transform: scale(1); }
      50% { opacity: 0.4; transform: scale(0.85); }
    }

    .login-title {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 20px;
      font-weight: 700;
      margin-bottom: 6px;
      letter-spacing: 0.5px;
    }
    .login-sub {
      font-size: 13px;
      color: var(--text-muted);
      margin-bottom: 28px;
    }

    /* Form Fields with Inset Shadow */
    .form-group {
      margin-bottom: 22px;
      position: relative;
    }
    .form-label {
      display: block;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: #cbd5e1;
      margin-bottom: 8px;
    }
    .input-wrapper {
      position: relative;
      display: flex;
      align-items: center;
    }
    .input-icon {
      position: absolute;
      left: 16px;
      width: 18px;
      height: 18px;
      color: #64748b;
      stroke-width: 2;
      transition: color 0.2s;
    }
    .skeuo-input {
      width: 100%;
      background: #0f1624;
      border: 1px solid rgba(255, 255, 255, 0.06);
      border-radius: 12px;
      padding: 14px 16px 14px 46px;
      font-family: inherit;
      font-size: 14px;
      color: #fff;
      outline: none;
      box-shadow: 
        inset 4px 4px 8px #070b13, 
        inset -3px -3px 6px #1a273e;
      transition: all 0.25s ease;
    }
    .skeuo-input:focus {
      border-color: var(--accent-orange);
      box-shadow: 
        inset 4px 4px 8px #070b13, 
        inset -3px -3px 6px #1a273e,
        0 0 12px rgba(238, 77, 45, 0.35);
    }
    .skeuo-input:focus + .input-icon,
    .skeuo-input:focus ~ .input-icon {
      color: var(--accent-orange);
    }

    /* Password Toggle Icon */
    .password-toggle {
      position: absolute;
      right: 16px;
      background: transparent;
      border: none;
      color: #64748b;
      cursor: pointer;
      display: flex;
      align-items: center;
      padding: 0;
    }
    .password-toggle:hover { color: #fff; }

    /* Remember me & Option */
    .form-options {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 28px;
      font-size: 13px;
    }
    .remember-label {
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
      color: #cbd5e1;
      font-weight: 500;
    }
    .skeuo-checkbox {
      appearance: none;
      width: 20px;
      height: 20px;
      background: #0f1624;
      border-radius: 6px;
      border: 1px solid rgba(255, 255, 255, 0.08);
      box-shadow: inset 2px 2px 4px #070b13, inset -2px -2px 4px #1a273e;
      cursor: pointer;
      position: relative;
      transition: all 0.2s;
    }
    .skeuo-checkbox:checked {
      background: var(--accent-orange);
      border-color: var(--accent-orange);
      box-shadow: 0 0 10px rgba(238, 77, 45, 0.5);
    }
    .skeuo-checkbox:checked::after {
      content: '✓';
      position: absolute;
      top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      color: #fff;
      font-size: 12px;
      font-weight: 800;
    }

    /* Tactile 3D Button */
    .skeuo-btn {
      width: 100%;
      background: linear-gradient(145deg, var(--accent-orange-hover), var(--accent-orange));
      color: #fff;
      font-family: 'Space Grotesk', sans-serif;
      font-size: 14px;
      font-weight: 700;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      padding: 16px;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      box-shadow: 
        6px 6px 16px #060a12, 
        -4px -4px 12px #1e2c45,
        inset 0 1px 0 rgba(255, 255, 255, 0.3);
      transition: all 0.15s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }
    .skeuo-btn:hover {
      background: linear-gradient(145deg, #ff6b4d, #f14422);
      box-shadow: 
        8px 8px 22px #060a12, 
        -6px -6px 18px #1e2c45;
    }
    .skeuo-btn:active {
      transform: translateY(3px);
      box-shadow: 
        inset 4px 4px 10px rgba(0,0,0,0.6),
        inset -2px -2px 6px rgba(255,255,255,0.2);
    }

    /* Alert Message */
    .alert-error {
      background: rgba(239, 68, 68, 0.12);
      border: 1px solid rgba(239, 68, 68, 0.3);
      color: #fca5a5;
      padding: 12px 16px;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 500;
      margin-bottom: 24px;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .alert-success {
      background: rgba(52, 211, 153, 0.12);
      border: 1px solid rgba(52, 211, 153, 0.3);
      color: #6ee7b7;
      padding: 12px 16px;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 500;
      margin-bottom: 24px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .footer-note {
      text-align: center;
      font-size: 11px;
      color: var(--text-muted);
      margin-top: 28px;
    }
  </style>
</head>
<body>

  <div class="login-card">
    <!-- Brand Header Emblem -->
    <div class="brand-emblem">
      @php $siteLogo = \App\Models\Setting::get('site_logo'); @endphp
      @if(!empty($siteLogo))
        <img src="{{ asset($siteLogo) }}" alt="TWOSTRYVE Logo" style="max-height: 100px; max-width: 260px; width: auto; object-fit: contain; filter: drop-shadow(0 8px 20px rgba(0,0,0,0.7)); display: block; margin: 4px auto;">
      @else
        <div class="brand-logo-text">TWO<span>STRYVE</span></div>
      @endif
      <div class="led-status" style="margin-top: 4px;">
        <span class="led-dot"></span> EXECUTIVE CONTROL SECURED
      </div>
    </div>

    <h2 class="login-title">Control Panel Access</h2>
    <p class="login-sub">Masukan kredensial admin Anda untuk melanjutkan.</p>

    @if(session('success'))
      <div class="alert-success">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px;height:18px"><polyline points="20 6 9 17 4 12"/></svg>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    @if($errors->any())
      <div class="alert-error">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px;height:18px"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <span>{{ $errors->first() }}</span>
      </div>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST">
      @csrf
      
      <!-- Email Field -->
      <div class="form-group">
        <label class="form-label" for="emailInput">Alamat Email Admin</label>
        <div class="input-wrapper">
          <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          <input type="email" class="skeuo-input" id="emailInput" name="email" value="{{ old('email', 'admin@twostryve.id') }}" required placeholder="admin@twostryve.id" autofocus>
        </div>
      </div>

      <!-- Password Field -->
      <div class="form-group">
        <label class="form-label" for="passInput">Kata Sandi</label>
        <div class="input-wrapper">
          <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          <input type="password" class="skeuo-input" id="passInput" name="password" required placeholder="••••••••">
          <button type="button" class="password-toggle" onclick="togglePasswordVisibility()" aria-label="Lihat password">
            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px;height:18px"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
          </button>
        </div>
      </div>

      <!-- Options -->
      <div class="form-options">
        <label class="remember-label">
          <input type="checkbox" class="skeuo-checkbox" name="remember" value="1" checked>
          <span>Ingat Sesi Ini</span>
        </label>
      </div>

      <!-- Tactile Submit Button -->
      <button type="submit" class="skeuo-btn">
        <span>Masuk ke Dashboard</span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px;height:18px"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </button>
    </form>

    <div class="footer-note">
      &copy; {{ date('Y') }} TWOSTRYVE. Executive Control System v2.4.
    </div>
  </div>

  <script>
    function togglePasswordVisibility() {
      const passInput = document.getElementById('passInput');
      const eyeIcon = document.getElementById('eyeIcon');
      if (passInput.type === 'password') {
        passInput.type = 'text';
        eyeIcon.style.color = '#ee4d2d';
      } else {
        passInput.type = 'password';
        eyeIcon.style.color = '#64748b';
      }
    }
  </script>
</body>
</html>
