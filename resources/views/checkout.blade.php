@extends('layouts.app')
@section('title', 'Checkout — TWOSTRYVE')
@section('content')
@php use App\Helpers\FormatHelper; @endphp
<div class="container" style="padding-top:var(--space-8);padding-bottom:var(--space-16)">
    <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> <span class="sep">/</span> <a href="{{ route('cart') }}">Keranjang</a> <span class="sep">/</span> <span>Checkout</span></div>
    <h1 style="font-family:var(--font-heading);font-size:var(--text-4xl);letter-spacing:2px;margin-bottom:var(--space-8)">CHECKOUT</h1>
    <form class="checkout-grid" method="POST" action="{{ route('checkout.process') }}">
        @csrf
        <div>
            <div class="form-section">
                <h3 class="form-section-title">Data Pembeli</h3>
                <div class="form-row">
                    <div class="form-group"><label class="form-label">Nama Lengkap <span class="required">*</span></label><input type="text" class="form-input" name="name" required placeholder="Nama lengkap kamu" value="{{ old('name') }}"></div>
                    <div class="form-group"><label class="form-label">No. HP / WhatsApp <span class="required">*</span></label><input type="tel" class="form-input" name="phone" required placeholder="08xxxxxxxxxx" value="{{ old('phone') }}"></div>
                </div>
                <div class="form-group"><label class="form-label">Email <span class="required">*</span></label><input type="email" class="form-input" name="email" required placeholder="email@contoh.com" value="{{ old('email') }}"></div>
                <div class="form-group"><label class="form-label">Alamat Lengkap <span class="required">*</span></label><textarea class="form-textarea" name="address" required placeholder="Jalan, No. Rumah, RT/RW, Kelurahan, Kecamatan, Kota, Provinsi, Kode Pos">{{ old('address') }}</textarea></div>
                <div class="form-group"><label class="form-label">Catatan (opsional)</label><textarea class="form-textarea" name="notes" placeholder="Catatan tambahan untuk pesanan kamu..." style="min-height:60px">{{ old('notes') }}</textarea></div>
            </div>
            <div class="form-section">
                <h3 class="form-section-title">Metode Pembayaran</h3>
                <div class="payment-options" id="paymentOptions">
                    <div class="payment-option active" data-method="transfer" onclick="selectPayment(this)"><span class="payment-radio"></span><div><div class="payment-name">Transfer Bank</div><div class="payment-desc">BCA / Mandiri</div></div></div>
                    <div class="payment-option" data-method="qris" onclick="selectPayment(this)"><span class="payment-radio"></span><div><div class="payment-name">QRIS</div><div class="payment-desc">Scan QR dari e-wallet atau mobile banking</div></div></div>
                    <div class="payment-option" data-method="cod" onclick="selectPayment(this)"><span class="payment-radio"></span><div><div class="payment-name">COD (Cash on Delivery)</div><div class="payment-desc">Bayar saat barang diterima — area terbatas</div></div></div>
                </div>
                <input type="hidden" name="payment_method" id="paymentMethodInput" value="transfer">
            </div>
            @if($errors->any())
                <div style="color:var(--color-error);margin-bottom:var(--space-4)">
                    @foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach
                </div>
            @endif
            <button type="submit" class="btn btn-primary btn-lg btn-block">Buat Pesanan</button>
        </div>
        <div class="cart-summary" style="position:sticky;top:calc(var(--header-height) + var(--space-8))">
            <h3 class="cart-summary-title">Ringkasan Pesanan</h3>
            @foreach($cart as $item)
            <div style="display:flex;gap:var(--space-3);padding:var(--space-3) 0;border-bottom:1px solid var(--color-border)">
                <div style="width:50px;height:60px;border-radius:var(--radius-sm);overflow:hidden;flex-shrink:0;background:var(--color-bg-card)"><img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" style="width:100%;height:100%;object-fit:cover"></div>
                <div style="flex:1;font-size:var(--text-sm)"><div style="font-weight:600">{{ $item['name'] }}</div><div style="color:var(--color-text-muted);font-size:var(--text-xs)">{{ $item['color'] }} / {{ $item['size'] }} × {{ $item['qty'] }}</div></div>
                <div style="font-weight:600;font-size:var(--text-sm);white-space:nowrap">{{ FormatHelper::price($item['price'] * $item['qty']) }}</div>
            </div>
            @endforeach
            <div class="cart-summary-row" style="margin-top:var(--space-4)"><span>Subtotal</span><span>{{ FormatHelper::price($subtotal) }}</span></div>
            <div class="cart-summary-row"><span>Ongkir</span><span>{!! $shipping === 0 ? '<span style="color:var(--color-success)">GRATIS</span>' : FormatHelper::price($shipping) !!}</span></div>
            <div class="cart-summary-row total"><span>Total</span><span style="color:var(--color-accent)">{{ FormatHelper::price($total) }}</span></div>
        </div>
    </form>
</div>
@push('scripts')
<script>
function selectPayment(el) {
    document.querySelectorAll('.payment-option').forEach(o => o.classList.remove('active'));
    el.classList.add('active');
    document.getElementById('paymentMethodInput').value = el.dataset.method;
}
</script>
@endpush
@endsection
