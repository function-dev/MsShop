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

<div id="app">
    <sidebar></sidebar>

    @yield('content')

    <footer-component></footer-component>
</div>

<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
