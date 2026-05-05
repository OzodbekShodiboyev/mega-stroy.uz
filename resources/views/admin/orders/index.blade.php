@extends('admin.layout')
@section('title','Buyurtmalar')

@section('content')
<div style="display:flex;gap:8px;margin-bottom:20px;flex-wrap:wrap">
  @foreach([''=>'Barchasi','new'=>'Yangi','processing'=>'Jarayonda','completed'=>'Bajarildi','cancelled'=>'Bekor'] as $s=>$l)
    <a href="{{ route('admin.orders.index', $s ? ['status'=>$s] : []) }}"
       class="btn btn-sm {{ request('status')==$s ? 'btn-primary' : 'btn-outline' }}">{{ $l }}</a>
  @endforeach
</div>

<div class="card">
  <div class="card-header"><span class="card-title">Buyurtmalar ({{ $orders->total() }})</span></div>
  <table>
    <thead>
      <tr><th>#</th><th>Mijoz</th><th>Mahsulot</th><th>Miqdor</th><th>Summa</th><th>Status</th><th>Sana</th><th></th></tr>
    </thead>
    <tbody>
      @forelse($orders as $o)
      <tr>
        <td style="color:var(--gold)">#{{ $o->id }}</td>
        <td><strong style="color:var(--white)">{{ $o->name }}</strong><br><small style="color:var(--dim)">{{ $o->phone }}</small></td>
        <td style="color:var(--text)">{{ $o->product->name_uz ?? '—' }}</td>
        <td>{{ $o->qty }} {{ $o->product->unit ?? '' }}</td>
        <td style="color:var(--gold);font-weight:700">{{ number_format($o->total_price,0,'.',',') }} UZS</td>
        <td><span class="badge badge-{{ $o->status }}">{{ $o->status_label }}</span></td>
        <td style="color:var(--dim);font-size:12px">{{ $o->created_at->format('d.m.Y H:i') }}</td>
        <td><a href="{{ route('admin.orders.show', $o) }}" class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></a></td>
      </tr>
      @empty
      <tr><td colspan="8" style="text-align:center;color:var(--dim);padding:40px">Buyurtmalar yo'q</td></tr>
      @endforelse
    </tbody>
  </table>
  @if($orders->hasPages())
  <div style="padding:16px">{{ $orders->links() }}</div>
  @endif
</div>
@endsection
