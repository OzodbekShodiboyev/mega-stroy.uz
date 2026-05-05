@extends('admin.layout')
@section('title','Loyihalar galereya')

@section('content')
<div class="topbar">
  <div class="topbar-title">Bizning Ishlarimiz — Galereya</div>
</div>
<div class="content">

  @if(session('success'))
  <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
  @endif

  {{-- Upload form --}}
  <div class="card" style="margin-bottom:28px">
    <div class="card-header"><span class="card-title">Yangi rasm(lar) qo'shish</span></div>
    <div style="padding:24px">
      <form method="POST" action="{{ route('admin.works.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-grid" style="margin-bottom:16px">
          <div class="field field-full">
            <label>Rasm(lar) <span style="color:var(--dim)">(bir vaqtda bir nechta tanlash mumkin)</span></label>
            <input type="file" name="images[]" multiple accept="image/*" required>
            @error('images') <div style="color:#e74c3c;font-size:12px;margin-top:4px">{{ $message }}</div> @enderror
            @error('images.*') <div style="color:#e74c3c;font-size:12px;margin-top:4px">{{ $message }}</div> @enderror
          </div>
          <div class="field">
            <label>Sarlavha (UZ)</label>
            <input type="text" name="caption_uz" placeholder="Toshkent, 2024 — Premium Villa" maxlength="200">
          </div>
          <div class="field">
            <label>Sarlavha (RU)</label>
            <input type="text" name="caption_ru" placeholder="Ташкент, 2024 — Премиум Вилла" maxlength="200">
          </div>
          <div class="field">
            <label>Sarlavha (EN)</label>
            <input type="text" name="caption_en" placeholder="Tashkent, 2024 — Premium Villa" maxlength="200">
          </div>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Yuklash</button>
      </form>
    </div>
  </div>

  {{-- Gallery grid --}}
  <div class="card">
    <div class="card-header">
      <span class="card-title">Barcha rasmlar ({{ $works->count() }} ta)</span>
    </div>
    @if($works->isEmpty())
    <div style="padding:40px;text-align:center;color:var(--dim)">Hali rasmlar yo'q</div>
    @else
    <div style="padding:24px;display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px">
      @foreach($works as $w)
      <div style="position:relative;background:var(--surface2);border:1px solid var(--border)">
        <img src="{{ $w->image_url }}" alt="" style="width:100%;height:160px;object-fit:cover;display:block">
        @if($w->caption_uz)
        <div style="padding:10px;font-size:12px;color:var(--dim);line-height:1.4">{{ $w->caption_uz }}</div>
        @endif
        <div style="padding:8px;border-top:1px solid var(--border)">
          <form method="POST" action="{{ route('admin.works.destroy', $w) }}" onsubmit="return confirm('O\'chirishni tasdiqlaysizmi?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" style="width:100%">
              <i class="fas fa-trash"></i> O'chirish
            </button>
          </form>
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </div>

</div>
@endsection
