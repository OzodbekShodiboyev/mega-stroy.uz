@extends('layouts.product')

@section('title', $product->name_uz . ' — Mega Stroy')

@section('content')
@php
  $images = $product->images ?? [];
  if (empty($images)) $images = [$product->first_image];
  $firstImg = $images[0];
  $stars  = str_repeat('★', round($product->rating)) . str_repeat('☆', 5 - round($product->rating));
  $catUz  = $product->categoryRel?->name_uz ?? $product->category_label;
  $catRu  = $product->categoryRel?->name_ru ?? $catUz;
  $catEn  = $product->categoryRel?->name_en ?? $catUz;
  $catLabel = $catUz;
  $badgeLabel = match($product->badge) {
    'top'     => 'TOP SOTUV',
    'new'     => 'YANGI',
    'popular' => 'MASHHUR',
    'sale'    => 'CHEGIRMA',
    default   => '',
  };
  $saving = $product->old_price ? ($product->old_price - $product->price) : 0;
  $pct    = $product->old_price ? round($saving / $product->old_price * 100) : 0;
@endphp

<!-- ZOOM MODAL -->
<div class="zoom-modal" id="zoomModal">
  <button class="zoom-close" id="zoomClose"><i class="fas fa-times"></i></button>
  <div class="zoom-modal-inner">
    <img id="zoomImg" src="" alt="Zoom" draggable="false">
  </div>
  <div class="zoom-controls">
    <button class="zoom-ctrl-btn" id="zoomOut"><i class="fas fa-search-minus"></i></button>
    <span class="zoom-scale-label" id="zoomScaleLabel">100%</span>
    <button class="zoom-ctrl-btn" id="zoomIn"><i class="fas fa-search-plus"></i></button>
  </div>
</div>

<!-- STICKY BAR -->
<div class="sticky-bar" id="stickyBar">
  <div class="sticky-left">
    <img class="sticky-thumb" src="{{ $firstImg }}" alt="">
    <div class="sticky-info">
      <div class="sticky-name">{{ $product->name_uz }}</div>
      <div class="sticky-price">{{ number_format($product->price, 0, '.', ',') }} UZS / {{ $product->unit_label }}</div>
    </div>
  </div>
  <div class="sticky-right">
    <button class="sticky-btn" onclick="orderNow()">
      <span data-i18n="sticky.btn">Buyurtma berish</span> <i class="fas fa-arrow-right"></i>
    </button>
  </div>
</div>

<!-- BREADCRUMB -->
<div class="breadcrumb-wrap">
  <nav class="breadcrumb">
    <a href="{{ url('/') }}" data-i18n="breadcrumb.home">Bosh sahifa</a>
    <span class="sep">›</span>
    <a href="{{ url('/') }}#products" data-i18n="breadcrumb.products">Mahsulotlar</a>
    <span class="sep">›</span>
    <a href="{{ url('/') }}#products">{{ $catLabel }}</a>
    <span class="sep">›</span>
    <span>{{ $product->name_uz }}</span>
  </nav>
</div>

