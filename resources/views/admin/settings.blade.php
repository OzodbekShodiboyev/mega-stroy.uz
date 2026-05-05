@extends('admin.layout')
@section('title','Sayt sozlamalari')

@section('content')
<div class="card">
  <div class="card-header"><span class="card-title">Sayt sozlamalari</span></div>
  <div style="padding:28px">
    <form method="POST" action="{{ route('admin.settings.update') }}">
      @csrf @method('PUT')

      <div style="margin-bottom:32px">
        <div style="font-size:10px;letter-spacing:3px;text-transform:uppercase;color:var(--gold);margin-bottom:16px;padding-bottom:8px;border-bottom:1px solid var(--border)">Aloqa ma'lumotlari</div>
        <div class="form-grid">
          @foreach($settings->whereIn('key',['phone_1','phone_2','address']) as $key => $s)
          <div class="field {{ $s->type === 'textarea' ? 'field-full' : '' }}">
            <label>{{ $s->label }}</label>
            @if($s->type === 'textarea')
            <textarea name="settings[{{ $key }}]" rows="2">{{ old('settings.'.$key, $s->value) }}</textarea>
            @else
            <input type="{{ $s->type === 'phone' ? 'tel' : 'text' }}" name="settings[{{ $key }}]" value="{{ old('settings.'.$key, $s->value) }}">
            @endif
          </div>
          @endforeach
        </div>
      </div>

      <div style="margin-bottom:32px">
        <div style="font-size:10px;letter-spacing:3px;text-transform:uppercase;color:var(--gold);margin-bottom:16px;padding-bottom:8px;border-bottom:1px solid var(--border)">Zavod manzili</div>
        <div class="form-grid">
          @foreach($settings->whereIn('key',['factory_address','factory_note','factory_hours']) as $key => $s)
          <div class="field {{ $s->type === 'textarea' ? 'field-full' : '' }}">
            <label>{{ $s->label }}</label>
            @if($s->type === 'textarea')
            <textarea name="settings[{{ $key }}]" rows="2">{{ old('settings.'.$key, $s->value) }}</textarea>
            @else
            <input type="text" name="settings[{{ $key }}]" value="{{ old('settings.'.$key, $s->value) }}">
            @endif
          </div>
          @endforeach
        </div>
      </div>

      <div style="margin-bottom:32px">
        <div style="font-size:10px;letter-spacing:3px;text-transform:uppercase;color:var(--gold);margin-bottom:16px;padding-bottom:8px;border-bottom:1px solid var(--border)">Ijtimoiy tarmoqlar</div>
        <div class="form-grid">
          @foreach($settings->whereIn('key',['social_telegram','social_instagram','social_youtube','social_facebook']) as $key => $s)
          <div class="field">
            <label>
              @php
                $icon = match($key) {
                  'social_telegram'  => 'fab fa-telegram',
                  'social_instagram' => 'fab fa-instagram',
                  'social_youtube'   => 'fab fa-youtube',
                  'social_facebook'  => 'fab fa-facebook-f',
                  default            => 'fas fa-link',
                };
              @endphp
              <i class="{{ $icon }}" style="color:var(--gold);margin-right:6px"></i>{{ $s->label }}
            </label>
            <input type="url" name="settings[{{ $key }}]" value="{{ old('settings.'.$key, $s->value) }}" placeholder="https://...">
          </div>
          @endforeach
        </div>
      </div>

      <div class="form-actions">
        <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Saqlash</button>
      </div>
    </form>
  </div>
</div>
@endsection
