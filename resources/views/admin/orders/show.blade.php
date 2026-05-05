@extends('admin.layout')
@section('title','Buyurtma #'.$order->id)
@section('topbar-actions')
  <a href="{{ route('admin.orders.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Orqaga</a>
@endsection

@section('content')
<div style="display:grid;grid-template-columns:2fr 1fr;gap:24px">
  <div>
    <div class="card" style="margin-bottom:24px">
      <div class="card-header"><span class="card-title">Buyurtma ma'lumotlari</span></div>
      <div style="padding:24px">
        <table style="width:100%">
          <tr><td style="color:var(--dim);padding:10px 0;border-bottom:1px solid rgba(201,168,76,0.06);width:40%">Buyurtma #</td><td style="color:var(--gold);font-weight:700">#{{ $order->id }}</td></tr>
          <tr><td style="color:var(--dim);padding:10px 0;border-bottom:1px solid rgba(201,168,76,0.06)">Ism</td><td style="color:var(--white)">{{ $order->name }}</td></tr>
          <tr><td style="color:var(--dim);padding:10px 0;border-bottom:1px solid rgba(201,168,76,0.06)">Telefon</td><td><a href="tel:{{ $order->phone }}" style="color:var(--gold)">{{ $order->phone }}</a></td></tr>
          <tr><td style="color:var(--dim);padding:10px 0;border-bottom:1px solid rgba(201,168,76,0.06)">Mahsulot</td><td style="color:var(--white)">{{ $order->product->name_uz ?? '—' }}</td></tr>
          <tr><td style="color:var(--dim);padding:10px 0;border-bottom:1px solid rgba(201,168,76,0.06)">Rang</td><td>{{ $order->color ?: '—' }}</td></tr>
          <tr><td style="color:var(--dim);padding:10px 0;border-bottom:1px solid rgba(201,168,76,0.06)">Faktura</td><td>{{ $order->texture ?: '—' }}</td></tr>
          <tr><td style="color:var(--dim);padding:10px 0;border-bottom:1px solid rgba(201,168,76,0.06)">Miqdor</td><td>{{ $order->qty }} {{ $order->product->unit ?? '' }}</td></tr>
          <tr><td style="color:var(--dim);padding:10px 0;border-bottom:1px solid rgba(201,168,76,0.06)">Narx/birlik</td><td>{{ number_format($order->unit_price,0,'.',',') }} UZS</td></tr>
          <tr><td style="color:var(--dim);padding:10px 0;border-bottom:1px solid rgba(201,168,76,0.06)">Jami summa</td><td style="color:var(--gold);font-weight:700;font-size:18px">{{ number_format($order->total_price,0,'.',',') }} UZS</td></tr>
          <tr><td style="color:var(--dim);padding:10px 0;border-bottom:1px solid rgba(201,168,76,0.06)">Izoh</td><td>{{ $order->notes ?: '—' }}</td></tr>
          <tr><td style="color:var(--dim);padding:10px 0">Sana</td><td>{{ $order->created_at->format('d.m.Y H:i') }}</td></tr>
        </table>
      </div>
    </div>
  </div>

  <div>
    <div class="card">
      <div class="card-header"><span class="card-title">Status o'zgartirish</span></div>
      <div style="padding:24px">
        <p style="margin-bottom:16px">Hozirgi: <span class="badge badge-{{ $order->status }}">{{ $order->status_label }}</span></p>
        <form method="POST" action="{{ route('admin.orders.update', $order) }}">
          @csrf @method('PATCH')
          <div class="field">
            <label>Yangi status</label>
            <select name="status">
              @foreach(['new'=>'Yangi','processing'=>'Jarayonda','completed'=>'Bajarildi','cancelled'=>'Bekor qilindi'] as $val=>$lbl)
                <option value="{{ $val }}" {{ $order->status==$val?'selected':'' }}>{{ $lbl }}</option>
              @endforeach
            </select>
          </div>
          <button class="btn btn-primary" style="width:100%">Saqlash</button>
        </form>
        @if($order->product)
        <div style="margin-top:20px;padding-top:20px;border-top:1px solid var(--border)">
          <img src="{{ $order->product->first_image }}" style="width:100%;aspect-ratio:4/3;object-fit:cover;border:1px solid var(--border)">
          <p style="margin-top:10px;font-size:13px;color:var(--dim)">{{ $order->product->name_uz }}</p>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
