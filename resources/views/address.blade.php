@extends('layouts.app')
@section('title', 'Manzil — Mega Stroy Building')
@section('meta_description', 'Mega Stroy Building showroom va ishlab chiqarish zavodi manzili. Yandex Maps, Google Maps, 2GIS orqali toping.')

@push('styles')
<style>
.addr-hero{padding:110px 40px 50px;max-width:1400px;margin:0 auto}
.addr-grid{display:grid;grid-template-columns:1fr 1fr;gap:40px;max-width:1400px;margin:0 auto;padding:0 40px 60px}
.addr-card{background:var(--surface);border:1px solid var(--border);padding:32px}
.addr-card h3{font-family:var(--font-display);font-size:20px;font-weight:400;color:var(--white);margin-bottom:24px;padding-bottom:16px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:12px}
.addr-row{display:flex;gap:16px;align-items:flex-start;margin-bottom:20px}
.addr-icon{width:40px;height:40px;background:rgba(201,168,76,0.1);border:1px solid rgba(201,168,76,0.2);display:flex;align-items:center;justify-content:center;color:var(--gold);flex-shrink:0}
.addr-label{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--dim);margin-bottom:4px}
.addr-val{font-size:14px;color:var(--white);line-height:1.7}
.addr-val a{color:var(--gold);text-decoration:none}
.map-section{max-width:1400px;margin:0 auto;padding:0 40px 80px}
.map-tabs{display:flex;border-bottom:1px solid var(--border)}
.map-tab{padding:12px 24px;font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;cursor:pointer;background:none;border:none;color:var(--dim);border-bottom:2px solid transparent;margin-bottom:-1px;transition:all .2s;font-family:inherit}
.map-tab.active{color:var(--gold);border-bottom-color:var(--gold)}
.map-frame{display:none;border:1px solid var(--border);border-top:none}
.map-frame.active{display:block}
.map-frame iframe{width:100%;height:440px;border:none;display:block}
.map-link{display:flex;align-items:center;justify-content:center;gap:8px;padding:13px;background:var(--surface);font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--gold);text-decoration:none;border-top:1px solid var(--border);transition:background .2s}
.map-link:hover{background:rgba(201,168,76,0.08)}
.map-placeholder{height:440px;display:flex;align-items:center;justify-content:center;background:var(--surface);flex-direction:column;gap:16px}
.map-ext-btn{display:inline-flex;align-items:center;gap:6px;padding:10px 18px;border:1px solid rgba(201,168,76,0.3);color:var(--gold);font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;text-decoration:none;transition:background .2s}
.map-ext-btn:hover{background:rgba(201,168,76,0.08)}
@media(max-width:900px){.addr-grid{grid-template-columns:1fr;gap:20px}.addr-hero,.addr-grid,.map-section{padding-left:20px;padding-right:20px}}
</style>
@endpush

@section('content')

<div class="addr-hero">
  <div style="font-size:10px;letter-spacing:3px;text-transform:uppercase;color:var(--gold);margin-bottom:12px" data-i18n="nav.address">Manzil</div>
  <h1 style="font-family:var(--font-display);font-size:clamp(32px,5vw,56px);font-weight:300;color:var(--white);margin-bottom:12px">
    <span data-i18n="addr.h1.pre">Biz bilan</span>
    <em style="font-style:italic;color:var(--gold)"> <span data-i18n="addr.h1.em">bog'laning</span></em>
  </h1>
  <p style="color:var(--text-dim);font-size:14px;max-width:500px" data-i18n="addr.sub">Showroomimizga tashrif buyuring yoki onlayn maslahat oling.</p>
</div>

