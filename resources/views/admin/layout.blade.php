<!DOCTYPE html>
<html lang="uz">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title','Admin') — Mega Stroy</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Syncopate:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root{--gold:#C9A84C;--bg:#080808;--surface:#111;--surface2:#181818;--border:rgba(201,168,76,0.15);--text:#C2BDB4;--white:#F5F0E8;--dim:#5a5550}
*{margin:0;padding:0;box-sizing:border-box}
body{background:var(--bg);color:var(--text);font-family:'Plus Jakarta Sans',sans-serif;display:flex;min-height:100vh}
a{color:inherit;text-decoration:none}

/* SIDEBAR */
.sidebar{width:240px;background:var(--surface);border-right:1px solid var(--border);display:flex;flex-direction:column;position:fixed;top:0;left:0;height:100vh;z-index:100;overflow-y:auto}
.sidebar-logo{padding:28px 24px;border-bottom:1px solid var(--border);font-family:'Syncopate',sans-serif;font-size:16px;letter-spacing:4px;color:var(--white)}
.sidebar-logo span{color:var(--gold)}
.sidebar-logo small{display:block;font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;letter-spacing:3px;color:var(--dim);margin-top:4px;text-transform:uppercase}
.nav-section{padding:20px 0}
.nav-label{font-size:9px;letter-spacing:3px;text-transform:uppercase;color:var(--dim);padding:8px 24px;margin-bottom:4px}
.nav-item{display:flex;align-items:center;gap:12px;padding:11px 24px;font-size:13px;font-weight:500;color:var(--dim);transition:all .2s;position:relative}
.nav-item:hover{color:var(--white);background:rgba(201,168,76,0.05)}
.nav-item.active{color:var(--gold);background:rgba(201,168,76,0.08)}
.nav-item.active::before{content:'';position:absolute;left:0;top:0;bottom:0;width:3px;background:var(--gold)}
.nav-item i{width:18px;text-align:center;font-size:14px}
.nav-badge{margin-left:auto;background:var(--gold);color:#080808;font-size:10px;font-weight:800;padding:2px 7px;border-radius:10px}
.sidebar-bottom{margin-top:auto;padding:20px 24px;border-top:1px solid var(--border)}
.sidebar-user{font-size:12px;color:var(--dim);margin-bottom:12px}
.sidebar-user strong{display:block;color:var(--white);font-size:13px;margin-bottom:2px}
.btn-logout{display:flex;align-items:center;gap:8px;font-size:12px;color:#e74c3c;cursor:pointer;background:none;border:none;font-family:inherit;padding:0}

/* MAIN */
.main{margin-left:240px;flex:1;display:flex;flex-direction:column;min-height:100vh}
.topbar{background:var(--surface);border-bottom:1px solid var(--border);padding:16px 32px;display:flex;align-items:center;justify-content:space-between}
.topbar-title{font-size:16px;font-weight:600;color:var(--white)}
.topbar-right{display:flex;gap:12px;align-items:center}
.btn{display:inline-flex;align-items:center;gap:8px;padding:10px 20px;font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;cursor:pointer;transition:all .3s;border:none;font-family:inherit}
.btn-primary{background:var(--gold);color:#080808}.btn-primary:hover{background:#E8CC7A}
.btn-outline{background:transparent;border:1px solid var(--border);color:var(--text)}.btn-outline:hover{border-color:var(--gold);color:var(--gold)}
.btn-danger{background:transparent;border:1px solid #e74c3c;color:#e74c3c}.btn-danger:hover{background:#e74c3c;color:#fff}
.btn-sm{padding:7px 14px;font-size:10px}

/* CONTENT */
.content{padding:32px;flex:1}

/* CARDS */
.stat-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;margin-bottom:32px}
.stat-card{background:var(--surface);border:1px solid var(--border);padding:24px;transition:border-color .3s}
.stat-card:hover{border-color:var(--gold)}
.stat-icon{font-size:22px;color:var(--gold);margin-bottom:12px}
.stat-val{font-size:28px;font-weight:700;color:var(--white);line-height:1}
.stat-label{font-size:11px;color:var(--dim);margin-top:6px;letter-spacing:1px;text-transform:uppercase}

/* TABLE */
.card{background:var(--surface);border:1px solid var(--border);margin-bottom:24px}
.card-header{padding:18px 24px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between}
.card-title{font-size:13px;font-weight:600;color:var(--white);letter-spacing:.5px}
table{width:100%;border-collapse:collapse}
th{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--dim);padding:12px 16px;text-align:left;border-bottom:1px solid var(--border);background:var(--surface2)}
td{padding:14px 16px;font-size:13px;border-bottom:1px solid rgba(201,168,76,0.06);vertical-align:middle}
tr:last-child td{border-bottom:none}
tr:hover td{background:rgba(201,168,76,0.03)}

/* BADGES */
.badge{display:inline-block;font-size:10px;font-weight:700;letter-spacing:1px;padding:3px 10px;text-transform:uppercase}
.badge-new{background:rgba(201,168,76,0.15);color:var(--gold)}
.badge-processing{background:rgba(52,152,219,0.15);color:#3498db}
.badge-completed{background:rgba(46,204,113,0.15);color:#2ecc71}
.badge-cancelled{background:rgba(231,76,60,0.15);color:#e74c3c}
.badge-admin{background:rgba(201,168,76,0.15);color:var(--gold)}
.badge-user{background:rgba(90,85,80,0.3);color:var(--dim)}

/* FORM */
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.field{margin-bottom:20px}
.field label{display:block;font-size:11px;letter-spacing:2px;text-transform:uppercase;color:#888;margin-bottom:8px}
.field input,.field select,.field textarea{width:100%;background:var(--surface2);border:1px solid var(--border);color:var(--white);padding:12px 16px;font-size:14px;font-family:inherit;outline:none;transition:border-color .3s}
.field input:focus,.field select,.field textarea:focus{border-color:var(--gold)}
.field select{cursor:pointer}
.field textarea{resize:vertical;min-height:120px}
.field-full{grid-column:1/-1}
.check-row{display:flex;align-items:center;gap:10px;font-size:13px;color:var(--text)}
.check-row input{width:auto}
.form-actions{display:flex;gap:12px;padding-top:8px}

/* ALERT */
.alert{padding:13px 18px;border:1px solid;margin-bottom:24px;font-size:13px;display:flex;align-items:center;gap:10px}
.alert-success{border-color:#2ecc71;background:rgba(46,204,113,0.08);color:#2ecc71}
.alert-error{border-color:#e74c3c;background:rgba(231,76,60,0.08);color:#e74c3c}

/* PAGINATION */
.pagination{display:flex;gap:4px;justify-content:center;margin-top:24px}
.pagination a,.pagination span{display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border:1px solid var(--border);font-size:13px;color:var(--dim);transition:all .3s}
.pagination a:hover{border-color:var(--gold);color:var(--gold)}
.pagination .active span{background:var(--gold);color:#080808;border-color:var(--gold)}

/* PRODUCT IMG */
.prod-img{width:52px;height:52px;object-fit:cover;border:1px solid var(--border)}

@media(max-width:768px){.sidebar{transform:translateX(-100%)}.main{margin-left:0}}
</style>
@stack('styles')
</head>
<body>

<aside class="sidebar">
  <div class="sidebar-logo">MEGA<span>STROY</span><small>Admin Panel</small></div>
  <div class="nav-section">
    <div class="nav-label">Boshqaruv</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <i class="fas fa-chart-line"></i> Dashboard
    </a>
  </div>
  <div class="nav-section">
    <div class="nav-label">Katalog</div>
    <a href="{{ route('admin.products.index') }}" class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
      <i class="fas fa-box"></i> Mahsulotlar
    </a>
    <a href="{{ route('admin.catalog.categories') }}" class="nav-item {{ request()->routeIs('admin.catalog.categories*') ? 'active' : '' }}">
      <i class="fas fa-folder"></i> Kategoriyalar
    </a>
    <a href="{{ route('admin.catalog.units') }}" class="nav-item {{ request()->routeIs('admin.catalog.units*') ? 'active' : '' }}">
      <i class="fas fa-ruler"></i> Birliklar
    </a>
    <a href="{{ route('admin.catalog.colors') }}" class="nav-item {{ request()->routeIs('admin.catalog.colors*') ? 'active' : '' }}">
      <i class="fas fa-palette"></i> Ranglar
    </a>
    <a href="{{ route('admin.catalog.textures') }}" class="nav-item {{ request()->routeIs('admin.catalog.textures*') ? 'active' : '' }}">
      <i class="fas fa-border-all"></i> Fakturalar
    </a>
  </div>
  <div class="nav-section">
    <div class="nav-label">Mijozlar</div>
    <a href="{{ route('admin.orders.index') }}" class="nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
      <i class="fas fa-shopping-cart"></i> Buyurtmalar
      @php $newOrders = \App\Models\Order::where('status','new')->count(); @endphp
      @if($newOrders) <span class="nav-badge">{{ $newOrders }}</span> @endif
    </a>
    <a href="{{ route('admin.messages.index') }}" class="nav-item {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
      <i class="fas fa-envelope"></i> Xabarlar
      @php $unread = \App\Models\ContactMessage::where('is_read',false)->count(); @endphp
      @if($unread) <span class="nav-badge">{{ $unread }}</span> @endif
    </a>
    <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
      <i class="fas fa-users"></i> Foydalanuvchilar
    </a>
    <a href="{{ route('admin.reviews.index') }}" class="nav-item {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
      <i class="fas fa-star"></i> Sharhlar
      @php $pendingReviews = \App\Models\Review::where('status','pending')->count(); @endphp
      @if($pendingReviews) <span class="nav-badge">{{ $pendingReviews }}</span> @endif
    </a>
  </div>
  <div class="nav-section">
    <div class="nav-label">Sayt</div>
    <a href="{{ route('admin.works.index') }}" class="nav-item {{ request()->routeIs('admin.works.*') ? 'active' : '' }}">
      <i class="fas fa-images"></i> Galereya
    </a>
    <a href="{{ route('admin.settings') }}" class="nav-item {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
      <i class="fas fa-cog"></i> Sozlamalar
    </a>
    <a href="{{ url('/') }}" target="_blank" class="nav-item"><i class="fas fa-external-link-alt"></i> Saytni ko'rish</a>
  </div>
  <div class="sidebar-bottom">
    <div class="sidebar-user">
      <strong>{{ auth()->user()->name }}</strong>
      {{ auth()->user()->phone }}
    </div>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Chiqish</button>
    </form>
  </div>
</aside>

<div class="main">
  <div class="topbar">
    <div class="topbar-title">@yield('title','Dashboard')</div>
    <div class="topbar-right">@yield('topbar-actions')</div>
  </div>
  <div class="content">
    @if(session('success'))
      <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
    @endif
    @yield('content')
  </div>
</div>

@stack('scripts')
</body>
</html>