<!-- PRODUCT HERO -->
<div class="product-hero">

  <!-- LEFT: GALLERY -->
  <div class="gallery-col">
    <div class="main-img-wrap" id="mainImgWrap">
      @if($product->badge)
      <div class="img-badge">{{ $badgeLabel }}</div>
      @endif
      <img id="mainImg" src="{{ $firstImg }}" alt="{{ $product->name_uz }}">
      <div class="magnifier-glass" id="magnifierGlass"></div>
      <div class="zoom-hint"><i class="fas fa-search-plus"></i> <span data-i18n="zoom.hint">Kattalashtirish</span></div>
    </div>
    <div class="thumb-strip">
      @foreach($images as $idx => $img)
      <div class="thumb-item {{ $idx === 0 ? 'active' : '' }}" data-src="{{ $img }}">
        <img src="{{ $img }}" alt="">
      </div>
      @endforeach
    </div>
  </div>

  <!-- RIGHT: INFO -->
  <div class="info-col">
    <div class="product-cat"
      data-cat-uz="{{ $catUz }}"
      data-cat-ru="{{ $catRu }}"
      data-cat-en="{{ $catEn }}">{{ $catUz }}</div>
    <h1 class="product-title fade-in"
      data-name-uz="{{ $product->name_uz }}"
      data-name-ru="{{ $product->name_ru ?: $product->name_uz }}"
      data-name-en="{{ $product->name_en ?: $product->name_uz }}">{{ $product->name_uz }}</h1>

    <div class="rating-row fade-in delay-1">
      <div class="stars-lg">{{ $stars }}</div>
      <div class="rating-num">{{ number_format($product->rating, 1) }}</div>
      <div class="rating-count">{{ $reviews->count() }} <span data-i18n="review">sharh</span></div>
      <div class="rating-sep"></div>
      @if($product->in_stock)
      <div class="stock-badge instock"><div class="stock-dot"></div><span data-i18n="prod.instock">Omborda bor</span></div>
      @else
      <div class="stock-badge outstock"><div class="stock-dot"></div><span>Tugagan</span></div>
      @endif
      @if($product->sku)
      <div class="rating-sep"></div>
      <div style="font-size:12px;color:var(--text-dim);letter-spacing:1px">SKU: {{ $product->sku }}</div>
      @endif
    </div>

    <div class="price-block fade-in delay-2">
      <div class="price-label"><span data-i18n="price.title">Narx</span> ({{ $product->unit_label }} <span data-i18n="price.per">uchun</span>)</div>
      <div class="price-main" id="unitPrice" data-price="{{ $product->price }}">
        {{ number_format($product->price, 0, '.', ',') }} <span>UZS / {{ $product->unit_label }}</span>
      </div>
      @if($product->old_price)
      <div class="price-old">{{ number_format($product->old_price, 0, '.', ',') }} UZS</div>
      <div class="price-saving"><i class="fas fa-tag"></i>
        {{ number_format($saving, 0, '.', ',') }} UZS tejaysiz (−{{ $pct }}%)
      </div>
      @endif
    </div>

    <!-- COLOR SELECTOR -->
    @if($product->colors->isNotEmpty())
    <div class="variant-block fade-in delay-2">
      <div class="variant-label"><span data-i18n="color.label">Rang:</span> <span id="colorName">{{ $product->colors->first()->name_uz }}</span></div>
      <div class="color-opts">
        @foreach($product->colors as $i => $color)
        <div class="color-opt {{ $i === 0 ? 'active' : '' }}"
             style="background:{{ $color->hex_code }}"
             data-name="{{ $color->name_uz }}"
             data-name-uz="{{ $color->name_uz }}"
             data-name-ru="{{ $color->name_ru ?: $color->name_uz }}"
             data-name-en="{{ $color->name_en ?: $color->name_uz }}"
             title="{{ $color->name_uz }}"></div>
        @endforeach
      </div>
    </div>
    @endif

    <!-- TEXTURE SELECTOR -->
    @if($product->textures->isNotEmpty())
    <div class="variant-block fade-in delay-2" style="margin-top:16px">
      <div class="variant-label"><span data-i18n="texture.label">Faktura:</span> <span id="textureName">{{ $product->textures->first()->name_uz }}</span></div>
      <div class="texture-opts">
        @foreach($product->textures as $i => $tex)
        <div class="texture-opt {{ $i === 0 ? 'active' : '' }}"
             data-name="{{ $tex->name_uz }}"
             data-name-uz="{{ $tex->name_uz }}"
             data-name-ru="{{ $tex->name_ru ?: $tex->name_uz }}"
             data-name-en="{{ $tex->name_en ?: $tex->name_uz }}">{{ $tex->name_uz }}</div>
        @endforeach
      </div>
    </div>
    @endif

    <!-- QTY -->
    <div class="qty-block fade-in delay-3">
      <div class="qty-label" data-i18n="qty.label">Miqdor</div>
      <div class="qty-wrap">
        <button class="qty-btn" id="qtyMinus"><i class="fas fa-minus"></i></button>
        <input class="qty-input" type="number" id="qtyInput" value="10" min="1" max="9999">
        <button class="qty-btn" id="qtyPlus"><i class="fas fa-plus"></i></button>
      </div>
      <div class="qty-unit">{{ $product->unit_label }}</div>
      <div style="font-size:12px;color:var(--text-dim);padding:4px 0">
        <span data-i18n="qty.total">Jami:</span>
        <span id="totalPrice" style="color:var(--gold);font-weight:700">{{ number_format($product->price * 10, 0, '.', ',') }} UZS</span>
      </div>
    </div>

    <!-- ACTIONS -->
    <div class="action-btns fade-in delay-3">
      <button class="btn-order" onclick="orderNow()">
        <i class="fas fa-shopping-cart"></i>
        <span data-i18n="btn.order">Buyurtma berish</span>
      </button>
      <button class="btn-save" id="saveBtn" title="Saqlash"><i class="fas fa-heart"></i></button>
      <button class="btn-share" id="shareBtn" title="Ulashish"><i class="fas fa-share-alt"></i></button>
    </div>

    <!-- FEATURE BADGES -->
    <div class="feat-badges fade-in delay-4">
      <div class="badge-feature">
        <div class="badge-feat-icon"><i class="fas fa-shield-alt"></i></div>
        <div><div class="badge-feat-label" data-i18n="feat.warranty">20 Yil Kafolat</div><div class="badge-feat-sub" data-i18n="feat.warranty.sub">Rasmiy hujjat bilan</div></div>
      </div>
      <div class="badge-feature">
        <div class="badge-feat-icon"><i class="fas fa-snowflake"></i></div>
        <div><div class="badge-feat-label" data-i18n="feat.temp">−30°C / +60°C</div><div class="badge-feat-sub" data-i18n="feat.temp.sub">Iqlim bardosh</div></div>
      </div>
      <div class="badge-feature">
        <div class="badge-feat-icon"><i class="fas fa-fire-alt"></i></div>
        <div><div class="badge-feat-label" data-i18n="feat.fire">Yong'inga bardosh</div><div class="badge-feat-sub" data-i18n="feat.fire.sub">B1 sinf</div></div>
      </div>
      <div class="badge-feature">
        <div class="badge-feat-icon"><i class="fas fa-leaf"></i></div>
        <div><div class="badge-feat-label" data-i18n="feat.eco">Ekologik toza</div><div class="badge-feat-sub" data-i18n="feat.eco.sub">SGS sertifikat</div></div>
      </div>
      <div class="badge-feature">
        <div class="badge-feat-icon"><i class="fas fa-ruler-combined"></i></div>
        <div><div class="badge-feat-label" data-i18n="feat.size">Istalgan o'lcham</div><div class="badge-feat-sub" data-i18n="feat.size.sub">Maxsus buyurtma</div></div>
      </div>
      <div class="badge-feature">
        <div class="badge-feat-icon"><i class="fas fa-tools"></i></div>
        <div><div class="badge-feat-label" data-i18n="feat.install">Bepul o'rnatish</div><div class="badge-feat-sub" data-i18n="feat.install.sub">50 m² dan yuqori</div></div>
      </div>
    </div>

    <!-- DELIVERY -->
    <div class="delivery-info fade-in delay-4">
      <div class="delivery-row">
        <div class="delivery-icon"><i class="fas fa-truck"></i></div>
        <div class="delivery-text"><strong data-i18n="del.free">Bepul yetkazib berish</strong> — <span data-i18n="del.free.sub">50 m² dan yuqori buyurtmada</span></div>
      </div>
      <div class="delivery-sep"></div>
      <div class="delivery-row">
        <div class="delivery-icon"><i class="fas fa-calendar-check"></i></div>
        <div class="delivery-text"><strong data-i18n="del.time">Ishlab chiqarish muddati:</strong> <span data-i18n="del.time.val">buyurtma sanasidan 5−7 ish kuni</span></div>
      </div>
      <div class="delivery-sep"></div>
      <div class="delivery-row">
        <div class="delivery-icon"><i class="fas fa-hand-holding-usd"></i></div>
        <div class="delivery-text"><strong data-i18n="del.pay">To'lov:</strong> <span data-i18n="del.pay.val">naqd, karta yoki muddatli to'lov (6−12 oy)</span></div>
      </div>
      <div class="delivery-sep"></div>
      <div class="delivery-row">
        <div class="delivery-icon"><i class="fas fa-undo"></i></div>
        <div class="delivery-text"><strong data-i18n="del.return">Qaytarish:</strong> <span data-i18n="del.return.val">14 kun ichida, foydalanilmagan holda</span></div>
      </div>
    </div>
  </div>
