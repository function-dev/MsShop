<template>
    <div class="block">
        <div class="block-header">
            <div class="block-header-sort">
                <h2 class="block-title">Корзина</h2>
            </div>
            <p class="block-info">{{ $props.allQuantity }}</p>
        </div>
        <div class="cart" v-if="cart.length != 0">
            <div class="cart__item" v-for="item in cart">
                <div class="cart__item-info">
                    <img :src="item.img" alt="product img" class="cart__item-img">
                    <p class="cart__item-title">{{ item.title }}</p>
                    <div class="cart__item-size">
                        <span class="products__size-value">{{ item.size }}</span>
                    </div>
                </div>
                <h3 class="cart__item-price">{{ item.price }} ₽</h3>
                <div class="cart__item-quant">
                    <input type="number" min="1" :max="item.maxQuantity" v-model="item.quantity" class="cart__item-input" @change="() => {$emit('price')}">
                    <p class="cart__item-text">шт.</p>
                </div>
                <p class="cart__item-del" @click="delProduct(item)">Убрать товар</p>
            </div>
        </div>
        <div class="empty-cart" v-if="cart.length == 0">
            <h2 class="empty-title">Ваша корзина пуста!</h2>
            <p class="empty-text">Добавьте товары и они появятся здесь</p>
        </div>
        <div class="order"  v-if="cart.length != 0">
            <h3 class="order-text">Сумма заказа: {{ $props.allPrice }} ₽</h3>
            <button class="btn-black">Оформить</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "CartComponent",

    props: [
        'cart',
        'allPrice',
        'allQuantity'
    ],

    data() {
        return {
            delProduct(item){
                this.$emit('del-product', item)
            }
        }
    },
    methods: {

    }
}
</script>
