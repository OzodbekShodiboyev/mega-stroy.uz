@php
  $isEdit = isset($product);
  $p = $product ?? null;
  $selectedColorIds   = $isEdit ? $p->colors->pluck('id')->toArray() : [];
  $selectedTextureIds = $isEdit ? $p->textures->pluck('id')->toArray() : [];
  $existingImages = $isEdit ? ($p->images ?? []) : [];
  $currentSpecs = '';
  if ($isEdit && !empty($p->specs)) {
    foreach ($p->specs as $s) {
      $currentSpecs .= ($s['label_uz'] ?? '') . ' | ' . ($s['label_ru'] ?? '') . ' | ' . ($s['value'] ?? '') . "\n";
    }
  }
@endphp

{{-- LANGUAGE TABS --}}
<div style="display:flex;gap:0;margin-bottom:24px;border-bottom:1px solid var(--border)">
  <button type="button" onclick="switchLang('uz')" id="tab-uz" style="padding:10px 20px;font-size:12px;letter-spacing:2px;background:rgba(201,168,76,0.1);border:none;border-bottom:2px solid var(--gold);color:var(--gold);cursor:pointer;font-family:inherit;font-weight:600">UZ</button>
  <button type="button" onclick="switchLang('ru')" id="tab-ru" style="padding:10px 20px;font-size:12px;letter-spacing:2px;background:transparent;border:none;border-bottom:2px solid transparent;color:var(--dim);cursor:pointer;font-family:inherit;font-weight:600">RU</button>
  <button type="button" onclick="switchLang('en')" id="tab-en" style="padding:10px 20px;font-size:12px;letter-spacing:2px;background:transparent;border:none;border-bottom:2px solid transparent;color:var(--dim);cursor:pointer;font-family:inherit;font-weight:600">EN</button>
</div>

