@php $navPhone = \App\Models\SiteSetting::get('phone_1', '+998 97 411 11 51'); @endphp
<!-- LANGUAGE BAR -->
<div class="lang-bar">
  <button class="lang-btn active" data-lang="uz-lat">UZ</button>
  <button class="lang-btn" data-lang="ru">РУ</button>
  <button class="lang-btn" data-lang="en">EN</button>
</div>

<!-- HEADER -->
<header id="header">
  <a href="{{ url('/') }}" style="text-decoration: none" class="logo">MEGA<span>STROY</span></a>
  <nav>
    <a href="{{ url('/') }}#products" data-i18n="nav.products">Katalog</a>
    <a href="{{ url('/') }}#contact" data-i18n="nav.contact">Biz bilan bog'lanish</a>
    <a href="{{ route('address') }}" data-i18n="nav.address" class="{{ request()->routeIs('address') ? 'nav-active' : '' }}">Manzil</a>
    <a href="{{ url('/about') }}" data-i18n="nav.about_page" class="{{ request()->is('about') ? 'nav-active' : '' }}">Biz haqimizda</a>
  </nav>
  <a href="tel:{{ preg_replace('/\s+/', '', $navPhone) }}" class="header-cta"><i class="fas fa-phone"></i> {{ $navPhone }}</a>
  <button class="hamburger" id="menuBtn" aria-label="Menyu"><span></span><span></span><span></span></button>
</header>
<button class="theme-toggle" id="themeToggle" aria-label="Tema almashtirish">
  <i class="fas fa-moon" id="themeIcon"></i>
</button>

<!-- MOBILE MENU -->
<div class="mobile-menu" id="mobileMenu">
  <button class="mobile-close" id="menuClose">&#x2715;</button>
  <a href="{{ url('/') }}#about" class="mob-link" data-i18n="nav.about">Biz haqimizda</a>
  <a href="{{ url('/') }}#products" class="mob-link" data-i18n="nav.products">Mahsulotlar</a>
  <a href="{{ url('/') }}#process" class="mob-link" data-i18n="nav.process">Jarayon</a>
  <a href="{{ url('/') }}#contact" class="mob-link" data-i18n="nav.contact">Biz bilan bog'lanish</a>
  <a href="{{ route('address') }}" class="mob-link" data-i18n="nav.address">Manzil</a>
  <a href="{{ url('/about') }}" class="mob-link" data-i18n="nav.about_page">Kompaniya</a>
  <a href="tel:{{ preg_replace('/\s+/', '', $navPhone) }}" style="color:var(--gold);font-size:18px;font-weight:600;letter-spacing:2px;font-family:var(--font-body)">{{ $navPhone }}</a>
  <div class="mobile-lang">
    <button class="lang-btn active" data-lang="uz-lat">UZ</button>
    <button class="lang-btn" data-lang="ru">РУ</button>
    <button class="lang-btn" data-lang="en">EN</button>
  </div>
  <button class="mobile-theme-btn" id="mobileThemeBtn">
    <i class="fas fa-moon" id="mobileThemeIcon"></i>
    <span id="mobileThemeLabel">Yorug' rejim</span>
  </button>
</div>
