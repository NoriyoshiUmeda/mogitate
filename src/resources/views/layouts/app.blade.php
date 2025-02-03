<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '商品一覧')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('styles')
</head>
<body>
   <header class="header">
    <div class="container">
        <a href="{{ route('products.index') }}" class="logo">mogitate</a>
    </div>
   </header>
   <main class="main">
    @yield('content')
   </main>
</body>
</html>


