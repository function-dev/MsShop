<template>
    <div class="block">
        <div class="block-header">
            <div class="block-header-sort">
                <h2 class="block-title">Корзина</h2>
            </div>
            <p class="block-info">2 товара</p>
        </div>

        <div class="cart">
            <cart-item-component v-for="item in cart" :cart="item" @del-product="delProduct" @change-quantity="changeQuantity"></cart-item-component>
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
            thisQuant:'',
        }
    },

    props: [
        'cart'
    ],

    methods: {
        delProduct(id){
            let i = 0

            this.$props.cart.forEach((e) => {
                if (id == e.product){
                    this.$props.cart.splice(i, 1)
                }
                i++
            })
        },

        changeQuantity(val){
            console.log(val)
            this.thisQuant = val;
        }
    }
}
</script>