</div>

<!-- TABS SECTION -->
<div class="tabs-section">
  <div class="tabs-nav">
    <button class="tab-btn active" data-tab="description" data-i18n="tab.desc">Tavsif</button>
    <button class="tab-btn" data-tab="specs" data-i18n="tab.specs">Texnik xususiyatlar</button>
    <button class="tab-btn" data-tab="reviews"><span data-i18n="tab.reviews">Sharhlar</span> <span style="color:var(--gold)">({{ $reviews->count() }})</span></button>
  </div>

  <!-- DESCRIPTION TAB -->
  <div class="tab-panel active" id="tab-description">
    <div class="desc-grid">
      <div class="desc-text">
        <h3 data-name-uz="{{ $product->name_uz }} haqida"
          data-name-ru="{{ ($product->name_ru ?: $product->name_uz) }} haqida"
          data-name-en="About {{ $product->name_en ?: $product->name_uz }}">{{ $product->name_uz }} haqida</h3>
        @if($product->desc_uz)
        <p data-desc-uz="{{ $product->desc_uz }}"
           data-desc-ru="{{ $product->desc_ru ?: $product->desc_uz }}"
           data-desc-en="{{ $product->desc_en ?: $product->desc_uz }}">{{ $product->desc_uz }}</p>
        @endif
        <h3>Asosiy afzalliklar</h3>
        <ul class="highlight-list">
          <li>Issiqlik yo'qotishini kamaytiradi — elektr va gaz uchun sarfni tejaydi</li>
          <li>Suv o'tkazmaydigan tuzilma — namlik va qoliplarga qarshilik</li>
          <li>Yengil og'irligi — binoga qo'shimcha yuk tushirmaydi</li>
          <li>Tez va oson montaj — maxsus asbobsiz o'rnatish mumkin</li>
          <li>Ekologik toza material — sertifikatlangan</li>
        </ul>
      </div>
      <div class="desc-aside">
        @if(!empty($product->specs))
        <div class="aside-card">
          <h4>Asosiy ko'rsatkichlar</h4>
          @foreach($product->specs as $spec)
          <div class="spec-row">
            <span class="spec-key">{{ $spec['label_uz'] ?? $spec['label_ru'] ?? '' }}</span>
            <span class="spec-val">{{ $spec['value'] }}</span>
          </div>
          @endforeach
        </div>
        @endif
        <div class="aside-card">
          <h4>Sertifikatlar</h4>
          <div class="spec-row"><span class="spec-key">SGS</span><span class="spec-val" style="color:#2ecc71"><i class="fas fa-check-circle"></i> Tasdiqlangan</span></div>
          <div class="spec-row"><span class="spec-key">ISO 9001</span><span class="spec-val" style="color:#2ecc71"><i class="fas fa-check-circle"></i> Tasdiqlangan</span></div>
          <div class="spec-row"><span class="spec-key">O'zbekiston standarti</span><span class="spec-val" style="color:#2ecc71"><i class="fas fa-check-circle"></i> O'ST</span></div>
        </div>
      </div>
    </div>
  </div>

  <!-- SPECS TAB -->
  <div class="tab-panel" id="tab-specs">
    <div class="specs-grid">
      @if(!empty($product->specs))
      <div class="specs-section">
        <h3>Texnik xususiyatlar</h3>
        <div class="spec-table">
          @foreach($product->specs as $spec)
          <div class="spec-row-full">
            <span class="spec-key">{{ $spec['label_uz'] ?? $spec['label_ru'] ?? '' }}</span>
            <span class="spec-val">{{ $spec['value'] }}</span>
          </div>
          @endforeach
        </div>
      </div>
      @endif
      <div class="specs-section">
        <h3>Xavfsizlik & Sertifikatlar</h3>
        <div class="spec-table">
          <div class="spec-row-full"><span class="spec-key">Yong'inga bardoshlik</span><span class="spec-val">B1 sinf</span></div>
          <div class="spec-row-full"><span class="spec-key">Ekologik sinf</span><span class="spec-val">E1</span></div>
          <div class="spec-row-full"><span class="spec-key">Sertifikatlar</span><span class="spec-val">SGS, ISO 9001</span></div>
          <div class="spec-row-full"><span class="spec-key">Ishlab chiqarilgan joy</span><span class="spec-val">Toshkent, O'zbekiston</span></div>
        </div>
      </div>
      <div class="specs-section">
        <h3>Montaj & Xizmat</h3>
        <div class="spec-table">
          <div class="spec-row-full"><span class="spec-key">Montaj usuli</span><span class="spec-val">Mexanik + yopishqoq</span></div>
          <div class="spec-row-full"><span class="spec-key">Maxsus asbob</span><span class="spec-val">Talab etilmaydi</span></div>
          <div class="spec-row-full"><span class="spec-key">Kafolat muddati</span><span class="spec-val">20 yil</span></div>
          <div class="spec-row-full"><span class="spec-key">Parvarish</span><span class="spec-val">Sovuq suv bilan yuvish</span></div>
        </div>
      </div>
    </div>
  </div>

  <!-- REVIEWS TAB -->
  <div class="tab-panel" id="tab-reviews">

    {{-- Success message after submit --}}
    @if(session('review_sent'))
    <div style="background:rgba(46,204,113,0.1);border:1px solid #2ecc71;color:#2ecc71;padding:14px 20px;margin-bottom:24px;font-size:13px;display:flex;align-items:center;gap:10px">
      <i class="fas fa-check-circle"></i> Sharhingiz qabul qilindi! Moderatsiyadan o'tgach ko'rinadi.
    </div>
    @endif

    <div class="reviews-header">
      <div class="rating-big">
        <div class="num">{{ number_format($product->rating, 1) }}</div>
        <div style="color:var(--gold);font-size:18px;letter-spacing:3px;margin-top:4px">{{ $stars }}</div>
        <div class="label">{{ $reviews->count() }} <span data-i18n="review">sharh</span></div>
      </div>
      <div style="margin-left:auto">
        <button class="btn-order" style="min-width:180px" onclick="openReviewModal()">
          <i class="fas fa-pen"></i><span data-i18n="review.write">Sharh yozish</span>
        </button>
      </div>
    </div>

    {{-- Approved reviews list --}}
    @if($reviews->isNotEmpty())
    <div class="reviews-grid">
      @foreach($reviews as $review)
      <div class="review-card">
        <div class="review-top">
          <div class="reviewer">
            <div class="reviewer-avatar" style="width:44px;height:44px;background:rgba(201,168,76,0.15);border:1px solid rgba(201,168,76,0.3);display:flex;align-items:center;justify-content:center;font-weight:700;color:var(--gold);font-size:16px;flex-shrink:0">
              {{ mb_strtoupper(mb_substr($review->reviewer_name, 0, 1)) }}
            </div>
            <div>
              <div class="reviewer-name">{{ $review->reviewer_name }}</div>
              <div class="reviewer-date">{{ $review->created_at->format('d M Y') }}</div>
            </div>
          </div>
          <div class="review-stars">{{ $review->stars }}</div>
        </div>
        <div class="review-text">{{ $review->body }}</div>
      </div>
      @endforeach
    </div>
    @else
    <div style="padding:40px;text-align:center;color:var(--text-dim);font-size:14px">
      <i class="fas fa-comment-slash" style="font-size:32px;display:block;margin-bottom:12px;opacity:0.4"></i>
      <span data-i18n="review.empty">Hali tasdiqlangan sharhlar yo'q. Birinchi bo'lib sharh qoldiring!</span>
    </div>
    @endif

  </div>

