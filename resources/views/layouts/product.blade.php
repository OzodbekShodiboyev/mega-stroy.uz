<!DOCTYPE html>
<html lang="uz">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Mega Stroy Building')</title>
<meta name="description" content="@yield('meta_description', 'Mega Stroy Building — O\'zbekistondagi yetakchi fasad dekor ishlab chiqaruvchisi.')">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&family=Syncopate:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
@stack('styles')
</head>
<body>
<div class="cursor" id="cursor"></div>
<div class="cursor-follower" id="follower"></div>

@include('partials.navbar')

@yield('content')

@include('partials.footer')

<script src="{{ asset('js/product.js') }}"></script>
@stack('scripts')
</body>
</html>
