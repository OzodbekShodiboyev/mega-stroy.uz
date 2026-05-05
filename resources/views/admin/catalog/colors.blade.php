@extends('admin.layout')
@section('title','Ranglar')
@section('topbar-actions')
  <button class="btn btn-primary btn-sm" onclick="document.getElementById('addModal').style.display='flex'">
    <i class="fas fa-plus"></i> Yangi rang
  </button>
@endsection

@section('content')

<div id="addModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.7);z-index:999;align-items:center;justify-content:center">
  <div style="background:var(--surface);border:1px solid var(--border);padding:32px;width:560px;max-width:95vw">
    <h3 style="color:var(--white);margin-bottom:24px">Yangi rang</h3>
    <form method="POST" action="{{ route('admin.catalog.colors.store') }}">
      @csrf
      <div class="form-grid">
        <div class="field"><label>Nomi (UZ) *</label><input type="text" name="name_uz" required placeholder="Kumush Tosh"></div>
        <div class="field"><label>Nomi (RU)</label><input type="text" name="name_ru" placeholder="Серебристый Камень"></div>
        <div class="field"><label>Nomi (EN)</label><input type="text" name="name_en" placeholder="Silver Stone"></div>
        <div class="field"><label>Rang kodi (HEX) *</label><input type="color" name="hex_code" value="#CCCCCC" style="height:48px;padding:4px 8px;cursor:pointer"></div>
        <div class="field"><label>Tartib raqami</label><input type="number" name="sort_order" value="0"></div>
        <div class="field"><label class="check-row"><input type="checkbox" name="is_active" value="1" checked> Faol</label></div>
      </div>
      <div class="form-actions">
        <button type="submit" class="btn btn-primary">Saqlash</button>
        <button type="button" class="btn btn-outline" onclick="document.getElementById('addModal').style.display='none'">Bekor</button>
      </div>
    </form>
  </div>
</div>

<div class="card">
  <div class="card-header"><span class="card-title">Ranglar ({{ $colors->count() }})</span></div>
  <table>
    <thead>
      <tr><th>#</th><th>Rang</th><th>Nomi UZ</th><th>Nomi RU</th><th>Nomi EN</th><th>HEX</th><th>Tartib</th><th>Status</th><th></th></tr>
    </thead>
    <tbody>
      @forelse($colors as $color)
      <tr>
        <td style="color:var(--dim)">{{ $color->id }}</td>
        <td><div style="width:32px;height:32px;background:{{ $color->hex_code }};border:1px solid var(--border);border-radius:50%"></div></td>
        <td style="color:var(--white)">{{ $color->name_uz }}</td>
        <td style="color:var(--dim)">{{ $color->name_ru ?: '—' }}</td>
        <td style="color:var(--dim)">{{ $color->name_en ?: '—' }}</td>
        <td style="font-family:monospace;font-size:12px;color:var(--gold)">{{ $color->hex_code }}</td>
        <td>{{ $color->sort_order }}</td>
        <td><span class="badge {{ $color->is_active ? 'badge-completed' : 'badge-cancelled' }}">{{ $color->is_active ? 'Faol' : 'Nofaol' }}</span></td>
        <td style="display:flex;gap:8px">
          <button class="btn btn-outline btn-sm" onclick="openEdit({{ $color->id }},'{{ addslashes($color->name_uz) }}','{{ addslashes($color->name_ru) }}','{{ addslashes($color->name_en) }}','{{ $color->hex_code }}','{{ $color->sort_order }}','{{ $color->is_active ? 1 : 0 }}')">
            <i class="fas fa-edit"></i>
          </button>
          <form method="POST" action="{{ route('admin.catalog.colors.destroy', $color) }}" onsubmit="return confirm('O\'chirilsinmi?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
          </form>
        </td>
      </tr>
      @empty
      <tr><td colspan="9" style="text-align:center;color:var(--dim);padding:40px">Ranglar yo'q</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

<div id="editModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.7);z-index:999;align-items:center;justify-content:center">
  <div style="background:var(--surface);border:1px solid var(--border);padding:32px;width:560px;max-width:95vw">
    <h3 style="color:var(--white);margin-bottom:24px">Rangni tahrirlash</h3>
    <form id="editForm" method="POST">
      @csrf @method('PATCH')
      <div class="form-grid">
        <div class="field"><label>Nomi (UZ) *</label><input type="text" name="name_uz" id="eNameUz" required></div>
        <div class="field"><label>Nomi (RU)</label><input type="text" name="name_ru" id="eNameRu"></div>
        <div class="field"><label>Nomi (EN)</label><input type="text" name="name_en" id="eNameEn"></div>
        <div class="field"><label>Rang kodi *</label><input type="color" id="eHex" name="hex_code" style="height:48px;padding:4px 8px;cursor:pointer"></div>
        <div class="field"><label>Tartib raqami</label><input type="number" name="sort_order" id="eSort"></div>
        <div class="field"><label class="check-row"><input type="checkbox" name="is_active" id="eActive" value="1"> Faol</label></div>
      </div>
      <div class="form-actions">
        <button type="submit" class="btn btn-primary">Saqlash</button>
        <button type="button" class="btn btn-outline" onclick="document.getElementById('editModal').style.display='none'">Bekor</button>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
function openEdit(id, uz, ru, en, hex, sort, active) {
  document.getElementById('editForm').action = '/admin/catalog/colors/' + id;
  document.getElementById('eNameUz').value = uz;
  document.getElementById('eNameRu').value = ru;
  document.getElementById('eNameEn').value = en;
  document.getElementById('eHex').value = hex;
  document.getElementById('eSort').value = sort;
  document.getElementById('eActive').checked = active == 1;
  document.getElementById('editModal').style.display = 'flex';
}
</script>
@endpush
@endsection
