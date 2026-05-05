@extends('layouts.app')
@section('title', 'Katalog — Mega Stroy')
@section('meta_description', 'Mega Stroy Building barcha mahsulotlari — fasad panellar, karnizlar, ustunlar va dekor elementlar.')

@push('styles')
<style>
.cat-wrap{display:flex;gap:32px;max-width:1440px;margin:0 auto;padding:110px 40px 80px;align-items:flex-start}
.cat-sidebar{width:260px;flex-shrink:0;position:sticky;top:90px}
.cat-main{flex:1;min-width:0}
.fsec{background:var(--surface);border:1px solid var(--border);padding:20px;margin-bottom:12px}
.ftitle{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--dim);margin-bottom:14px}
.fpills{display:flex;flex-wrap:wrap;gap:6px}
.fpill{padding:5px 12px;font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;border:1px solid rgba(201,168,76,0.2);color:var(--text-dim);text-decoration:none;transition:all .2s;display:inline-block}
.fpill.active,.fpill:hover{border-color:var(--gold);color:var(--gold)}
.fprice{display:flex;gap:8px;align-items:center}
.finput{width:100%;background:var(--surface2);border:1px solid var(--border);color:var(--white);padding:8px 10px;font-size:13px;font-family:inherit;outline:none}
.finput:focus{border-color:var(--gold)}
.fbtn{width:100%;background:var(--gold);color:#080808;border:none;padding:11px;font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;cursor:pointer;font-family:inherit;margin-top:14px;transition:background .2s}
.fbtn:hover{background:#E8CC7A}
.freset{display:block;text-align:center;padding:8px;font-size:11px;color:var(--dim);margin-top:8px;text-decoration:none;letter-spacing:1px;transition:color .2s}
.freset:hover{color:var(--gold)}
.cswatch{width:26px;height:26px;border:2px solid transparent;display:inline-block;transition:border-color .15s,outline .15s;cursor:pointer;text-decoration:none}
.cswatch.active,.cswatch:hover{border-color:var(--gold);outline:1px solid rgba(201,168,76,0.4);outline-offset:1px}
.cat-header{margin-bottom:28px}
.results-count{font-size:13px;color:var(--text-dim);margin-bottom:20px}
@media(max-width:900px){.cat-wrap{flex-direction:column;padding:100px 20px 60px}.cat-sidebar{width:100%;position:static}}
</style>
@endpush

@section('content')
<div class="cat-wrap">

  {{-- ===== SIDEBAR FILTERS ===== --}}
  <aside class="cat-sidebar">
    <form method="GET" action="{{ route('catalog') }}" id="filterForm">

      {{-- Category --}}
      <div class="fsec">
        <div class="ftitle" data-i18n="filter.cat">Kategoriya</div>
        <div class="fpills">
          <a href="{{ route('catalog', array_merge(request()->except('cat','page'), [])) }}"
            class="fpill {{ !request('cat') ? 'active' : '' }}" data-i18n="filter.all">Hammasi</a>
          @foreach($categories as $cat)
          <a href="{{ route('catalog', array_merge(request()->except('cat','page'), ['cat'=>$cat->slug])) }}"
            class="fpill {{ request('cat')==$cat->slug ? 'active' : '' }}"
            data-cat-uz="{{ $cat->name_uz }}"
            data-cat-ru="{{ $cat->name_ru ?? $cat->name_uz }}"
            data-cat-en="{{ $cat->name_en ?? $cat->name_uz }}">{{ $cat->name_uz }}</a>
          @endforeach
        </div>
      </div>

      {{-- Price --}}
      <div class="fsec">
        <div class="ftitle" data-i18n="filter.price">Narx (UZS)</div>
        <div class="fprice">
          <input class="finput" type="number" name="min" value="{{ request('min') }}"
            placeholder="{{ number_format($minPrice, 0, '.', ',') }}">
          <span style="color:var(--dim);flex-shrink:0">—</span>
          <input class="finput" type="number" name="max" value="{{ request('max') }}"
            placeholder="{{ number_format($maxPrice, 0, '.', ',') }}">
        </div>
        @if(request('cat'))  <input type="hidden" name="cat" value="{{ request('cat') }}">@endif
        @if(request('color'))<input type="hidden" name="color" value="{{ request('color') }}">@endif
        <button type="submit" class="fbtn"><i class="fas fa-filter"></i> <span data-i18n="filter.apply">Filtrlash</span></button>
      </div>

      {{-- Colors --}}
      @if($colors->isNotEmpty())
      <div class="fsec">
        <div class="ftitle" data-i18n="filter.color">Rang</div>
        <div style="display:flex;flex-wrap:wrap;gap:8px">
          @foreach($colors as $color)
          @php $colorActive = request('color') == $color->id; @endphp
          <a href="{{ route('catalog', array_merge(request()->except('color','page'), $colorActive ? [] : ['color'=>$color->id])) }}"
            class="cswatch {{ $colorActive ? 'active' : '' }}"
            style="background:{{ $color->hex_code }}"
            title="{{ $color->name_uz }}"></a>
          @endforeach
        </div>
        @if(request('color'))
        <a href="{{ route('catalog', request()->except('color','page')) }}" style="display:inline-flex;align-items:center;gap:6px;font-size:11px;color:var(--dim);margin-top:10px;text-decoration:none">
          <i class="fas fa-times" style="font-size:10px"></i> <span data-i18n="filter.reset">Rangni tozalash</span>
        </a>
        @endif
      </div>
      @endif

      {{-- Reset all --}}
      @if(request()->hasAny(['cat','min','max','color']))
      <a href="{{ route('catalog') }}" class="freset" data-i18n="filter.reset">&#x2715; Tozalash</a>
      @endif

    </form>
  </aside>

  {{-- ===== MAIN CONTENT ===== --}}
  <div class="cat-main">

    {{-- Header --}}
    <div class="cat-header">
      <div style="font-size:10px;letter-spacing:3px;text-transform:uppercase;color:var(--gold);margin-bottom:10px" data-i18n="prod.label">Katalog</div>
      <h1 style="font-family:var(--font-display);font-size:clamp(28px,4vw,48px);font-weight:300;color:var(--white);margin-bottom:8px" data-i18n="prod.h2">Bizning <em>Mahsulotlar</em></h1>
      <p style="color:var(--text-dim);font-size:14px" data-i18n="prod.sub">Har bir mahsulot sifat standartlaridan o'tgan.</p>
    </div>

    {{-- Results count --}}
    <div class="results-count">
      <span style="color:var(--gold);font-weight:700">{{ $products->total() }}</span>
      <span data-i18n="catalog.found"> ta mahsulot topildi</span>
    </div>

    {{-- Product grid --}}
    <div class="shop-grid">
      @forelse($products as $i => $p)
      @php
        $delays = ['delay-1','delay-2','delay-3','delay-4'];
        $delay  = $delays[$i % 4];
        $stars  = str_repeat('★', round($p->rating)) . str_repeat('☆', 5 - round($p->rating));
        $catUz  = $p->categoryRel?->name_uz ?? ucfirst($p->category ?? '');
        $catRu  = $p->categoryRel?->name_ru ?? $catUz;
        $catEn  = $p->categoryRel?->name_en ?? $catUz;
        $badgeClass = match($p->badge) { 'top','popular'=>'badge-hit','new'=>'badge-new','sale'=>'badge-sale',default=>'' };
        $revCount   = $p->reviews_count ?? 0;
      @endphp
      <div class="shop-card reveal {{ $delay }}" data-cat="{{ $p->category }}">
        <div class="shop-img-wrap">
          @if($p->badge)<span class="shop-badge {{ $badgeClass }}" data-i18n="badge.{{ $p->badge }}">{{ strtoupper($p->badge) }}</span>@endif
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
              @if($p->old_price)<div class="shop-price-old">{{ number_format($p->old_price, 0, '.', ',') }} UZS</div>@endif
            </div>
          </div>
          <div class="shop-actions">
            <a href="{{ route('product.show', $p->slug) }}" class="btn-cart"><i class="fas fa-shopping-cart"></i> <span data-i18n="order">Buyurtma</span></a>
            <a href="{{ route('product.show', $p->slug) }}" class="btn-quick"><i class="fas fa-eye"></i></a>
          </div>
        </div>
        <div class="shop-meta">
          @if($p->in_stock)<span class="shop-stock" data-i18n="instock">Omborda bor</span>
          @else<span class="shop-stock low">Tugagan</span>@endif
          @if($p->sku)<span class="shop-sku">SKU: {{ $p->sku }}</span>@endif
        </div>
      </div>
      @empty
      <div style="grid-column:1/-1;text-align:center;padding:80px;color:var(--dim)">
        <i class="fas fa-search" style="font-size:40px;display:block;margin-bottom:16px;opacity:0.3"></i>
        <div data-i18n="catalog.empty">Mahsulotlar topilmadi</div>
      </div>
      @endforelse
    </div>

    {{-- Pagination --}}
    @if($products->hasPages())
    <div style="display:flex;justify-content:center;margin-top:48px">
      {{ $products->links() }}
    </div>
    @endif

  </div>
</div>
@endsection
