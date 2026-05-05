@extends('layouts.app')

@section('title', 'Mega Stroy Building | Zamonaviy Fasad Dekor')
@section('meta_description', 'Mega Stroy Building — 2013-yildan buyon O\'zbekistondagi yetakchi fasad dekor ishlab chiqaruvchisi. Eron texnologiyalari asosida ekologik toza mahsulotlar.')

@section('content')

<!-- HERO -->
<section class="hero" id="hero">
  <div class="hero-bg"></div>
  <div class="hero-content">
    <div class="hero-eyebrow"><div class="eyebrow-line"></div><span data-i18n="hero.eyebrow">Mega Stroy Building — Zamonaviy uylar uchun yangi avlod dekorlari</span></div>
    <h1 data-i18n="hero.h1">Sifatli qurilish uchun<br><em>To'g'ri tanlov</em><br>biz esa sizga to'g'ri yo'l ko'rsatamiz</h1>
    <p data-i18n="hero.sub">PREMIUM fasad fibrosement panellar — zavoddan to sizning uyingizgacha. Har bir mahsulot sifat va go'zallik kafolati bilan.</p>
    <div class="hero-btns">
      <a href="#products" class="btn-primary"><span data-i18n="hero.btn1">Katalogni ko'rish</span><i class="fas fa-arrow-right"></i></a>
      <a href="#contact" class="btn-outline"><i class="fas fa-phone"></i> <span data-i18n="hero.btn2">Bepul maslahat</span></a>
    </div>
  </div>
  <div class="hero-stats">
    <div class="hero-stat"><span class="num">10 000<span style="font-size:24px">+</span></span><span class="lbl" data-i18n="stat.projects">Mijoz</span></div>
    <div class="hero-divider"></div>
    <div class="hero-stat"><span class="num">13</span><span class="lbl" data-i18n="stat.warranty">Yillik tajriba</span></div>
    <div class="hero-divider"></div>
    <div class="hero-stat"><span class="num">20<span style="font-size:24px">+</span></span><span class="lbl" data-i18n="stat.products">Kafolat yil</span></div>
  </div>
</section>

<!-- MARQUEE -->
<div class="marquee-band">
  <div class="marquee-track">
    <span data-i18n="marq.1">Premium Sifat</span><span class="dot">◆</span>
    <span data-i18n="marq.2">Zavoddan Bevosita</span><span class="dot">◆</span>
    <span data-i18n="marq.3">20 Yil Kafolat</span><span class="dot">◆</span>
    <span data-i18n="marq.4">Hamyonbop Narx</span><span class="dot">◆</span>
    <span data-i18n="marq.5">Eron Texnologiyasi</span><span class="dot">◆</span>
    <span data-i18n="marq.6">Namlikka Chidamli</span><span class="dot">◆</span>
    <span data-i18n="marq.1">Premium Sifat</span><span class="dot">◆</span>
    <span data-i18n="marq.2">Zavoddan Bevosita</span><span class="dot">◆</span>
    <span data-i18n="marq.3">20 Yil Kafolat</span><span class="dot">◆</span>
    <span data-i18n="marq.4">Hamyonbop Narx</span><span class="dot">◆</span>
    <span data-i18n="marq.5">10 000+ Mijoz</span><span class="dot">◆</span>
    <span data-i18n="marq.6">Namlikka Chidamli</span><span class="dot">◆</span>
  </div>
</div>

