@extends('admin.layout')
@section('title','Kategoriyalar')
@section('topbar-actions')
  <button class="btn btn-primary btn-sm" onclick="document.getElementById('addModal').style.display='flex'">
    <i class="fas fa-plus"></i> Yangi kategoriya
  </button>
@endsection

@section('content')

{{-- ADD MODAL --}}
<div id="addModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.7);z-index:999;align-items:center;justify-content:center">
  <div style="background:var(--surface);border:1px solid var(--border);padding:32px;width:560px;max-width:95vw;max-height:90vh;overflow-y:auto">
    <h3 style="color:var(--white);margin-bottom:24px">Yangi kategoriya</h3>
    <form method="POST" action="{{ route('admin.catalog.categories.store') }}">
      @csrf
      <div class="form-grid">
        <div class="field"><label>Nomi (UZ) *</label><input type="text" name="name_uz" required placeholder="O'zbekcha"></div>
        <div class="field"><label>Nomi (RU)</label><input type="text" name="name_ru" placeholder="Ruscha"></div>
        <div class="field"><label>Nomi (EN)</label><input type="text" name="name_en" placeholder="Inglizcha"></div>
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
  <div class="card-header"><span class="card-title">Kategoriyalar ({{ $categories->count() }})</span></div>
  <table>
    <thead>
      <tr><th>#</th><th>Nomi UZ</th><th>Nomi RU</th><th>Nomi EN</th><th>Tartib</th><th>Mahsulotlar</th><th>Status</th><th></th></tr>
    </thead>
    <tbody>
      @forelse($categories as $cat)
      <tr>
        <td style="color:var(--dim)">{{ $cat->id }}</td>
        <td style="color:var(--white)">{{ $cat->name_uz }}</td>
        <td style="color:var(--dim)">{{ $cat->name_ru ?: '—' }}</td>
        <td style="color:var(--dim)">{{ $cat->name_en ?: '—' }}</td>
        <td>{{ $cat->sort_order }}</td>
        <td><span style="color:var(--gold)">{{ $cat->products_count }}</span></td>
        <td>
          <form method="POST" action="{{ route('admin.catalog.categories.update', $cat) }}">
            @csrf @method('PATCH')
            <input type="hidden" name="name_uz" value="{{ $cat->name_uz }}">
            <input type="hidden" name="name_ru" value="{{ $cat->name_ru }}">
            <input type="hidden" name="name_en" value="{{ $cat->name_en }}">
            <input type="hidden" name="sort_order" value="{{ $cat->sort_order }}">
            <select name="is_active" onchange="this.form.submit()" style="background:var(--surface2);border:1px solid var(--border);color:var(--white);padding:5px 8px;font-size:12px">
              <option value="1" {{ $cat->is_active ? 'selected' : '' }}>Faol</option>
              <option value="0" {{ !$cat->is_active ? 'selected' : '' }}>Nofaol</option>
            </select>
          </form>
        </td>
        <td style="display:flex;gap:8px">
          <button class="btn btn-outline btn-sm" onclick="openEdit({{ $cat->id }},'{{ addslashes($cat->name_uz) }}','{{ addslashes($cat->name_ru) }}','{{ addslashes($cat->name_en) }}','{{ $cat->sort_order }}','{{ $cat->is_active ? 1 : 0 }}')">
            <i class="fas fa-edit"></i>
          </button>
          <form method="POST" action="{{ route('admin.catalog.categories.destroy', $cat) }}" onsubmit="return confirm('O\'chirilsinmi?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
          </form>
        </td>
      </tr>
      @empty
      <tr><td colspan="8" style="text-align:center;color:var(--dim);padding:40px">Kategoriyalar yo'q</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

{{-- EDIT MODAL --}}
<div id="editModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.7);z-index:999;align-items:center;justify-content:center">
  <div style="background:var(--surface);border:1px solid var(--border);padding:32px;width:560px;max-width:95vw">
    <h3 style="color:var(--white);margin-bottom:24px">Kategoriyani tahrirlash</h3>
    <form id="editForm" method="POST">
      @csrf @method('PATCH')
      <div class="form-grid">
        <div class="field"><label>Nomi (UZ) *</label><input type="text" name="name_uz" id="editNameUz" required></div>
        <div class="field"><label>Nomi (RU)</label><input type="text" name="name_ru" id="editNameRu"></div>
        <div class="field"><label>Nomi (EN)</label><input type="text" name="name_en" id="editNameEn"></div>
        <div class="field"><label>Tartib raqami</label><input type="number" name="sort_order" id="editSort"></div>
        <div class="field field-full"><label class="check-row"><input type="checkbox" name="is_active" id="editActive" value="1"> Faol</label></div>
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
function openEdit(id, nameUz, nameRu, nameEn, sort, active) {
  document.getElementById('editForm').action = '/admin/catalog/categories/' + id;
  document.getElementById('editNameUz').value = nameUz;
  document.getElementById('editNameRu').value = nameRu;
  document.getElementById('editNameEn').value = nameEn;
  document.getElementById('editSort').value = sort;
  document.getElementById('editActive').checked = active == 1;
  document.getElementById('editModal').style.display = 'flex';
}
</script>
@endpush
@endsection