</div>

<!-- RELATED PRODUCTS -->
<div class="related-section">
  <div class="related-header">
    <div style="font-size:10px;letter-spacing:3px;text-transform:uppercase;color:var(--gold);margin-bottom:10px" data-i18n="related.label">O'xshash mahsulotlar</div>
    <h2 data-i18n="related.title">Sizga mos <em>bo'lishi mumkin</em></h2>
  </div>
  <div class="related-grid">
    @forelse($related as $r)
    <div class="related-card" onclick="location.href='{{ route('product.show', $r->slug) }}'">
      <div class="related-img"><img src="{{ $r->first_image }}" alt="{{ $r->name_uz }}" loading="lazy"></div>
      <div class="related-body">
        <div class="related-cat">{{ $r->category_label }}</div>
        <div class="related-name">{{ $r->name_uz }}</div>
        <div class="related-bottom">
          <div>
            <div class="related-price">{{ number_format($r->price, 0, '.', ',') }}</div>
            <div class="related-unit">UZS / {{ $r->unit_label }}</div>
          </div>
          <div class="related-arrow"><i class="fas fa-arrow-right"></i></div>
        </div>
      </div>
    </div>
    @empty
    <p style="color:var(--dim)">O'xshash mahsulotlar topilmadi</p>
    @endforelse
  </div>