<!-- ABOUT -->
<section id="about" class="about">
  <div class="about-visual reveal-left">
    <img class="about-img-main" src="{{ asset('images/about1.jpg') }}?q=80&w=900" alt="Mega Stroy zavodi">
    <img class="about-img-accent" src="{{ asset('images/about2.jpg') }}?q=80&w=600" alt="Premium bino">
    <div class="about-badge"><span class="big">13</span><span class="small" data-i18n="about.badge">Yillik tajriba</span></div>
  </div>
  <div class="about-text reveal-right">
    <div class="section-label"><span data-i18n="about.label">Biz haqimizda</span><div class="section-label-line"></div></div>
    <h2 data-i18n="about.h2">Nega aynan <em>Mega Stroy?</em></h2>
    <p data-i18n="about.p">2013-yilda mustahkam shifer ishlab chiqarishdan boshlangan yo'limiz bugun zamonaviy <strong style="color:var(--gold)">FASAD DEKOR</strong> sohasida yetakchi brendga aylandi. 2026-yildan Eron texnologiyalari va muhandislari bilan yangi sifat bosqichi.</p>
    <div class="feature-list">
      <div class="feat-item">
        <div class="feat-icon"><i class="fas fa-leaf"></i></div>
        <div class="feat-text">
          <h4 data-i18n="feat1.title">100% Ekologik Toza Mahsulot</h4>
          <p data-i18n="feat1.p">Asbest ishlatilmaydi. PM 2,5 zarralar hosil qilmaydi. Chet el bo'yoqlari va zamonaviy dekordan foydalaniladi.</p>
        </div>
      </div>
      <div class="feat-item">
        <div class="feat-icon"><i class="fas fa-snowflake"></i></div>
        <div class="feat-text">
          <h4 data-i18n="feat2.title">Issiqqa va Sovuqqa Chidamli</h4>
          <p data-i18n="feat2.p">O'zbekiston iqlimiga moslashtirilgan: yoz issig'idan qish sovug'iga bardosh beradi.</p>
        </div>
      </div>
      <div class="feat-item">
        <div class="feat-icon"><i class="fas fa-users"></i></div>
        <div class="feat-text">
          <h4 data-i18n="feat3.title">100 Nafar Malakali Jamoa</h4>
          <p data-i18n="feat3.p">Xorijiy tajriba asosida ishlaydigan sertifikatlangan mutaxassislar. Har bir loyiha mas'uliyat bilan.</p>
        </div>
      </div>
    </div>
    <div style="display:flex;gap:16px;flex-wrap:wrap">
      <a href="#contact" class="btn-primary"><span data-i18n="about.cta">Bepul maslahat olish</span><i class="fas fa-arrow-right"></i></a>
      <a href="{{ url('/about') }}" class="btn-outline"><span data-i18n="about.more">Batafsil o'qish</span><i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
</section>

<!-- COUNTERS -->
<div class="counters-section">
  <div class="counters-inner">
    <div class="counter-box reveal delay-1"><span class="counter-num" data-target="10000">0</span><span class="counter-suffix">+</span><span class="counter-label" data-i18n="cnt.1">Muvaffaqiyatli Loyihalar</span></div>
    <div class="counter-box reveal delay-2"><span class="counter-num" data-target="13">0</span><span class="counter-suffix"> yil</span><span class="counter-label" data-i18n="cnt.2">Bozordagi Tajriba</span></div>
    <div class="counter-box reveal delay-3"><span class="counter-num" data-target="100">0</span><span class="counter-suffix">+</span><span class="counter-label" data-i18n="cnt.3">Malakali xodim</span></div>
    <div class="counter-box reveal delay-4"><span class="counter-num" data-target="100">0</span><span class="counter-suffix">%</span><span class="counter-label" data-i18n="cnt.4">Mijozlar Mamnuniyati</span></div>
  </div>
</div>

