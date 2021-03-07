<template>
    <div>
        <div class="container">
            <header class="header">
                <h1 class="header-title">MsShop</h1>
                <ul class="header__nav">
                    <li class="header__nav-item">
                        <a href="#catalog" class="header__nav-link">Каталог</a>
                    </li>
                    <li class="header__nav-item">
                        <a href="#cart" class="header__nav-link">Корзина</a>
                    </li>
                    <li class="header__nav-item">
                        <a href="#information" class="header__nav-link">Информация</a>
                    </li>
                    <li class="header__nav-item">
                        <a href="#table-size" class="header__nav-link">Таблица размеров</a>
                    </li>
                </ul>
                <img src="img/menu.svg" alt="menu" class="header__nav-mobile" v-on:click="openMenu">
            </header>
        </div>

        <transition name="slide">
            <div class="blur-bg" v-if="menu == 1"></div>
        </transition>
        <mobile-menu v-if="menu == 1" @close-menu="closeMenu"></mobile-menu>
    </div>
</template>

<script>
export default {
    name: "Sidebar",
    data() {
        return {
            menu: 0,
            outside: 0,
        }
    },
    methods: {
        openMenu(){
            this.menu = 1;
        },

        closeMenu(){
            this.menu = 0;
            this.outside = 0
        },
    }
}
</script>



<style>
.slide-enter-active, .slide-leave-active {
    transition: opacity .1s;
}
.slide-enter, .slide-leave-to /* .fade-leave-active до версии 2.1.8 */ {
    opacity: 0;
}
</style>
