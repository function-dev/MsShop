@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="banner-min block">
            <h2 class="banner-title">MultiSport Shop</h2>
            <img src="{{ asset('img/Banner 1.png') }}" alt="banner img" class="banner-img">
        </div>

        <shop-component></shop-component>

        <div class="block">
            <div class="block-header">
                <h2 class="block-title">Информация</h2>
            </div>
            <div class="info">
                <div class="info-block">
                    <h3 class="info-title">Контакты</h3>
                    <div class="link-block">
                        <a href="#" class="info-link">MsShop@info.com</a>
                        <a href="#" class="info-link">+7 (911) 123-45-67</a>
                    </div>
                    <h3 class="info-title">Социальные сети</h3>
                    <div class="social">
                        <div class="social__link">
                            <img src="img/vk.svg" alt="vk" class="social__link-icon">
                            <img src="img/vk-hov.svg" alt="vk" class="social__link-icon-hover">
                        </div>
                        <div class="social__link">
                            <img src="img/yt.svg" alt="vk" class="social__link-icon">
                            <img src="img/yt-hov.svg" alt="vk" class="social__link-icon-hover">
                        </div>
                        <div class="social__link">
                            <img src="img/inst.svg" alt="vk" class="social__link-icon">
                            <img src="img/inst-hov.svg" alt="vk" class="social__link-icon-hover">
                        </div>
                    </div>
                    <h3 class="info-title">Адрес</h3>
                    <p class="info-text">Санкт-Петербург, ул. Пушкина, дом 1</p>
                </div>
                <div class="info-block">
                    <h3 class="info-title">Доставка</h3>
                    <p class="info-text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer et nisi id lacus sollicitudin sagittis.
                        Nam aliquet metus dui, ut malesuada mi convallis bibendum. Quisque dapibus ut libero et aliquet.
                        Donec nunc eros, bibendum eu mauris nec, malesuada consectetur dui. Etiam dictum accumsan massa et fermentum.
                        Integer ac ligula vel sapien sodales tincidunt a nec nunc. Sed semper nunc aliquam sapien faucibus auctor at at est.
                        <br><br>
                        Pellentesque faucibus felis vel ligula iaculis sollicitudin. Ut eget porta massa. Vestibulum placerat ex turpis, a pharetra velit egestas condimentum.
                        Etiam pharetra velit nulla, id hendrerit arcu vulputate quis. Maecenas vel ante dolor. Nulla vulputate rutrum tortor eget laoreet.
                        Aliquam blandit faucibus tempus.
                    </p>
                </div>
            </div>
        </div>

        <table-size-component></table-size-component>
    </div>

@endsection
