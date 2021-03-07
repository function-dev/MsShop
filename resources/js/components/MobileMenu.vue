<template>
    <div>
        <div class="mobile-menu">
            <div class="mobile-header">
                <h2>Меню</h2>
                <img src="/img/close.svg" alt="close menu" class="close-menu" @click="() => {$emit('close-menu')}">
            </div>
            <ul class="mobile__nav">
                <li class="mobile__nav-item">
                    <a href="#catalog" class="mobile__nav-link">Каталог</a>
                </li>
                <li class="mobile__nav-item">
                    <a href="#cart" class="mobile__nav-link">Корзина</a>
                </li>
                <li class="mobile__nav-item">
                    <a href="#information" class="mobile__nav-link">Информация</a>
                </li>
                <li class="mobile__nav-item">
                    <a href="#table-size" class="mobile__nav-link">Таблица размеров</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {

            }
        }
    }
</script>
