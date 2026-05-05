@extends('admin.layout')
@section('title', 'Sharhlar')

@section('content')
<div class="topbar">
  <div class="topbar-title">Sharhlar boshqaruvi</div>
</div>
<div class="content">

  @if(session('success'))
  <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
  @endif

  {{-- PENDING --}}
  <div class="card" style="margin-bottom:32px">
    <div class="card-header">
      <div class="card-title">
        Kutayotgan sharhlar
        @if($pending->isNotEmpty())
        <span style="background:rgba(231,76,60,0.15);color:#e74c3c;font-size:10px;font-weight:700;padding:2px 8px;margin-left:8px">{{ $pending->count() }}</span>
        @endif
      </div>
    </div>
    @if($pending->isEmpty())
    <div style="padding:32px;text-align:center;color:var(--dim);font-size:13px">Kutayotgan sharhlar yo'q</div>
    @else
    <table>
      <thead>
        <tr>
          <th>Mahsulot</th>
          <th>Muallif</th>
          <th>Baho</th>
          <th>Sharh</th>
          <th>Sana</th>
          <th>Amal</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pending as $r)
        <tr>
          <td style="max-width:140px">
            <a href="{{ route('product.show', $r->product->slug) }}" target="_blank" style="color:var(--gold);font-size:12px">
              {{ $r->product->name_uz }}
            </a>
          </td>
          <td>{{ $r->reviewer_name }}</td>
          <td style="color:var(--gold);letter-spacing:2px">{{ $r->stars }}</td>
          <td style="max-width:320px;font-size:12px;color:var(--dim)">{{ Str::limit($r->body, 120) }}</td>
          <td style="font-size:12px;color:var(--dim)">{{ $r->created_at->format('d.m.Y') }}</td>
          <td>
            <div style="display:flex;gap:8px">
              <form method="POST" action="{{ route('admin.reviews.approve', $r) }}">
                @csrf @method('PATCH')
                <button type="submit" class="btn btn-sm btn-primary" title="Tasdiqlash">
                  <i class="fas fa-check"></i> Tasdiqlash
                </button>
              </form>
              <form method="POST" action="{{ route('admin.reviews.destroy', $r) }}" onsubmit="return confirm('O\'chirishni tasdiqlaysizmi?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" title="O'chirish">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif
  </div>

  {{-- APPROVED --}}
  <div class="card">
    <div class="card-header">
      <div class="card-title">Tasdiqlangan sharhlar</div>
    </div>
    @if($approved->isEmpty())
    <div style="padding:32px;text-align:center;color:var(--dim);font-size:13px">Tasdiqlangan sharhlar yo'q</div>
    @else
    <table>
      <thead>
        <tr>
          <th>Mahsulot</th>
          <th>Muallif</th>
          <th>Baho</th>
          <th>Sharh</th>
          <th>Sana</th>
          <th>Amal</th>
        </tr>
      </thead>
      <tbody>
        @foreach($approved as $r)
        <tr>
          <td style="max-width:140px">
            <a href="{{ route('product.show', $r->product->slug) }}" target="_blank" style="color:var(--gold);font-size:12px">
              {{ $r->product->name_uz }}
            </a>
          </td>
          <td>{{ $r->reviewer_name }}</td>
          <td style="color:var(--gold);letter-spacing:2px">{{ $r->stars }}</td>
          <td style="max-width:320px;font-size:12px;color:var(--dim)">{{ Str::limit($r->body, 120) }}</td>
          <td style="font-size:12px;color:var(--dim)">{{ $r->created_at->format('d.m.Y') }}</td>
          <td>
            <form method="POST" action="{{ route('admin.reviews.destroy', $r) }}" onsubmit="return confirm('O\'chirishni tasdiqlaysizmi?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div style="padding:16px 24px">{{ $approved->links() }}</div>
    @endif
  </div>

</div>
@endsection