<!-- PRODUCTS -->
<section id="products">
  <div class="products-section">
    <div class="section-header reveal">
      <div>
        <div class="section-label" style="margin-bottom:12px"><span data-i18n="prod.label">Katalog</span><div class="section-label-line"></div></div>
        <h2 data-i18n="prod.h2">Bizning <em>Mahsulotlar</em></h2>
      </div>
      <p data-i18n="prod.sub">Har bir mahsulot sifat standartlaridan o'tgan va O'zbekiston iqlimiga moslashtirilgan.</p>
    </div>
    <div class="filter-tabs reveal">
      <button class="ftab active" data-filter="all" data-i18n="filter.all">Hammasi</button>
      <button class="ftab" data-filter="panel" data-i18n="filter.panel">Panellar</button>
      <button class="ftab" data-filter="karniz" data-i18n="filter.karniz">Karnizlar</button>
      <button class="ftab" data-filter="ustun" data-i18n="filter.ustun">Ustunlar</button>
      <button class="ftab" data-filter="dekor" data-i18n="filter.dekor">Dekor</button>
    </div>
    <div class="shop-grid">
      @forelse($products as $i => $p)
      @php
        $delays   = ['delay-1','delay-2','delay-3','delay-4'];
        $delay    = $delays[$i % 4];
        $badgeClass = match($p->badge) {
          'top','popular' => 'badge-hit',
          'new'           => 'badge-new',
          'sale'          => 'badge-sale',
          default         => '',
        };
        $stars    = str_repeat('★', round($p->rating)) . str_repeat('☆', 5 - round($p->rating));
        $catUz    = $p->categoryRel?->name_uz ?? ucfirst($p->category ?? '');
        $catRu    = $p->categoryRel?->name_ru ?? $catUz;
        $catEn    = $p->categoryRel?->name_en ?? $catUz;
        $revCount = $p->reviews_count ?? 0;
      @endphp
      <div class="shop-card reveal {{ $delay }}" data-cat="{{ $p->category }}">
        <div class="shop-img-wrap">
          @if($p->badge)
          <span class="shop-badge {{ $badgeClass }}" data-i18n="badge.{{ $p->badge }}">{{ strtoupper($p->badge) }}</span>
          @endif
          <img src="{{ $p->first_image }}" alt="{{ $p->name_uz }}" loading="lazy">
        </div>
        <div class="shop-body">
          <div class="shop-cat"
            data-cat-uz="{{ $catUz }}"
            data-cat-ru="{{ $catRu }}"
            data-cat-en="{{ $catEn }}">{{ $catUz }}</div>
          <div class="shop-name"
            data-name-uz="{{ $p->name_uz }}"
            data-name-ru="{{ $p->name_ru ?: $p->name_uz }}"
            data-name-en="{{ $p->name_en ?: $p->name_uz }}">{{ $p->name_uz }}</div>
          <div class="shop-desc"
            data-desc-uz="{{ Str::limit($p->desc_uz, 90) }}"
            data-desc-ru="{{ Str::limit($p->desc_ru ?: $p->desc_uz, 90) }}"
            data-desc-en="{{ Str::limit($p->desc_en ?: $p->desc_uz, 90) }}">{{ Str::limit($p->desc_uz, 90) }}</div>
          <div class="shop-rating">
            <span class="stars">{{ $stars }}</span>
            <span class="rating-count">({{ $revCount }} <span data-i18n="review">sharh</span>)</span>
          </div>
          <div class="shop-price-row">
            <div>
              <div class="shop-price">{{ number_format($p->price, 0, '.', ',') }}<span class="unit"> UZS / {{ $p->unit_label }}</span></div>
              @if($p->old_price)
              <div class="shop-price-old">{{ number_format($p->old_price, 0, '.', ',') }} UZS</div>
              @endif
            </div>
          </div>
          <div class="shop-actions">
            <a href="{{ route('product.show', $p->slug) }}" class="btn-cart"><i class="fas fa-shopping-cart"></i> <span data-i18n="order">Buyurtma</span></a>
            <a href="{{ route('product.show', $p->slug) }}" class="btn-quick"><i class="fas fa-eye"></i></a>
          </div>
        </div>
        <div class="shop-meta">
          @if($p->in_stock)
            <span class="shop-stock" data-i18n="instock">Omborda bor</span>
          @else
            <span class="shop-stock low">Tugagan</span>
          @endif
          @if($p->sku)<span class="shop-sku">SKU: {{ $p->sku }}</span>@endif
        </div>
      </div>
      @empty
      <div style="grid-column:1/-1;text-align:center;padding:60px;color:var(--dim)">Mahsulotlar topilmadi</div>
      @endforelse
    </div>
    <div style="text-align:center;margin-top:40px" class="reveal">
      <a href="{{ route('catalog') }}" class="btn-outline" style="display:inline-flex;align-items:center;gap:10px">
        <span data-i18n="prod.all">Barcha mahsulotlar</span> <i class="fas fa-arrow-right"></i>
      </a>
    </div>
  </div>
</section>

