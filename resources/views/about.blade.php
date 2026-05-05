@extends('layouts.app')

@section('title', 'Biz Haqimizda | Mega Stroy Building')
@section('meta_description', 'Mega Stroy Building — 2013-yildan buyon O\'zbekistondagi yetakchi fasad dekor ishlab chiqaruvchisi. Eron texnologiyalari, 100 nafar jamoa, ekologik toza mahsulotlar.')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('content')

<!-- ABOUT PAGE HERO -->
<section class="about-page-hero">
  <div class="about-page-hero-bg"></div>
  <div class="about-page-hero-content">
    <h1 data-i18n="ab.hero.h1">Mega Stroy <em>Building</em><br>haqida</h1>
    <p data-i18n="ab.hero.p">2013-yilda mustahkam shifer ishlab chiqarishdan boshlangan yo'limiz — bugun Markaziy Osiyoning yetakchi fasad dekor kompaniyasiga aylandi.</p>
  </div>
</section>

<!-- TIMELINE -->
<section class="timeline-section">
  <h2 data-i18n="ab.tl.h2">Bizning <em>Tarix</em></h2>
  <div class="timeline">

    <div class="timeline-item reveal">
      <div class="tl-body">
        <h3 data-i18n="ab.tl.1.h">Boshlanish — Shifer ishlab chiqarish</h3>
        <p data-i18n="ab.tl.1.p">Mega Stroy Building 2013-yilda o'z faoliyatini mustahkam va sifatli shifer ishlab chiqarish bilan boshladi. Dastlabki kunlardan boshlab kompaniya uchun sifat ustuvor qadriyat bo'ldi. Har bir bosqich biz uchun o'sish va rivojlanish maktabi bo'ldi.</p>
      </div>
      <div class="tl-year">
        <div class="tl-dot"></div>
        <span class="tl-year-label">2013</span>
      </div>
      <div class="tl-empty"></div>
    </div>

    <div class="timeline-item reveal">
      <div class="tl-empty"></div>
      <div class="tl-year">
        <div class="tl-dot"></div>
        <span class="tl-year-label">2015–2020</span>
      </div>
      <div class="tl-body">
        <h3 data-i18n="ab.tl.2.h">Bozorda ishonchli brend</h3>
        <p data-i18n="ab.tl.2.p">O'tgan yillar davomida kompaniyamiz qurilish materiallari bozorida ishonchli brendga aylanish uchun tinimsiz izlandi, tajriba orttirdi va mijozlar ishonchini qozondi. 10 000 dan ortiq muvaffaqiyatli loyiha amalga oshirildi.</p>
      </div>
    </div>

    <div class="timeline-item reveal">
      <div class="tl-body">
        <h3 data-i18n="ab.tl.3.h">FASAD DEKOR yo'nalishi</h3>
        <p data-i18n="ab.tl.3.p">Zamonaviy uylar, davlat korxonalari, ta'lim muassasalari, restoran, villa va zamonaviy bino ko'rinishini ta'minlovchi FASAD DEKOR yo'nalishi ishga tushirildi. Individual yondashuv — har bir mijoz uchun hohlagan rangi, razmeri, fasoni va materiali asosida loyihalash.</p>
      </div>
      <div class="tl-year">
        <div class="tl-dot"></div>
        <span class="tl-year-label">2021–2025</span>
      </div>
      <div class="tl-empty"></div>
    </div>

    <div class="timeline-item reveal">
      <div class="tl-empty"></div>
      <div class="tl-year">
        <div class="tl-dot"></div>
        <span class="tl-year-label">2026</span>
      </div>
      <div class="tl-body">
        <h3 data-i18n="ab.tl.4.h">Eron texnologiyalari — yangi bosqich</h3>
        <p data-i18n="ab.tl.4.p">2026-yil kompaniyamiz tarixida yangi bosqich. Mahsulotlarni zamonaviy <strong style="color:var(--gold)">Eron texnologiyalari</strong> asosida ishlab chiqarish yo'lga qo'yildi. Faqat texnologiyani emas — Eronlik malakali muhandislarni ham jalb qilib, ishlab chiqarish jarayoniga to'liq joriy etdik. Bu sifat, mustahkamlik va ishonchlilikni yangi darajaga olib chiqdi.</p>
      </div>
    </div>

  </div>
