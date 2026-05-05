@php
  $phone1    = \App\Models\SiteSetting::get('phone_1', '+998 97 411 11 51');
  $phone2    = \App\Models\SiteSetting::get('phone_2', '+998 99 433 00 47');
  $address   = \App\Models\SiteSetting::get('address', 'Toshkent viloyati, Yuqori-Chirchiq tumani');
  $telegram  = \App\Models\SiteSetting::get('social_telegram', '');
  $instagram = \App\Models\SiteSetting::get('social_instagram', '');
  $youtube   = \App\Models\SiteSetting::get('social_youtube', '');
  $facebook  = \App\Models\SiteSetting::get('social_facebook', '');
@endphp
<!-- FOOTER -->
<footer>
  <div class="footer-inner">
    <div class="footer-brand">
      <a href="{{ url('/') }}" style="text-decoration: none;" class="logo">MEGA<span>STROY</span></a>
      <p data-i18n="foot.about">O'zbekistondagi yetakchi fasad dekor ishlab chiqaruvchisi. 2013-yildan buyon sifat va ishonch.</p>
      <div class="footer-socials">
        @if($telegram)  <a href="{{ $telegram }}"  class="soc-btn" aria-label="Telegram"  target="_blank" rel="noopener"><i class="fab fa-telegram"></i></a>  @endif
        @if($instagram) <a href="{{ $instagram }}" class="soc-btn" aria-label="Instagram" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a> @endif
        @if($youtube)   <a href="{{ $youtube }}"   class="soc-btn" aria-label="YouTube"   target="_blank" rel="noopener"><i class="fab fa-youtube"></i></a>   @endif
        @if($facebook)  <a href="{{ $facebook }}"  class="soc-btn" aria-label="Facebook"  target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>@endif
      </div>
    </div>
    <div class="footer-col">
      <h4 data-i18n="foot.prod">Mahsulotlar</h4>
      <a href="{{ url('/') }}#products">Premium Termopanel</a>
      <a href="{{ url('/') }}#products">Luvr Karnizlari</a>
      <a href="{{ url('/') }}#products">3D Fasad Panel</a>
      <a href="{{ url('/') }}#products">Antik Ustunlar</a>
      <a href="{{ url('/') }}#products">Dekor Elementlar</a>
    </div>
    <div class="footer-col">
      <h4 data-i18n="foot.comp">Kompaniya</h4>
      <a href="{{ url('/about') }}" data-i18n="nav.about_page">Biz haqimizda</a>
      <a href="{{ url('/') }}#process" data-i18n="nav.process">Jarayon</a>
      <a href="{{ url('/') }}#contact" data-i18n="nav.contact">Biz bilan bog'lanish</a>
    </div>
    <div class="footer-col">
      <h4 data-i18n="nav.contact">Biz bilan bog'lanish</h4>
      @if($phone1) <a href="tel:{{ preg_replace('/\s+/', '', $phone1) }}">{{ $phone1 }}</a> @endif
      @if($phone2) <a href="tel:{{ preg_replace('/\s+/', '', $phone2) }}">{{ $phone2 }}</a> @endif
      @if($telegram) <a href="{{ $telegram }}" target="_blank" rel="noopener">Telegram</a> @endif
      @if($address)  <span style="color:var(--text-dim);font-size:12px;line-height:1.5">{{ $address }}</span> @endif
    </div>
  </div>
  <div class="footer-bottom">
    <p>© {{ date('Y') }} <span>Mega Stroy Building</span>. <span data-i18n="foot.rights">Barcha huquqlar himoyalangan.</span></p>
    <p>Developed by <span>DIGGO SOFT</span></p>
  </div>
</footer>
