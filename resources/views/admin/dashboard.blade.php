@extends('admin.layout')
@section('title','Dashboard')

@section('content')
<div class="stat-grid">
  <div class="stat-card">
    <div class="stat-icon"><i class="fas fa-box"></i></div>
    <div class="stat-val">{{ $stats['products'] }}</div>
    <div class="stat-label">Mahsulotlar</div>
  </div>
  <div class="stat-card">
    <div class="stat-icon"><i class="fas fa-shopping-cart"></i></div>
    <div class="stat-val">{{ $stats['orders'] }}</div>
    <div class="stat-label">Jami buyurtmalar</div>
  </div>
  <div class="stat-card">
    <div class="stat-icon" style="color:#2ecc71"><i class="fas fa-bell"></i></div>
    <div class="stat-val" style="color:#2ecc71">{{ $stats['new_orders'] }}</div>
    <div class="stat-label">Yangi buyurtmalar</div>
  </div>
  <div class="stat-card">
    <div class="stat-icon"><i class="fas fa-envelope"></i></div>
    <div class="stat-val">{{ $stats['messages'] }}</div>
    <div class="stat-label">O'qilmagan xabarlar</div>
  </div>
  <div class="stat-card">
    <div class="stat-icon"><i class="fas fa-users"></i></div>
    <div class="stat-val">{{ $stats['users'] }}</div>
    <div class="stat-label">Foydalanuvchilar</div>
  </div>
  <div class="stat-card">
    <div class="stat-icon" style="color:#C9A84C"><i class="fas fa-coins"></i></div>
    <div class="stat-val" style="font-size:20px">{{ number_format($stats['revenue'],0,'.',',') }}</div>
    <div class="stat-label">Daromad (UZS)</div>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px">
  <div class="card">
    <div class="card-header">
      <span class="card-title">So'ngi buyurtmalar</span>
      <a href="{{ route('admin.orders.index') }}" class="btn btn-outline btn-sm">Barchasi</a>
    </div>
    <table>
      <thead><tr><th>#</th><th>Mijoz</th><th>Mahsulot</th><th>Status</th></tr></thead>
      <tbody>
        @forelse($recent_orders as $order)
        <tr>
          <td><a href="{{ route('admin.orders.show', $order) }}" style="color:var(--gold)">#{{ $order->id }}</a></td>
          <td>{{ $order->name }}<br><small style="color:var(--dim)">{{ $order->phone }}</small></td>
          <td style="max-width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $order->product->name_uz ?? '—' }}</td>
          <td><span class="badge badge-{{ $order->status }}">{{ $order->status_label }}</span></td>
        </tr>
        @empty
        <tr><td colspan="4" style="text-align:center;color:var(--dim)">Buyurtmalar yo'q</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="card">
    <div class="card-header">
      <span class="card-title">So'ngi xabarlar</span>
      <a href="{{ route('admin.messages.index') }}" class="btn btn-outline btn-sm">Barchasi</a>
    </div>
    <table>
      <thead><tr><th>Ism</th><th>Telefon</th><th>Mahsulot</th><th>Vaqt</th></tr></thead>
      <tbody>
        @forelse($recent_messages as $msg)
        <tr>
          <td>{{ $msg->name }}</td>
          <td>{{ $msg->phone }}</td>
          <td style="color:var(--dim)">{{ $msg->product_type ?? '—' }}</td>
          <td style="color:var(--dim);font-size:11px">{{ $msg->created_at->diffForHumans() }}</td>
        </tr>
        @empty
        <tr><td colspan="4" style="text-align:center;color:var(--dim)">Xabarlar yo'q</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