</div>

<!-- REVIEW MODAL -->
<div id="reviewModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.85);z-index:9999;align-items:center;justify-content:center;padding:16px">
  <div style="background:#111;border:1px solid rgba(201,168,76,0.3);width:100%;max-width:520px;max-height:90vh;overflow-y:auto;position:relative">
    <button onclick="closeReviewModal()" style="position:absolute;top:16px;right:16px;background:none;border:none;color:#888;font-size:20px;cursor:pointer;z-index:1;line-height:1">&#x2715;</button>
    <div style="padding:36px">
      <div style="font-size:10px;letter-spacing:3px;color:#C9A84C;text-transform:uppercase;margin-bottom:8px" data-i18n="review.modal.label">Sharh qoldirish</div>
      <h2 style="color:#F5F0E8;font-size:18px;margin-bottom:24px;border-bottom:1px solid rgba(201,168,76,0.1);padding-bottom:16px">{{ $product->name_uz }}</h2>

      @if(session('review_sent'))
      <div style="background:rgba(46,204,113,0.1);border:1px solid #2ecc71;color:#2ecc71;padding:16px;text-align:center">
        <i class="fas fa-check-circle" style="font-size:28px;display:block;margin-bottom:8px"></i>
        <span data-i18n="review.sent">Sharhingiz qabul qilindi! Moderatsiyadan o'tgach ko'rinadi.</span>
      </div>
      @else
      <form method="POST" action="{{ route('review.store', $product->slug) }}">
        @csrf
        <div style="margin-bottom:16px">
          <label style="display:block;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#888;margin-bottom:8px" data-i18n="review.name.label">Ismingiz *</label>
          <input type="text" name="reviewer_name" value="{{ old('reviewer_name') }}" required maxlength="100"
            placeholder="Ism Familiya"
            style="width:100%;background:#181818;border:1px solid rgba(201,168,76,0.2);color:#F5F0E8;padding:12px 16px;font-size:14px;font-family:inherit;outline:none">
          @error('reviewer_name') <div style="color:#e74c3c;font-size:12px;margin-top:4px">{{ $message }}</div> @enderror
        </div>
        <div style="margin-bottom:16px">
          <label style="display:block;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#888;margin-bottom:10px" data-i18n="review.rating.label">Baho *</label>
          <div id="starPicker" style="display:flex;gap:4px;font-size:32px;cursor:pointer;user-select:none;line-height:1">
            <span style="color:rgba(201,168,76,0.3);transition:color .15s">★</span>
            <span style="color:rgba(201,168,76,0.3);transition:color .15s">★</span>
            <span style="color:rgba(201,168,76,0.3);transition:color .15s">★</span>
            <span style="color:rgba(201,168,76,0.3);transition:color .15s">★</span>
            <span style="color:rgba(201,168,76,0.3);transition:color .15s">★</span>
          </div>
          <input type="hidden" name="rating" id="ratingInput" value="{{ old('rating', 5) }}">
          @error('rating') <div style="color:#e74c3c;font-size:12px;margin-top:4px">{{ $message }}</div> @enderror
        </div>
        <div style="margin-bottom:24px">
          <label style="display:block;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#888;margin-bottom:8px" data-i18n="review.body.label">Sharhingiz *</label>
          <textarea name="body" required minlength="10" maxlength="1000" rows="4"
            placeholder="Mahsulot haqida fikringizni yozing..."
            style="width:100%;background:#181818;border:1px solid rgba(201,168,76,0.2);color:#F5F0E8;padding:12px 16px;font-size:14px;font-family:inherit;outline:none;resize:vertical">{{ old('body') }}</textarea>
          @error('body') <div style="color:#e74c3c;font-size:12px;margin-top:4px">{{ $message }}</div> @enderror
        </div>
        <button type="submit" style="width:100%;background:#C9A84C;color:#080808;border:none;padding:16px;font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;cursor:pointer;font-family:inherit">
          <i class="fas fa-paper-plane"></i> <span data-i18n="review.submit">Sharh yuborish</span>
        </button>
      </form>
      @endif
    </div>
  </div>