<!-- PROCESS -->
<section id="process" class="process-section">
  <div class="process-inner">
    <div class="process-header reveal">
      <div class="section-label" style="justify-content:center;margin-bottom:16px"><span data-i18n="proc.label">Qanday ishlaydi</span></div>
      <h2 data-i18n="proc.h2">Buyurtmadan <em>O'rnatishgacha</em></h2>
      <p data-i18n="proc.sub">Oddiy va tez — 4 qadamda ideal natija</p>
    </div>
    <div class="process-steps">
      <div class="step reveal delay-1"><div class="step-num">01</div><h4 data-i18n="step1.t">Bepul Maslahat</h4><p data-i18n="step1.p">Mutaxassislarimiz bilan bog'laning. Uyingiz uchun eng mos variantni tanlaymiz.</p></div>
      <div class="step reveal delay-2"><div class="step-num">02</div><h4 data-i18n="step2.t">O'lchov & Loyiha</h4><p data-i18n="step2.p">Sertifikatlangan ustalarmiz uyingizga kelib o'lchov oladi va 3D loyiha tayyorlaydi.</p></div>
      <div class="step reveal delay-3"><div class="step-num">03</div><h4 data-i18n="step3.t">Ishlab Chiqarish</h4><p data-i18n="step3.p">Zavodimizdagi zamonaviy Eron uskunalari bilan aniq o'lchamda mahsulotingiz tayyorlanadi.</p></div>
      <div class="step reveal delay-4"><div class="step-num">04</div><h4 data-i18n="step4.t">O'rnatish & Kafolat</h4><p data-i18n="step4.p">Professional jamoa o'rnatadi. 20 yillik kafolat hujjati topshiriladi.</p></div>
    </div>
  </div>
</section>

<!-- GALLERY -->
<section class="gallery-section">
  <div class="gallery-title reveal">
    <div class="section-label" style="margin-bottom:12px"><span data-i18n="gal.label">Tugallangan loyihalar</span><div class="section-label-line"></div></div>
    <h2 data-i18n="gal.h2">Bizning <em>Ishlarimiz</em></h2>
  </div>
  <div class="gallery-strip">
    @forelse($works as $w)
    <div class="gallery-item">
      <img src="{{ $w->image_url }}" alt="{{ $w->caption_uz }}" loading="lazy">
      @if($w->caption_uz)<div class="gallery-caption" data-caption-uz="{{ $w->caption_uz }}" data-caption-ru="{{ $w->caption_ru }}" data-caption-en="{{ $w->caption_en }}">{{ $w->caption_uz }}</div>@endif
    </div>
    @empty
    <div class="gallery-item"><img src="{{ asset('images/work1.jpg') }}" alt="Loyiha 1"><div class="gallery-caption">Toshkent, 2024 — Premium Villa</div></div>
    <div class="gallery-item"><img src="{{ asset('images/work2.jpg') }}" alt="Loyiha 2"><div class="gallery-caption">Samarqand, 2024 — Biznes Markaz</div></div>
    <div class="gallery-item"><img src="{{ asset('images/work3.jpg') }}" alt="Loyiha 3"><div class="gallery-caption">Toshkent, 2023 — Ko'p Qavatli Bino</div></div>
    <div class="gallery-item"><img src="{{ asset('images/work4.jpg') }}" alt="Loyiha 4"><div class="gallery-caption">Namangan, 2023 — Cottage Majmuasi</div></div>
    <div class="gallery-item"><img src="{{ asset('images/work5.jpg') }}" alt="Loyiha 5"><div class="gallery-caption">Buxoro, 2024 — Mehmonxona</div></div>
    @endforelse
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="testimonials">
  <div class="test-inner">
    <div class="test-header reveal">
      <div class="section-label" style="margin-bottom:12px"><span data-i18n="test.label">Mijozlar fikri</span><div class="section-label-line"></div></div>
      <h2 data-i18n="test.h2">Ular nima <em>deyishadi?</em></h2>
    </div>
    <div class="test-grid">
      <div class="test-card reveal delay-1"><div class="test-stars">★★★★★</div><p class="test-quote" data-i18n="t1.q">"Uyimizning fasadi butunlay o'zgardi. Sifat va xizmat darajasi kutganimdan ham yuqori bo'ldi."</p><div class="test-author"><img class="test-avatar" src="https://i.pravatar.cc/150?img=12" alt="Azizbek"><div class="test-info"><h5>Azizbek Karimov</h5><span>Toshkent, Premium Villa</span></div></div></div>
      <div class="test-card reveal delay-2"><div class="test-stars">★★★★★</div><p class="test-quote" data-i18n="t2.q">"Zavodga kelganimda mahsulotlarning sifati meni hayratda qoldirdi. O'rnatish jarayoni ham tez bo'ldi."</p><div class="test-author"><img class="test-avatar" src="https://i.pravatar.cc/150?img=25" alt="Nodira"><div class="test-info"><h5>Nodira Yusupova</h5><span>Samarqand, Kottej</span></div></div></div>
      <div class="test-card reveal delay-3"><div class="test-stars">★★★★★</div><p class="test-quote" data-i18n="t3.q">"Biznes markazimiz uchun eng yaxshi tanlov bo'ldi. 3 yildan beri hech qanday muammo yo'q."</p><div class="test-author"><img class="test-avatar" src="https://i.pravatar.cc/150?img=68" alt="Jahongir"><div class="test-info"><h5>Jahongir Toshmatov</h5><span data-i18n="t3.role">Biznes markaz direktori</span></div></div></div>
    </div>
  </div>
