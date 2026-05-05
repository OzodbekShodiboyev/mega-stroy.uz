@extends('admin.layout')
@section('title','Fakturalar (Texturalar)')
@section('topbar-actions')
  <button class="btn btn-primary btn-sm" onclick="document.getElementById('addModal').style.display='flex'">
    <i class="fas fa-plus"></i> Yangi faktura
  </button>
@endsection

@section('content')

<div id="addModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.7);z-index:999;align-items:center;justify-content:center">
  <div style="background:var(--surface);border:1px solid var(--border);padding:32px;width:520px;max-width:95vw">
    <h3 style="color:var(--white);margin-bottom:24px">Yangi faktura</h3>
    <form method="POST" action="{{ route('admin.catalog.textures.store') }}">
      @csrf
      <div class="form-grid">
        <div class="field"><label>Nomi (UZ) *</label><input type="text" name="name_uz" required placeholder="Tosh"></div>
        <div class="field"><label>Nomi (RU)</label><input type="text" name="name_ru" placeholder="Камень"></div>
        <div class="field"><label>Nomi (EN)</label><input type="text" name="name_en" placeholder="Stone"></div>
        <div class="field"><label>Tartib raqami</label><input type="number" name="sort_order" value="0"></div>
        <div class="field field-full"><label class="check-row"><input type="checkbox" name="is_active" value="1" checked> Faol</label></div>
      </div>
      <div class="form-actions">
        <button type="submit" class="btn btn-primary">Saqlash</button>
        <button type="button" class="btn btn-outline" onclick="document.getElementById('addModal').style.display='none'">Bekor</button>
      </div>
    </form>
  </div>
</div>

<div class="card">
  <div class="card-header"><span class="card-title">Fakturalar ({{ $textures->count() }})</span></div>
  <table>
    <thead>
      <tr><th>#</th><th>Nomi UZ</th><th>Nomi RU</th><th>Nomi EN</th><th>Tartib</th><th>Mahsulotlar</th><th>Status</th><th></th></tr>
    </thead>
    <tbody>
      @forelse($textures as $tex)
      <tr>
        <td style="color:var(--dim)">{{ $tex->id }}</td>
        <td style="color:var(--white)">{{ $tex->name_uz }}</td>
        <td style="color:var(--dim)">{{ $tex->name_ru ?: '—' }}</td>
        <td style="color:var(--dim)">{{ $tex->name_en ?: '—' }}</td>
        <td>{{ $tex->sort_order }}</td>
        <td><span style="color:var(--gold)">{{ $tex->products_count }}</span></td>
        <td><span class="badge {{ $tex->is_active ? 'badge-completed' : 'badge-cancelled' }}">{{ $tex->is_active ? 'Faol' : 'Nofaol' }}</span></td>
        <td style="display:flex;gap:8px">
          <button class="btn btn-outline btn-sm" onclick="openEdit({{ $tex->id }},'{{ addslashes($tex->name_uz) }}','{{ addslashes($tex->name_ru) }}','{{ addslashes($tex->name_en) }}','{{ $tex->sort_order }}','{{ $tex->is_active ? 1 : 0 }}')">
            <i class="fas fa-edit"></i>
          </button>
          <form method="POST" action="{{ route('admin.catalog.textures.destroy', $tex) }}" onsubmit="return confirm('O\'chirilsinmi?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
          </form>
        </td>
      </tr>
      @empty
      <tr><td colspan="8" style="text-align:center;color:var(--dim);padding:40px">Fakturalar yo'q</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

<div id="editModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.7);z-index:999;align-items:center;justify-content:center">
  <div style="background:var(--surface);border:1px solid var(--border);padding:32px;width:520px;max-width:95vw">
    <h3 style="color:var(--white);margin-bottom:24px">Fakturani tahrirlash</h3>
    <form id="editForm" method="POST">
      @csrf @method('PATCH')
      <div class="form-grid">
        <div class="field"><label>Nomi (UZ) *</label><input type="text" name="name_uz" id="eNameUz" required></div>
        <div class="field"><label>Nomi (RU)</label><input type="text" name="name_ru" id="eNameRu"></div>
        <div class="field"><label>Nomi (EN)</label><input type="text" name="name_en" id="eNameEn"></div>
        <div class="field"><label>Tartib raqami</label><input type="number" name="sort_order" id="eSort"></div>
        <div class="field field-full"><label class="check-row"><input type="checkbox" name="is_active" id="eActive" value="1"> Faol</label></div>
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
function openEdit(id, uz, ru, en, sort, active) {
  document.getElementById('editForm').action = '/admin/catalog/textures/' + id;
  document.getElementById('eNameUz').value = uz;
  document.getElementById('eNameRu').value = ru;
  document.getElementById('eNameEn').value = en;
  document.getElementById('eSort').value = sort;
  document.getElementById('eActive').checked = active == 1;
  document.getElementById('editModal').style.display = 'flex';
}
</script>
@endpush
@endsection