</div>

<!-- ORDER MODAL -->
<div id="orderModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.85);z-index:9999;align-items:center;justify-content:center;padding:16px">
  <div style="background:#111;border:1px solid rgba(201,168,76,0.3);width:100%;max-width:480px;max-height:90vh;overflow-y:auto;position:relative">
    <button onclick="closeOrderModal()" style="position:absolute;top:16px;right:16px;background:none;border:none;color:#888;font-size:20px;cursor:pointer;z-index:1">✕</button>

    {{-- Step 1: Form --}}
    <div id="orderStep1" style="padding:36px">
      <div style="font-size:10px;letter-spacing:3px;color:#C9A84C;text-transform:uppercase;margin-bottom:8px" data-i18n="order.title">Buyurtma berish</div>
      <h2 style="color:#F5F0E8;font-size:20px;margin-bottom:4px" id="modalProductName">{{ $product->name_uz }}</h2>
      <div id="modalSummary" style="font-size:13px;color:#888;margin-bottom:24px;border-bottom:1px solid rgba(201,168,76,0.1);padding-bottom:16px"></div>

      <div style="margin-bottom:16px">
        <label style="display:block;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#888;margin-bottom:8px" data-i18n="order.name">Ism Familiya *</label>
        <input id="orderName" type="text" data-i18n-placeholder="order.name.ph" placeholder="Masalan: Azizbek Karimov"
          style="width:100%;background:#181818;border:1px solid rgba(201,168,76,0.2);color:#F5F0E8;padding:14px 16px;font-size:14px;font-family:inherit;outline:none;transition:border-color .3s"
          oninput="validateOrderForm()">
      </div>
      <div style="margin-bottom:24px">
        <label style="display:block;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#888;margin-bottom:8px" data-i18n="order.phone">Telefon raqam *</label>
        <input id="orderPhone" type="tel" data-i18n-placeholder="order.phone.ph" placeholder="+998 XX XXX XX XX"
          style="width:100%;background:#181818;border:1px solid rgba(201,168,76,0.2);color:#F5F0E8;padding:14px 16px;font-size:14px;font-family:inherit;outline:none;transition:border-color .3s"
          oninput="validateOrderForm()">
      </div>
      <div id="orderError" style="display:none;color:#e74c3c;font-size:13px;margin-bottom:12px"></div>
      <button id="orderSubmitBtn" onclick="submitOrder()"
        style="width:100%;background:#C9A84C;color:#080808;border:none;padding:16px;font-size:12px;font-weight:700;letter-spacing:2px;text-transform:uppercase;cursor:pointer;font-family:inherit;transition:background .3s"
        disabled>
        <span id="orderBtnText"><i class="fas fa-shopping-cart"></i> <span data-i18n="order.submit">Buyurtma berish</span></span>
      </button>
      <p style="font-size:11px;color:#555;text-align:center;margin-top:12px" data-i18n="order.note">Buyurtma berib, siz bilan bog'lanamiz</p>
    </div>

    {{-- Step 2: Success --}}
    <div id="orderStep2" style="display:none;padding:48px 36px;text-align:center">
      <div style="width:72px;height:72px;background:rgba(46,204,113,0.1);border:2px solid #2ecc71;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px">
        <i class="fas fa-check" style="color:#2ecc71;font-size:28px"></i>
      </div>
      <h2 style="color:#F5F0E8;font-size:22px;margin-bottom:12px" data-i18n="order.success.title">Buyurtma qabul qilindi!</h2>
      <p id="orderSuccessMsg" style="color:#888;font-size:14px;line-height:1.6;margin-bottom:8px"></p>
      <p style="color:#C9A84C;font-size:13px;margin-bottom:32px">Buyurtma raqami: <strong id="orderIdDisplay">#—</strong></p>
      <button onclick="closeOrderModal()"
        style="background:transparent;border:1px solid rgba(201,168,76,0.3);color:#C9A84C;padding:12px 32px;font-size:11px;letter-spacing:2px;text-transform:uppercase;cursor:pointer;font-family:inherit"
        data-i18n="order.close">
        Yopish
      </button>
    </div>
  </div>
