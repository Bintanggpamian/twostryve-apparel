@extends('layouts.app')
@section('title', 'Kontak Kami — TWOSTRYVE')
@section('content')
<div class="page-hero"><div class="container"><h1>Kontak Kami</h1><p>Ada pertanyaan? Kami siap membantu!</p></div></div>
<div class="container section">
    @if(session('success'))<div style="padding:var(--space-4);background:var(--color-success);color:white;margin-bottom:var(--space-6);border-radius:var(--radius-sm)">{{ session('success') }}</div>@endif
    <div class="contact-grid">
        <div>
            <h2 style="font-family:var(--font-heading);font-size:var(--text-3xl);letter-spacing:2px;margin-bottom:var(--space-8)">GET IN TOUCH</h2>
            <div class="contact-info-item"><div class="contact-info-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg></div><div><div style="font-weight:600;margin-bottom:2px">WhatsApp</div><a href="https://wa.me/{{ $settings['whatsapp'] ?? '' }}" target="_blank" style="color:var(--color-text-secondary)">{{ str_replace('62', '+62 ', $settings['whatsapp'] ?? '') }}</a></div></div>
            <div class="contact-info-item"><div class="contact-info-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg></div><div><div style="font-weight:600;margin-bottom:2px">Email</div><a href="mailto:{{ $settings['email'] ?? '' }}" style="color:var(--color-text-secondary)">{{ $settings['email'] ?? '' }}</a></div></div>
            <div class="contact-info-item"><div class="contact-info-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg></div><div><div style="font-weight:600;margin-bottom:2px">Lokasi</div><span style="color:var(--color-text-secondary)">{{ $settings['address'] ?? '' }}</span></div></div>
        </div>
        <div>
            <form class="form-section" method="POST" action="{{ route('contact.send') }}">
                @csrf
                <h3 class="form-section-title">Kirim Pesan</h3>
                <div class="form-group"><label class="form-label">Nama <span class="required">*</span></label><input type="text" class="form-input" name="name" required placeholder="Nama kamu"></div>
                <div class="form-group"><label class="form-label">Email <span class="required">*</span></label><input type="email" class="form-input" name="email" required placeholder="email@contoh.com"></div>
                <div class="form-group"><label class="form-label">Pesan <span class="required">*</span></label><textarea class="form-textarea" name="message" required placeholder="Tulis pesan kamu..."></textarea></div>
                <button type="submit" class="btn btn-primary btn-block">Kirim Pesan</button>
            </form>
        </div>
    </div>
</div>
@endsection
