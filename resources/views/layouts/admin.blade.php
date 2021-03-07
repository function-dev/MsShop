<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <title>MultiSport Shop</title>
</head>
<body>

<div class="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a href="{{ route('index') }}" class="nav-link">MSShop</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin') }}" class="nav-link">Заказы</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.catalog') }}" class="nav-link">Товары</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.collection') }}" class="nav-link">Коллекции</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">Выйти</a>
        </li>
    </ul>
</div>

<div class="container admin" id="app">
    @yield('content')
</div>


<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
