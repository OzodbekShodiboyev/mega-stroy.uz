@extends('admin.layout')
@section('title','Birliklar (O\'lchov birliklari)')
@section('topbar-actions')
  <button class="btn btn-primary btn-sm" onclick="document.getElementById('addModal').style.display='flex'">
    <i class="fas fa-plus"></i> Yangi birlik
  </button>
@endsection

@section('content')

<div id="addModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.7);z-index:999;align-items:center;justify-content:center">
  <div style="background:var(--surface);border:1px solid var(--border);padding:32px;width:520px;max-width:95vw">
    <h3 style="color:var(--white);margin-bottom:24px">Yangi birlik</h3>
    <form method="POST" action="{{ route('admin.catalog.units.store') }}">
      @csrf
      <div class="form-grid">
        <div class="field"><label>Nomi (UZ) *</label><input type="text" name="name_uz" required placeholder="Kvadrat metr"></div>
        <div class="field"><label>Nomi (RU)</label><input type="text" name="name_ru" placeholder="Квадратный метр"></div>
        <div class="field"><label>Nomi (EN)</label><input type="text" name="name_en" placeholder="Square meter"></div>
        <div class="field"><label>Symbol (qisqa) *</label><input type="text" name="symbol" required placeholder="m²"></div>
      </div>
      <div class="form-actions">
        <button type="submit" class="btn btn-primary">Saqlash</button>
        <button type="button" class="btn btn-outline" onclick="document.getElementById('addModal').style.display='none'">Bekor</button>
      </div>
    </form>
  </div>
</div>

<div class="card">
  <div class="card-header"><span class="card-title">Birliklar ({{ $units->count() }})</span></div>
  <table>
    <thead>
      <tr><th>#</th><th>Nomi UZ</th><th>Nomi RU</th><th>Nomi EN</th><th>Symbol</th><th>Mahsulotlar</th><th></th></tr>
    </thead>
    <tbody>
      @forelse($units as $unit)
      <tr>
        <td style="color:var(--dim)">{{ $unit->id }}</td>
        <td style="color:var(--white)">{{ $unit->name_uz }}</td>
        <td style="color:var(--dim)">{{ $unit->name_ru ?: '—' }}</td>
        <td style="color:var(--dim)">{{ $unit->name_en ?: '—' }}</td>
        <td><span style="color:var(--gold);font-weight:700">{{ $unit->symbol }}</span></td>
        <td><span style="color:var(--gold)">{{ $unit->products_count }}</span></td>
        <td style="display:flex;gap:8px">
          <button class="btn btn-outline btn-sm" onclick="openEdit({{ $unit->id }},'{{ addslashes($unit->name_uz) }}','{{ addslashes($unit->name_ru) }}','{{ addslashes($unit->name_en) }}','{{ $unit->symbol }}')">
            <i class="fas fa-edit"></i>
          </button>
          <form method="POST" action="{{ route('admin.catalog.units.destroy', $unit) }}" onsubmit="return confirm('O\'chirilsinmi?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
          </form>
        </td>
      </tr>
      @empty
      <tr><td colspan="7" style="text-align:center;color:var(--dim);padding:40px">Birliklar yo'q</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

<div id="editModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.7);z-index:999;align-items:center;justify-content:center">
  <div style="background:var(--surface);border:1px solid var(--border);padding:32px;width:520px;max-width:95vw">
    <h3 style="color:var(--white);margin-bottom:24px">Birlikni tahrirlash</h3>
    <form id="editForm" method="POST">
      @csrf @method('PATCH')
      <div class="form-grid">
        <div class="field"><label>Nomi (UZ) *</label><input type="text" name="name_uz" id="eNameUz" required></div>
        <div class="field"><label>Nomi (RU)</label><input type="text" name="name_ru" id="eNameRu"></div>
        <div class="field"><label>Nomi (EN)</label><input type="text" name="name_en" id="eNameEn"></div>
        <div class="field"><label>Symbol *</label><input type="text" name="symbol" id="eSymbol" required></div>
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
function openEdit(id, nameUz, nameRu, nameEn, symbol) {
  document.getElementById('editForm').action = '/admin/catalog/units/' + id;
  document.getElementById('eNameUz').value = nameUz;
  document.getElementById('eNameRu').value = nameRu;
  document.getElementById('eNameEn').value = nameEn;
  document.getElementById('eSymbol').value = symbol;
  document.getElementById('editModal').style.display = 'flex';
}
</script>
@endpush
@endsection