<div class="form-grid">

  {{-- UZ --}}
  <div id="lang-uz" class="field" style="grid-column:1/-1">
    <div class="form-grid">
      <div class="field"><label>Nomi (UZ) *</label><input type="text" name="name_uz" value="{{ old('name_uz', $p->name_uz ?? '') }}" required placeholder="O'zbekcha nomi"></div>
      <div class="field field-full"><label>Tavsif (UZ)</label><textarea name="desc_uz" rows="4" placeholder="O'zbekcha tavsif">{{ old('desc_uz', $p->desc_uz ?? '') }}</textarea></div>
    </div>
  </div>

  {{-- RU --}}
  <div id="lang-ru" class="field" style="grid-column:1/-1;display:none">
    <div class="form-grid">
      <div class="field"><label>Nomi (RU)</label><input type="text" name="name_ru" value="{{ old('name_ru', $p->name_ru ?? '') }}" placeholder="Ruscha nomi"></div>
      <div class="field field-full"><label>Tavsif (RU)</label><textarea name="desc_ru" rows="4" placeholder="Ruscha tavsif">{{ old('desc_ru', $p->desc_ru ?? '') }}</textarea></div>
    </div>
  </div>

  {{-- EN --}}
  <div id="lang-en" class="field" style="grid-column:1/-1;display:none">
    <div class="form-grid">
      <div class="field"><label>Nomi (EN)</label><input type="text" name="name_en" value="{{ old('name_en', $p->name_en ?? '') }}" placeholder="Inglizcha nomi"></div>
      <div class="field field-full"><label>Tavsif (EN)</label><textarea name="desc_en" rows="4" placeholder="Inglizcha tavsif">{{ old('desc_en', $p->desc_en ?? '') }}</textarea></div>
    </div>
  </div>

  {{-- CATEGORY --}}
  <div class="field">
    <label>Kategoriya *</label>
    <select name="category_id" required>
      <option value="">— Tanlang —</option>
      @foreach($categories as $cat)
        <option value="{{ $cat->id }}" {{ old('category_id', $p->category_id ?? '') == $cat->id ? 'selected' : '' }}>
          {{ $cat->name_uz }}{{ $cat->name_ru ? ' / '.$cat->name_ru : '' }}
        </option>
      @endforeach
    </select>
    <small style="color:var(--dim);font-size:11px;margin-top:4px;display:block">
      <a href="{{ route('admin.catalog.categories') }}" target="_blank" style="color:var(--gold)">+ Yangi kategoriya</a>
    </small>
  </div>

  {{-- UNIT --}}
  <div class="field">
    <label>O'lchov birligi *</label>
    <select name="unit_id" required>
      <option value="">— Tanlang —</option>
      @foreach($units as $unit)
        <option value="{{ $unit->id }}" {{ old('unit_id', $p->unit_id ?? '') == $unit->id ? 'selected' : '' }}>
          {{ $unit->name_uz }} ({{ $unit->symbol }})
        </option>
      @endforeach
    </select>
    <small style="color:var(--dim);font-size:11px;margin-top:4px;display:block">
      <a href="{{ route('admin.catalog.units') }}" target="_blank" style="color:var(--gold)">+ Yangi birlik</a>
    </small>
  </div>

  {{-- PRICE --}}
  <div class="field">
    <label>Narx (UZS) *</label>
    <input type="number" name="price" value="{{ old('price', $p->price ?? 0) }}" min="0" required>
  </div>
  <div class="field">
    <label>Eski narx (UZS) <small style="color:var(--dim);text-transform:none;letter-spacing:0">chegirma</small></label>
    <input type="number" name="old_price" value="{{ old('old_price', $p->old_price ?? '') }}" min="0">
  </div>

  {{-- BADGE & SKU --}}
  <div class="field">
    <label>Badge (yorliq)</label>
    <select name="badge">
      <option value="">— Yo'q —</option>
      @foreach(['top'=>'TOP SOTUV','new'=>'YANGI','popular'=>'MASHHUR','sale'=>'CHEGIRMA'] as $val=>$lbl)
        <option value="{{ $val }}" {{ old('badge', $p->badge ?? '') == $val ? 'selected' : '' }}>{{ $lbl }}</option>
      @endforeach
    </select>
  </div>
  <div class="field">
    <label>SKU</label>
    <input type="text" name="sku" value="{{ old('sku', $p->sku ?? '') }}" placeholder="TP-001">
  </div>

  {{-- STATUS --}}
  <div class="field field-full" style="display:flex;gap:32px;align-items:center">
    <label class="check-row">
      <input type="checkbox" name="in_stock" value="1" {{ old('in_stock', $p->in_stock ?? true) ? 'checked' : '' }}> Omborda bor
    </label>
    <label class="check-row">
      <input type="checkbox" name="is_active" value="1" {{ old('is_active', $p->is_active ?? true) ? 'checked' : '' }}> Saytda ko'rinsin
    </label>
  </div>

  {{-- IMAGE UPLOAD --}}
  <div class="field field-full">
    <label>Rasmlar <small style="text-transform:none;letter-spacing:0;color:var(--dim);font-weight:400">— birinchisi asosiy rasm</small></label>

    {{-- Existing images (edit mode) --}}
    @if(!empty($existingImages))
    <div id="existingImagesWrap" style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:14px">
      @foreach($existingImages as $idx => $img)
      <div class="img-item" id="img-{{ $idx }}" style="position:relative;width:110px">
        <img src="{{ $img }}" style="width:110px;height:80px;object-fit:cover;border:1px solid var(--border);display:block">
        @if($idx === 0)
        <span style="position:absolute;top:4px;left:4px;background:#C9A84C;color:#080808;font-size:9px;font-weight:800;padding:2px 6px;letter-spacing:1px">ASOSIY</span>
        @endif
        <button type="button" onclick="removeExisting('{{ $img }}', {{ $idx }})"
          style="position:absolute;top:4px;right:4px;width:22px;height:22px;background:#e74c3c;border:none;color:#fff;cursor:pointer;font-size:13px;display:flex;align-items:center;justify-content:center;line-height:1">×</button>
        <input type="hidden" name="existing_images[]" value="{{ $img }}" id="existing-{{ $idx }}">
      </div>
      @endforeach
    </div>
    @endif

    {{-- Drop zone --}}
    <div id="dropZone"
      style="border:2px dashed var(--border);padding:32px;text-align:center;cursor:pointer;transition:border-color .3s;background:var(--surface2)"
      onclick="document.getElementById('imageFiles').click()"
      ondragover="event.preventDefault();this.style.borderColor='var(--gold)'"
      ondragleave="this.style.borderColor='var(--border)'"
      ondrop="handleDrop(event)">
      <i class="fas fa-cloud-upload-alt" style="font-size:32px;color:var(--dim);margin-bottom:10px;display:block"></i>
      <p style="color:var(--dim);font-size:13px;margin:0">Rasmlarni bu yerga tashlang yoki <span style="color:var(--gold)">tanlang</span></p>
      <p style="color:#444;font-size:11px;margin-top:6px">JPG, PNG, WEBP — max 5MB</p>
    </div>
    <input type="file" id="imageFiles" name="new_images[]" multiple accept="image/*" style="display:none" onchange="previewFiles(this.files)">

    {{-- New image previews --}}
    <div id="newPreviewWrap" style="display:flex;flex-wrap:wrap;gap:10px;margin-top:12px"></div>
  </div>

  {{-- COLORS --}}
  <div class="field field-full">
    <label>
      Ranglar
      <a href="{{ route('admin.catalog.colors') }}" target="_blank" style="color:var(--gold);font-size:11px;font-weight:400;text-transform:none;letter-spacing:0;margin-left:8px">+ Yangi rang</a>
    </label>
    <div style="display:flex;flex-wrap:wrap;gap:8px;padding:14px;background:var(--surface2);border:1px solid var(--border)">
      @forelse($colors as $color)
      <label style="display:flex;align-items:center;gap:8px;cursor:pointer;padding:8px 12px;border:1px solid var(--border);user-select:none">
        <input type="checkbox" name="color_ids[]" value="{{ $color->id }}"
          {{ in_array($color->id, $selectedColorIds) ? 'checked' : '' }}
          style="accent-color:var(--gold)">
        <span style="width:18px;height:18px;background:{{ $color->hex_code }};border:1px solid rgba(255,255,255,0.15);border-radius:50%;flex-shrink:0"></span>
        <span style="font-size:12px;color:var(--white)">{{ $color->name_uz }}</span>
        @if($color->name_ru)<small style="color:var(--dim);font-size:10px"> / {{ $color->name_ru }}</small>@endif
      </label>
      @empty
      <p style="color:var(--dim);font-size:12px">Ranglar yo'q. <a href="{{ route('admin.catalog.colors') }}" style="color:var(--gold)">Qo'shing</a></p>
      @endforelse
    </div>
  </div>

  {{-- TEXTURES --}}
  <div class="field field-full">
    <label>
      Fakturalar
      <a href="{{ route('admin.catalog.textures') }}" target="_blank" style="color:var(--gold);font-size:11px;font-weight:400;text-transform:none;letter-spacing:0;margin-left:8px">+ Yangi faktura</a>
    </label>
    <div style="display:flex;flex-wrap:wrap;gap:8px;padding:14px;background:var(--surface2);border:1px solid var(--border)">
      @forelse($textures as $tex)
      <label style="display:flex;align-items:center;gap:8px;cursor:pointer;padding:8px 12px;border:1px solid var(--border);user-select:none">
        <input type="checkbox" name="texture_ids[]" value="{{ $tex->id }}"
          {{ in_array($tex->id, $selectedTextureIds) ? 'checked' : '' }}
          style="accent-color:var(--gold)">
        <span style="font-size:13px;color:var(--white)">{{ $tex->name_uz }}</span>
        @if($tex->name_ru)<small style="color:var(--dim);font-size:10px"> / {{ $tex->name_ru }}</small>@endif
      </label>
      @empty
      <p style="color:var(--dim);font-size:12px">Fakturalar yo'q. <a href="{{ route('admin.catalog.textures') }}" style="color:var(--gold)">Qo'shing</a></p>
      @endforelse
    </div>
  </div>

  {{-- SPECS --}}
  <div class="field field-full">
    <label>
      Texnik ko'rsatkichlar
      <small style="text-transform:none;letter-spacing:0;color:var(--dim);font-weight:400">— Har qator: <code style="color:var(--gold)">Nom UZ | Nom RU | Qiymat</code></small>
    </label>
    <textarea name="specs" rows="7" placeholder="Qalinlik | Толщина | 100 mm&#10;Og'irlik | Вес | 18 kg/m²&#10;Harorat bardoshligi | Термостойкость | -50°C ... +80°C">{{ old('specs', $currentSpecs) }}</textarea>
  </div>

