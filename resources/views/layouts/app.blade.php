<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/site.css') }}">

    <title>MultiSport Shop</title>
</head>
<body>

<div class="container">
    <header class="header">
        <h1 class="header-title">MsShop</h1>
        <ul class="header__nav">
            <li class="header__nav-item">
                <a href="#" class="header__nav-link">Каталог</a>
            </li>
            <li class="header__nav-item">
                <a href="#" class="header__nav-link">Корзина</a>
            </li>
            <li class="header__nav-item">
                <a href="#" class="header__nav-link">Информация</a>
            </li>
            <li class="header__nav-item">
                <a href="#" class="header__nav-link">Таблица размеров</a>
            </li>
        </ul>
    </header>
</div>

@yield('content')

</body>
</html>
