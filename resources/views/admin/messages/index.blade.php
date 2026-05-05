@extends('admin.layout')
@section('title','Xabarlar')

@section('content')
<div class="card">
  <div class="card-header"><span class="card-title">So'rovlar ({{ $messages->total() }})</span></div>
  <table>
    <thead>
      <tr><th>#</th><th>Ism</th><th>Telefon</th><th>Mahsulot</th><th>Xabar</th><th>Sana</th><th></th></tr>
    </thead>
    <tbody>
      @forelse($messages as $m)
      <tr>
        <td style="color:var(--dim)">{{ $m->id }}</td>
        <td style="color:var(--white)">{{ $m->name }}</td>
        <td><a href="tel:{{ $m->phone }}" style="color:var(--gold)">{{ $m->phone }}</a></td>
        <td style="color:var(--dim)">{{ $m->product_type ?: '—' }}</td>
        <td style="max-width:220px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;color:var(--text)">{{ $m->message ?: '—' }}</td>
        <td style="color:var(--dim);font-size:11px">{{ $m->created_at->format('d.m.Y H:i') }}</td>
        <td>
          <form method="POST" action="{{ route('admin.messages.destroy', $m) }}" onsubmit="return confirm('O\'chirishni tasdiqlaysizmi?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
          </form>
        </td>
      </tr>
      @empty
      <tr><td colspan="7" style="text-align:center;color:var(--dim);padding:40px">Xabarlar yo'q</td></tr>
      @endforelse
    </tbody>
  </table>
  @if($messages->hasPages())
  <div style="padding:16px">{{ $messages->links() }}</div>
  @endif
</div>
@endsection