<div class="addr-grid">

  {{-- Showroom --}}
  <div class="addr-card">
    <h3><i class="fas fa-store" style="color:var(--gold)"></i> Showroom</h3>
    <div class="addr-row">
      <div class="addr-icon"><i class="fas fa-map-marker-alt"></i></div>
      <div>
        <div class="addr-label" data-i18n="addr.label.address">Manzil</div>
        <div class="addr-val">{{ \App\Models\SiteSetting::get('address', 'Toshkent viloyati, Yuqori-Chirchiq tumani, Iyk ota MFY, R/Z uy') }}</div>
      </div>
    </div>
    <div class="addr-row">
      <div class="addr-icon"><i class="fas fa-phone"></i></div>
      <div>
        <div class="addr-label" data-i18n="addr.label.phone">Telefon</div>
        @php $p1 = \App\Models\SiteSetting::get('phone_1','+998 97 411 11 51'); $p2 = \App\Models\SiteSetting::get('phone_2',''); @endphp
        <div class="addr-val">
          <a href="tel:{{ preg_replace('/\s+/','',$p1) }}">{{ $p1 }}</a>
          @if($p2)<br><a href="tel:{{ preg_replace('/\s+/','',$p2) }}">{{ $p2 }}</a>@endif
        </div>
      </div>
    </div>
    <div class="addr-row">
      <div class="addr-icon"><i class="fas fa-clock"></i></div>
      <div>
        <div class="addr-label" data-i18n="addr.label.hours">Ish vaqti</div>
        <div class="addr-val">
          <span data-i18n="addr.hours.val1">Dushanba — Shanba</span><br>
          <span data-i18n="addr.hours.val2">09:00 — 18:00</span>
        </div>
      </div>
    </div>
    @php $tg = \App\Models\SiteSetting::get('social_telegram',''); @endphp
    @if($tg)
    <div class="addr-row">
      <div class="addr-icon"><i class="fab fa-telegram"></i></div>
      <div>
        <div class="addr-label">Telegram</div>
        <div class="addr-val"><a href="{{ $tg }}" target="_blank" rel="noopener">{{ $tg }}</a></div>
      </div>
    </div>
    @endif
  </div>

  {{-- Factory --}}
  <div class="addr-card">
    <h3><i class="fas fa-industry" style="color:var(--gold)"></i> <span data-i18n="addr.factory.name">Ishlab chiqarish zavodi</span></h3>
    @php
      $factoryAddr  = \App\Models\SiteSetting::get('factory_address', 'Toshkent viloyati, Yuqori-Chirchiq tumani, Sanoat zonasi');
      $factoryNote  = \App\Models\SiteSetting::get('factory_note', 'Zavodga tashrif uchun avval telefon orqali bog\'laning.');
      $factoryHours = \App\Models\SiteSetting::get('factory_hours', '');
    @endphp
    <div class="addr-row">
      <div class="addr-icon"><i class="fas fa-map-marker-alt"></i></div>
      <div>
        <div class="addr-label" data-i18n="addr.label.address">Manzil</div>
        <div class="addr-val">{{ $factoryAddr }}</div>
      </div>
    </div>
    @if($factoryHours)
    <div class="addr-row">
      <div class="addr-icon"><i class="fas fa-clock"></i></div>
      <div>
        <div class="addr-label" data-i18n="addr.label.hours">Ish vaqti</div>
        <div class="addr-val">{{ $factoryHours }}</div>
      </div>
    </div>
    @endif
    <div class="addr-row">
      <div class="addr-icon"><i class="fas fa-info-circle"></i></div>
      <div>
        <div class="addr-label" data-i18n="addr.label.note">Eslatma</div>
        <div class="addr-val" style="color:var(--text-dim)">{{ $factoryNote }}</div>
      </div>
    </div>
    <div style="margin-top:24px;padding-top:24px;border-top:1px solid var(--border)">
      <div style="font-size:10px;color:var(--dim);margin-bottom:14px;text-transform:uppercase;letter-spacing:2px" data-i18n="addr.map.title">Xarita orqali topish</div>
      <div style="display:flex;gap:10px;flex-wrap:wrap">
        <a href="https://go.2gis.com/uzr4e" target="_blank" rel="noopener" class="map-ext-btn">
          <i class="fas fa-map"></i> 2GIS
        </a>
        <a href="https://maps.google.com/?q=Yuqori-Chirchiq,+Tashkent+Region,+Uzbekistan" target="_blank" rel="noopener" class="map-ext-btn">
          <i class="fab fa-google"></i> Google Maps
        </a>
        <a href="https://yandex.uz/maps/?text=Yuqori-Chirchiq%2C+Toshkent+viloyati" target="_blank" rel="noopener" class="map-ext-btn">
          <i class="fas fa-map-marked-alt"></i> Yandex
        </a>
      </div>
    </div>
  </div>

</div>

{{-- Map tabs --}}
<div class="map-section">
  <div class="map-tabs">
    <button class="map-tab active" onclick="switchMap('google',this)"><i class="fab fa-google"></i> Google Maps</button>
    <button class="map-tab" onclick="switchMap('yandex',this)"><i class="fas fa-map-marked-alt"></i> Yandex Maps</button>
    <button class="map-tab" onclick="switchMap('2gis',this)"><i class="fas fa-map"></i> 2GIS</button>
  </div>

  <div class="map-frame active" id="map-google">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d48140.63!2d69.581!3d41.469!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38ae8b0cc379e9b3%3A0x3c5aad4c648e9b5a!2sYuqorichirchiq%20District!5e0!3m2!1suz!2suz!4v1"
      allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <a href="https://maps.google.com/?q=Yuqori-Chirchiq,+Tashkent+Region,+Uzbekistan" target="_blank" rel="noopener" class="map-link">
      <i class="fas fa-external-link-alt"></i> <span data-i18n="addr.map.open.google">Google Maps-da ochish</span>
    </a>
  </div>

  <div class="map-frame" id="map-yandex">
    <div class="map-placeholder">
      <i class="fas fa-map-marked-alt" style="font-size:48px;color:rgba(201,168,76,0.3)"></i>
      <a href="https://yandex.uz/maps/?text=Yuqori-Chirchiq%2C+Toshkent+viloyati" target="_blank" rel="noopener" class="map-link" style="border-top:none">
        <i class="fas fa-external-link-alt"></i> <span data-i18n="addr.map.open.yandex">Yandex Maps-da ochish</span>
      </a>
    </div>
  </div>

  <div class="map-frame" id="map-2gis">
    <div class="map-placeholder">
      <i class="fas fa-map" style="font-size:48px;color:rgba(201,168,76,0.3)"></i>
      <a href="https://2gis.uz/tashkent" target="_blank" rel="noopener" class="map-link" style="border-top:none">
        <i class="fas fa-external-link-alt"></i> <span data-i18n="addr.map.open.2gis">2GIS-da ochish</span>
      </a>
    </div>
  </div>
</div>

@push('scripts')
<script>
function switchMap(id, btn) {
  document.querySelectorAll('.map-tab').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.map-frame').forEach(f => f.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('map-' + id).classList.add('active');
}
</script>
@endpush

@endsection