</section>

<!-- CTA -->
<div class="cta-band reveal">
  <h2 data-i18n="cta.h2">Bugun <strong>bepul maslahat</strong> oling — uyingiz ertaga o'zgarsin!</h2>
  <div class="cta-actions">
    <a href="tel:+998974111151" class="btn-cta-dark"><i class="fas fa-phone"></i> <span data-i18n="cta.call">Qo'ng'iroq qiling</span></a>
    <a href="#contact" class="btn-cta-outline" data-i18n="cta.form">Forma to'ldirish</a>
  </div>
</div>

<!-- CONTACT -->
<section id="contact" class="contact-section">
  <div class="contact-grid">
    <div class="contact-info reveal-left">
      <div class="section-label" style="margin-bottom:16px"><span data-i18n="cont.label">Aloqa</span><div class="section-label-line"></div></div>
      <h2 data-i18n="cont.h2">Biz bilan <em>bog'laning</em></h2>
      <p data-i18n="cont.p">Bepul konsultatsiya uchun murojaat qiling.</p>
      <div class="contact-items">
        <div class="contact-item"><div class="contact-icon"><i class="fas fa-phone"></i></div><div class="contact-text"><span data-i18n="cont.phone">Telefon</span><a href="tel:+998974111151">+998 99 433 00 47</a></div></div>
        <div class="contact-item"><div class="contact-icon"><i class="fab fa-telegram"></i></div><div class="contact-text"><span>Telegram</span><a href="https://t.me/megastroyuz">@megastroyuz</a></div></div>
      </div>
    </div>
    <div class="contact-form reveal-right">
      <div class="section-label" style="margin-bottom:20px"><span data-i18n="form.label">So'rov yuborish</span><div class="section-label-line"></div></div>
      <div class="form-row">
        <div class="field"><label data-i18n="form.name">Ismingiz</label><input type="text" id="fname" data-i18n-placeholder="form.namePH" placeholder="Ism Familiya"></div>
        <div class="field"><label data-i18n="form.phone">Telefon</label><input type="tel" id="fphone" placeholder="+998 XX XXX XX XX"></div>
      </div>
      <div class="field">
        <label data-i18n="form.product">Mahsulot turi</label>
        <select id="fproduct">
          <option value="">— Tanlang —</option>
          @foreach($products as $p)
          <option value="{{ $p->name_uz }}">{{ $p->name_uz }}</option>
          @endforeach
        </select>
      </div>
      <div class="field"><label data-i18n="form.msg">Xabaringiz</label><textarea id="fmessage" rows="4" placeholder="Loyihangiz haqida..."></textarea></div>
      <button class="submit-btn" id="submitBtn"><span data-i18n="form.submit">So'rov yuborish</span> <i class="fas fa-paper-plane"></i></button>
      <p id="formSuccess" style="display:none;color:var(--gold);font-size:14px;margin-top:16px;padding:16px;border:1px solid var(--border)"><i class="fas fa-check-circle"></i> <span data-i18n="form.ok">So'rovingiz qabul qilindi! Tez orada aloqaga chiqamiz.</span></p>
    </div>
  </div>
</section>

@endsection
