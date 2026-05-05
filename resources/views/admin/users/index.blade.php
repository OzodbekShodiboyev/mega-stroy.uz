@extends('admin.layout')
@section('title','Foydalanuvchilar')

@section('content')
<div class="card">
  <div class="card-header"><span class="card-title">Foydalanuvchilar ({{ $users->total() }})</span></div>
  <table>
    <thead>
      <tr><th>#</th><th>Ism</th><th>Telefon</th><th>Rol</th><th>Ro'yxat sanasi</th><th></th></tr>
    </thead>
    <tbody>
      @forelse($users as $u)
      <tr>
        <td style="color:var(--dim)">{{ $u->id }}</td>
        <td style="color:var(--white)">{{ $u->name }}</td>
        <td style="color:var(--gold)">{{ $u->phone }}</td>
        <td><span class="badge badge-{{ $u->role }}">{{ $u->role }}</span></td>
        <td style="color:var(--dim);font-size:12px">{{ $u->created_at->format('d.m.Y') }}</td>
        <td style="display:flex;gap:8px;align-items:center">
          <form method="POST" action="{{ route('admin.users.update', $u) }}">
            @csrf @method('PATCH')
            <select name="role" onchange="this.form.submit()" style="background:var(--surface2);border:1px solid var(--border);color:var(--white);padding:6px 10px;font-size:12px;cursor:pointer">
              <option value="user" {{ $u->role=='user'?'selected':'' }}>user</option>
              <option value="admin" {{ $u->role=='admin'?'selected':'' }}>admin</option>
            </select>
          </form>
          @if($u->id !== auth()->id())
          <form method="POST" action="{{ route('admin.users.destroy', $u) }}" onsubmit="return confirm('O\'chirishni tasdiqlaysizmi?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
          </form>
          @endif
        </td>
      </tr>
      @empty
      <tr><td colspan="6" style="text-align:center;color:var(--dim);padding:40px">Foydalanuvchilar yo'q</td></tr>
      @endforelse
    </tbody>
  </table>
  @if($users->hasPages())
  <div style="padding:16px">{{ $users->links() }}</div>
  @endif
</div>
@endsection
