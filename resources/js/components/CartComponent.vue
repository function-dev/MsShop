<template>
    <div class="block">
        <div class="block-header">
            <div class="block-header-sort">
                <h2 class="block-title">Корзина</h2>
            </div>
            <p class="block-info">2 товара</p>
        </div>
        <div class="cart">
            <div class="cart__item">
                <div class="cart__item-info">
                    <img src="img/products/test.png" alt="product img" class="cart__item-img">
                    <p class="cart__item-title">Футболка "lorem"</p>
                    <div class="cart__item-size">
                        <span class="products__size-value">M</span>
                    </div>
                </div>
                <h3 class="cart__item-price">1330 ₽</h3>
                <div class="cart__item-quant">
                    <input type="number" min="1" max="3" value="1" class="cart__item-input">
                    <p class="cart__item-text">шт.</p>
                </div>
                <p class="cart__item-del">Убрать товар</p>
            </div>
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
    methods: {

    }
}
</script>
