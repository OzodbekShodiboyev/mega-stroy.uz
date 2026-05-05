<!DOCTYPE html>
<html lang="uz">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ro'yxatdan o'tish — Mega Stroy</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Syncopate:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{background:#080808;color:#C2BDB4;font-family:'Plus Jakarta Sans',sans-serif;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px}
.auth-box{background:#111;border:1px solid rgba(201,168,76,0.18);padding:52px 48px;width:100%;max-width:440px}
.logo{font-family:'Syncopate',sans-serif;font-size:20px;letter-spacing:5px;color:#F5F0E8;text-decoration:none;display:block;margin-bottom:36px;text-align:center}
.logo span{color:#C9A84C}
h1{font-size:24px;font-weight:500;color:#F5F0E8;margin-bottom:8px;text-align:center}
.sub{font-size:13px;color:#5a5550;text-align:center;margin-bottom:36px}
.field{margin-bottom:20px}
label{display:block;font-size:11px;letter-spacing:2px;text-transform:uppercase;color:#888;margin-bottom:8px}
input{width:100%;background:#1A1A1A;border:1px solid rgba(201,168,76,0.18);color:#F5F0E8;padding:13px 16px;font-size:14px;font-family:inherit;outline:none;transition:border-color .3s}
input:focus{border-color:#C9A84C}
.btn{width:100%;padding:15px;background:#C9A84C;color:#080808;border:none;font-size:12px;font-weight:800;letter-spacing:2px;text-transform:uppercase;cursor:pointer;transition:all .3s;margin-top:8px}
.btn:hover{background:#E8CC7A}
.link-row{text-align:center;margin-top:24px;font-size:13px;color:#5a5550}
.link-row a{color:#C9A84C;text-decoration:none}
.alert{padding:12px 16px;border:1px solid;margin-bottom:24px;font-size:13px}
.alert-error{border-color:#e74c3c;background:rgba(231,76,60,0.08);color:#e74c3c}
@media(max-width:480px){.auth-box{padding:36px 24px}}
</style>
</head>
<body>
<div class="auth-box">
  <a href="/" class="logo">MEGA<span>STROY</span></a>
  <h1>Ro'yxatdan o'tish</h1>
  <p class="sub">Yangi akkaunt yarating</p>

  @if(session('error'))
    <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
  @endif

  <form method="POST" action="/register">
    @csrf
    <div class="field">
      <label>Ism Familiya</label>
      <input type="text" name="name" value="{{ old('name') }}" placeholder="Ism Familiya" required autofocus>
    </div>
    <div class="field">
      <label>Telefon raqam</label>
      <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+998 XX XXX XX XX" required>
    </div>
    <div class="field">
      <label>Parol</label>
      <input type="password" name="password" placeholder="Kamida 6 ta belgi" required>
    </div>
    <div class="field">
      <label>Parolni tasdiqlang</label>
      <input type="password" name="password_confirmation" placeholder="Parolni takrorlang" required>
    </div>
    <button type="submit" class="btn">Ro'yxatdan o'tish <i class="fas fa-arrow-right"></i></button>
  </form>
  <div class="link-row">Akkauntingiz bormi? <a href="/login">Kirish</a></div>
</div>
</body>
</html>
