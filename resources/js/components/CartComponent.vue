<template>
    <div class="block">
        <div class="block-header">
            <div class="block-header-sort">
                <h2 class="block-title">Корзина</h2>
            </div>
            <p class="block-info">2 товара</p>
        </div>

        <div class="cart">
            <cart-item-component v-for="item in cart" :cart="item"></cart-item-component>
        </div>
        <div class="order">
            <h3 class="order-text">Сумма заказа: 27 000 ₽</h3>
            <button class="btn-black">Оформить</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "CartComponent",
    data() {
        return {

        }
    },

    props: [
        'cart'
    ],

    methods: {

    }
}
</script>

