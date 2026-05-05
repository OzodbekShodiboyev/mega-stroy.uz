@extends('admin.layout')
@section('title','Mahsulotlar')
@section('topbar-actions')
  <a href="{{ route('admin.products.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Yangi mahsulot</a>
@endsection

@section('content')
<div class="card">
  <div class="card-header">
    <span class="card-title">Barcha mahsulotlar ({{ $products->count() }})</span>
  </div>
  <table>
    <thead>
      <tr><th>Rasm</th><th>Nomi</th><th>Kategoriya</th><th>Narx</th><th>Badge</th><th>Holat</th><th>Tartib</th><th></th></tr>
    </thead>
    <tbody>
      @forelse($products as $p)
      <tr>
        <td><img class="prod-img" src="{{ $p->first_image }}" alt=""></td>
        <td>
          <strong style="color:var(--white)">{{ $p->name_uz }}</strong>
          <br><small style="color:var(--dim)">{{ $p->sku }}</small>
        </td>
        <td><span class="badge badge-user">{{ ucfirst($p->category) }}</span></td>
        <td style="color:var(--gold);font-weight:700">{{ $p->price_formatted }} <small style="color:var(--dim)">/ {{ $p->unit }}</small></td>
        <td>
          @if($p->badge)
            <span class="badge badge-new">{{ $p->badge }}</span>
          @else <span style="color:var(--dim)">—</span> @endif
        </td>
        <td>
          @if($p->is_active)
            <span class="badge badge-completed">Faol</span>
          @else
            <span class="badge badge-cancelled">Nofaol</span>
          @endif
        </td>
        <td style="color:var(--dim)">{{ $p->sort_order }}</td>
        <td>
          <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></a>
          <form method="POST" action="{{ route('admin.products.destroy', $p) }}" style="display:inline" onsubmit="return confirm('O\'chirishni tasdiqlaysizmi?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
          </form>
        </td>
      </tr>
      @empty
      <tr><td colspan="8" style="text-align:center;color:var(--dim);padding:40px">Mahsulotlar yo'q. <a href="{{ route('admin.products.create') }}" style="color:var(--gold)">Yangi qo'shish</a></td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