</section>

<!-- VALUES -->
<div class="values-section">
  <div class="values-inner">
    <div class="values-header reveal">
      <div class="section-label" style="justify-content:center;margin-bottom:16px">
        <span style="font-size:10px;letter-spacing:3px;text-transform:uppercase;color:var(--gold);font-weight:600" data-i18n="ab.val.label">Qadriyatlarimiz</span>
      </div>
      <h2 data-i18n="ab.val.h2">Bizning <em>Kuchimiz</em></h2>
      <p data-i18n="ab.val.p">Har bir muvaffaqiyatli loyiha ortida kuchli jamoa va mustahkam qadriyatlar turadi.</p>
    </div>
    <div class="values-grid">
      <div class="value-card reveal delay-1">
        <div class="value-icon"><i class="fas fa-leaf"></i></div>
        <h3 data-i18n="ab.val.1.h">Ekologik Toza</h3>
        <p data-i18n="ab.val.1.p">Asbest (inson sog'lig'i uchun zararli tog' jinsi) ishlatilmaydi. PM 2,5 zarrachalar hosil qilmaydi. O'zbekiston tabiiy muhitini asrab-avaylash — bizning mas'uliyatimiz.</p>
      </div>
      <div class="value-card reveal delay-2">
        <div class="value-icon"><i class="fas fa-flask"></i></div>
        <h3 data-i18n="ab.val.2.h">Zamonaviy Texnologiya</h3>
        <p data-i18n="ab.val.2.p">Eron muhandislari bilan hamkorlikda joriy etilgan texnologiya mahsulot sifatini yangi darajaga ko'tardi. Chet el bo'yoqlari va zamonaviy dekordan foydalanish ustun qo'yilgan.</p>
      </div>
      <div class="value-card reveal delay-3">
        <div class="value-icon"><i class="fas fa-snowflake"></i></div>
        <h3 data-i18n="ab.val.3.h">Iqlimga Moslashgan</h3>
        <p data-i18n="ab.val.3.p">O'zbekistonning bahorgi-qishki havoini inobatga olgan holda: issiqqa va sovuqqa chidamli, asbest panellariga nisbatan egiluvchanligi ortiq. Germaniya, Avstriya, Yaponiya ham xuddi shunday texnologiyadan foydalanadi.</p>
      </div>
      <div class="value-card reveal delay-1">
        <div class="value-icon"><i class="fas fa-palette"></i></div>
        <h3 data-i18n="ab.val.4.h">Individual Dizayn</h3>
        <p data-i18n="ab.val.4.p">Har bir mijoz uchun hohlagan rangi, razmeri, fasoni va materiali asosida zamonaviy va estetik bino fasadlarini loyihalash. Har bir obyekt nafaqat chiroyli, balki zamonaviy arxitektura talablariga mos.</p>
      </div>
      <div class="value-card reveal delay-2">
        <div class="value-icon"><i class="fas fa-users"></i></div>
        <h3 data-i18n="ab.val.5.h">Kuchli Jamoa</h3>
        <p data-i18n="ab.val.5.p">100 nafar malakali xodim, har bir loyiha ustida mas'uliyat va fidoyilik bilan ishlaydi. Kelajakda ish o'rinlarini yanada ko'paytirish va ishsizlik darajasini kamaytirish niyatidamiz.</p>
      </div>
      <div class="value-card reveal delay-3">
        <div class="value-icon"><i class="fas fa-globe"></i></div>
        <h3 data-i18n="ab.val.6.h">Xalqaro Hamkorlik</h3>
        <p data-i18n="ab.val.6.p">Yevropa va Rossiyalik dizaynerlar bilan hamkorlik yo'lga qo'yilmoqda. Ustalarimiz xorijiy tajriba asosida faoliyat yuritadi. Har bir loyihamizda global darajadagi yechimlar aks etadi.</p>
      </div>
    </div>
  </div>
</div>

<!-- ECO & TECH -->
<section class="eco-section">
  <div class="eco-grid">
    <div class="eco-text reveal-left">
      <div class="section-label" style="margin-bottom:20px">
        <span style="font-size:10px;letter-spacing:3px;text-transform:uppercase;color:var(--gold);font-weight:600" data-i18n="ab.eco.label">Ekologiya & Texnologiya</span>
        <div class="section-label-line"></div>
      </div>
      <h2 data-i18n="ab.eco.h2">100% Ekologik <em>Toza Mahsulot</em></h2>
      <p data-i18n="ab.eco.p">Hozirgi O'zbekiston tabiatining ekologik ifloslanishi va changini hisobga olgan holda, biz faqat ekologik toza mahsulot ishlab chiqaramiz. Mahsulotimiz o'zidan PM 2,5 zarrachalar (chang) hosil qilmaydi.</p>
      <div class="eco-list">
        <div class="eco-item">
          <div class="eco-item-icon"><i class="fas fa-ban"></i></div>
          <div class="eco-item-text">
            <h4 data-i18n="ab.eco.1.h">Asbest yo'q</h4>
            <p data-i18n="ab.eco.1.p">Inson sog'lig'i uchun zararli tog' jinsidan mutlaqo foydalanilmaydi. Sog'lig'ingiz — bizning ustuvorligimiz.</p>
          </div>
        </div>
        <div class="eco-item">
          <div class="eco-item-icon"><i class="fas fa-wind"></i></div>
          <div class="eco-item-text">
            <h4 data-i18n="ab.eco.2.h">PM 2,5 zarrachalar hosil qilmaydi</h4>
            <p data-i18n="ab.eco.2.p">Mahsulotimiz ishlatilishi davomida havoni ifloslantiruvchi mayda zarralar ajratmaydi.</p>
          </div>
        </div>
        <div class="eco-item">
          <div class="eco-item-icon"><i class="fas fa-paint-brush"></i></div>
          <div class="eco-item-text">
            <h4 data-i18n="ab.eco.3.h">Zamonaviy chet el bo'yoqlari</h4>
            <p data-i18n="ab.eco.3.p">Rang va dekorda faqat sertifikatlangan chet el materiallari ishlatiladi. Uzoq muddatli rang saqlanishi kafolatlangan.</p>
          </div>
        </div>
        <div class="eco-item">
          <div class="eco-item-icon"><i class="fas fa-thermometer-half"></i></div>
          <div class="eco-item-text">
            <h4 data-i18n="ab.eco.4.h">-30°C dan +60°C gacha</h4>
            <p data-i18n="ab.eco.4.p">O'zbekistonning keskin kontinental iqlimiga maxsus moslashtirilgan. Bahorgi-qishki harorat o'zgarishlariga bardosh beradi.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="eco-visual reveal-right">
      <img class="eco-img-main" src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?q=80&w=900" alt="Ekologik toza ishlab chiqarish">
      <div class="eco-badge">
        <span class="eco-badge-num">100%</span>
        <span class="eco-badge-txt" data-i18n="ab.eco.badge">Ekologik toza</span>
      </div>
    </div>
  </div>
</section>

<!-- COUNTERS -->
<div class="counters-section">
  <div class="counters-inner">
    <div class="counter-box reveal delay-1"><span class="counter-num" data-target="10000">0</span><span class="counter-suffix">+</span><span class="counter-label" data-i18n="cnt.1">Muvaffaqiyatli Loyihalar</span></div>
    <div class="counter-box reveal delay-2"><span class="counter-num" data-target="13">0</span><span class="counter-suffix" data-i18n="ab.yil"> yil</span><span class="counter-label" data-i18n="cnt.2">Bozordagi Tajriba</span></div>
    <div class="counter-box reveal delay-3"><span class="counter-num" data-target="100">0</span><span class="counter-suffix">+</span><span class="counter-label" data-i18n="cnt.3">Malakali xodim</span></div>
    <div class="counter-box reveal delay-4"><span class="counter-num" data-target="20">0</span><span class="counter-suffix" data-i18n="ab.yil"> yil</span><span class="counter-label" data-i18n="ab.cnt.4">Kafolat muddati</span></div>
  </div>
</div>

<!-- VISION -->
<div class="vision-section">
  <div class="vision-inner">
    <div class="vision-header reveal">
      <div class="section-label" style="margin-bottom:16px">
        <span style="font-size:10px;letter-spacing:3px;text-transform:uppercase;color:var(--gold);font-weight:600" data-i18n="ab.vis.label">Kelajak rejalari</span>
        <div class="section-label-line"></div>
      </div>
      <h2 data-i18n="ab.vis.h2">Bizning <em>Maqsad</em></h2>
      <p data-i18n="ab.vis.p">Kelajakda FASAD DEKOR yo'nalishini yanada rivojlantirib, Markaziy Osiyoda o'ziga xos arxitektura yechimlari bilan ajralib turadigan yetakchi brendga aylanishni maqsad qilganmiz.</p>
    </div>
    <div class="vision-list">
      <div class="vision-item reveal delay-1">
        <span class="vision-num">01</span>
        <div class="vision-item-text">
          <h4 data-i18n="ab.vis.1.h">Yangi innovatsion mahsulotlar</h4>
          <p data-i18n="ab.vis.1.p">Dunyo fasad dekor sanoatidagi eng so'nggi texnologiyalarni ishlab chiqarishga joriy etish va yangi mahsulot qatorlarini kengaytirish.</p>
        </div>
      </div>
      <div class="vision-item reveal delay-2">
        <span class="vision-num">02</span>
        <div class="vision-item-text">
          <h4 data-i18n="ab.vis.2.h">Xalqaro hamkorlikni kengaytirish</h4>
          <p data-i18n="ab.vis.2.p">Yevropa, Rossiya va Eron hamkorlarimiz bilan aloqalarni mustahkamlash. Xalqaro bozorga chiqish va eksportni yo'lga qo'yish.</p>
        </div>
      </div>
      <div class="vision-item reveal delay-3">
        <span class="vision-num">03</span>
        <div class="vision-item-text">
          <h4 data-i18n="ab.vis.3.h">Global standartlarni joriy etish</h4>
          <p data-i18n="ab.vis.3.p">Dizayn va qurilishda Germaniya, Avstriya, Yaponiya kabi mamlakatlar standartlarini O'zbekiston bozoriga olib kirish.</p>
        </div>
      </div>
      <div class="vision-item reveal delay-4">
        <span class="vision-num">04</span>
        <div class="vision-item-text">
          <h4 data-i18n="ab.vis.4.h">Individual xizmat ko'rsatish</h4>
          <p data-i18n="ab.vis.4.p">Har bir mijozga keng va individual yondashuv: loyihalashdan o'rnatishgacha bo'lgan to'liq xizmat paketi. Har bir loyihani mukammallik darajasiga olib chiqish.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- TEAM QUOTE -->
<section class="team-quote-section reveal">
  <blockquote>
    <span class="quote-mark">"</span>
    <span data-i18n="ab.quote">Bizning kuchimiz bu — Jamoa! Har bir muvaffaqiyatli loyiha ortida kuchli jamoa turadi. Biz qo'ygan har bir yangi qadam, erishgan har bir yutuqimiz — eng avvalo jamoamizning yutuqidir.</span>
  </blockquote>
  <cite data-i18n="ab.cite">— Mega Stroy Building, 2013</cite>
</section>

<!-- CTA BAND -->
<div class="cta-band reveal">
  <h2 data-i18n="cta.h2">Bugun <strong>bepul maslahat</strong> oling — uyingiz ertaga o'zgarsin!</h2>
  <div class="cta-actions">
    <a href="tel:+998974111151" class="btn-cta-dark"><i class="fas fa-phone"></i> <span data-i18n="cta.call">Qo'ng'iroq qiling</span></a>
    <a href="{{ url('/') }}#contact" class="btn-cta-outline" data-i18n="cta.form">Forma to'ldirish</a>
  </div>
</div>

@endsection
