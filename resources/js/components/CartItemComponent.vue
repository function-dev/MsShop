<template>
    <div class="cart__item">
        <div class="cart__item-info">
            <img :src="cart.img" alt="product img" class="cart__item-img">
            <p class="cart__item-title">{{ cart.name }}</p>
            <div class="cart__item-size">
                <span class="products__size-value">{{ cart.size }}</span>
            </div>
        </div>
        <h3 class="cart__item-price">{{ cart.price }} ₽</h3>
        <div class="cart__item-quant">
            <input type="number" min="1" :max="cart.quantity" v-model="thisQuant" class="cart__item-input" @change="() => {$emit('change-quantity', thisQuant)}">
            <p class="cart__item-text">шт.</p>
        </div>
        <p class="cart__item-del" @click="() => {$emit('del-product', cart.product)}">Убрать товар</p>
    </div>
</template>

<script>
export default {
    name: "CartItemComponent",
    data() {
        return {
            productQuantity: [],
            allPrice: [],
            thisQuant: 1,
        }
    },

    props: [
        'cart',
    ],

    methods: {

    }
}
</script>