</div>

<!-- PRODUCT DATA -->
<script>
  window.PRODUCT = {!! json_encode([
    'id'       => $product->id,
    'name'     => $product->name_uz,
    'price'    => $product->price,
    'unit'     => $product->unit_label,
    'csrf'     => csrf_token(),
    'orderUrl' => route('order.store'),
  ]) !!};
</script>

@push('scripts')
<script>
// ===== REVIEW MODAL =====
function openReviewModal(){
  const m = document.getElementById('reviewModal');
  if(m){ m.style.display='flex'; document.body.style.overflow='hidden'; }
}
function closeReviewModal(){
  const m = document.getElementById('reviewModal');
  if(m){ m.style.display='none'; document.body.style.overflow=''; }
}
document.getElementById('reviewModal')?.addEventListener('click', function(e){
  if(e.target===this) closeReviewModal();
});
@if(session('review_sent')) openReviewModal(); @endif

// ===== STAR PICKER =====
(function(){
  const stars = document.querySelectorAll('#starPicker span');
  const input = document.getElementById('ratingInput');
  if(!stars.length || !input) return;
  function paint(n){ stars.forEach((s,i) => s.style.color = i < n ? '#C9A84C' : 'rgba(201,168,76,0.3)'); }
  stars.forEach((s,i) => {
    s.addEventListener('click', () => { input.value = i+1; paint(i+1); });
    s.addEventListener('mouseenter', () => paint(i+1));
    s.addEventListener('mouseleave', () => paint(parseInt(input.value)||5));
  });
  paint(parseInt(input.value)||5);
})();
</script>
@endpush

@endsection