</div>

@push('scripts')
<script>
function switchLang(lang) {
  ['uz','ru','en'].forEach(function(l) {
    document.getElementById('lang-' + l).style.display = l === lang ? '' : 'none';
    var tab = document.getElementById('tab-' + l);
    tab.style.color = l === lang ? 'var(--gold)' : 'var(--dim)';
    tab.style.borderBottomColor = l === lang ? 'var(--gold)' : 'transparent';
    tab.style.background = l === lang ? 'rgba(201,168,76,0.1)' : 'transparent';
  });
}

// Remove existing image
function removeExisting(url, idx) {
  var el = document.getElementById('img-' + idx);
  if(el) el.remove();
  // Mark first remaining as primary
  var items = document.querySelectorAll('#existingImagesWrap .img-item');
  items.forEach(function(item, i) {
    var badge = item.querySelector('span');
    if(badge && badge.textContent === 'ASOSIY') badge.remove();
    if(i === 0) {
      var b = document.createElement('span');
      b.textContent = 'ASOSIY';
      b.style.cssText = 'position:absolute;top:4px;left:4px;background:#C9A84C;color:#080808;font-size:9px;font-weight:800;padding:2px 6px;letter-spacing:1px';
      item.appendChild(b);
    }
  });
}

// Preview new files
function previewFiles(files) {
  var wrap = document.getElementById('newPreviewWrap');
  wrap.innerHTML = '';
  Array.from(files).forEach(function(file, i) {
    var reader = new FileReader();
    reader.onload = function(e) {
      var div = document.createElement('div');
      div.style.cssText = 'position:relative;width:110px';
      div.innerHTML =
        '<img src="' + e.target.result + '" style="width:110px;height:80px;object-fit:cover;border:1px solid var(--border)">' +
        (i === 0 && document.querySelectorAll('#existingImagesWrap .img-item').length === 0
          ? '<span style="position:absolute;top:4px;left:4px;background:#C9A84C;color:#080808;font-size:9px;font-weight:800;padding:2px 6px">YANGI</span>'
          : '') +
        '<p style="font-size:10px;color:var(--dim);margin:4px 0 0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">' + file.name + '</p>';
      wrap.appendChild(div);
    };
    reader.readAsDataURL(file);
  });
}

// Drag & drop
function handleDrop(e) {
  e.preventDefault();
  document.getElementById('dropZone').style.borderColor = 'var(--border)';
  var files = e.dataTransfer.files;
  var input = document.getElementById('imageFiles');
  var dt = new DataTransfer();
  Array.from(files).forEach(function(f){ if(f.type.startsWith('image/')) dt.items.add(f); });
  input.files = dt.files;
  previewFiles(input.files);
}
</script>
@endpush
