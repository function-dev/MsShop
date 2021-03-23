<template>
    <div class="block" id="cart">
        <div class="block-header">
            <div class="block-header-sort">
                <h2 class="block-title">Корзина</h2>
            </div>
            <p class="block-info">{{ $props.allQuantity }}</p>
        </div>
        <div class="cart" v-if="cart.length != 0">
            <div class="cart__item" v-for="item in cart">
                <div class="cart__item-info">
                    <img :src="'storage/' + item.img" alt="product img" class="cart__item-img">
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
        <transition name="slidedown">
            <order-component v-if="order === 1" :cart="cart" :allPrice="$props.allPrice"></order-component>
        </transition>

        <div class="order"  v-if="cart.length !== 0 && order !== 1" >
            <h3 class="order-text">Сумма заказа: {{ $props.allPrice }} ₽</h3>
            <button class="btn-black" @click="order = 1">Оформить</button>
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
            order: 0
        }
    },
    methods: {
        delProduct(item){
            this.$emit('del-product', item)
        }
    }
}
</script>

<style>
.slidedown-enter-active {
    -moz-transition-duration: 0.3s;
    -webkit-transition-duration: 0.3s;
    -o-transition-duration: 0.3s;
    transition-duration: 0.3s;
    -moz-transition-timing-function: ease-in;
    -webkit-transition-timing-function: ease-in;
    -o-transition-timing-function: ease-in;
    transition-timing-function: ease-in;
}

.slidedown-leave-active {
    -moz-transition-duration: 0.3s;
    -webkit-transition-duration: 0.3s;
    -o-transition-duration: 0.3s;
    transition-duration: 0.3s;
    -moz-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
    -webkit-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
    -o-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
    transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
}

.slidedown-enter-to, .slide-leave {
    max-height: 1000px;
    overflow: hidden;
}

.slidedown-enter, .slide-leave-to {
    overflow: hidden;
    max-height: 0;
}
</style>
