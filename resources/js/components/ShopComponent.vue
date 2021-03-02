<template>
    <div>
        <catalog-component @add-cart="addCart"></catalog-component>

        <cart-component :cart="cart"></cart-component>
    </div>
</template>

<script>
export default {
    name: "ShopComponent",

    data() {
        return {
            cart: [],
            isHere: 0,
        }
    },

    methods: {
        addCart(product){
            if (this.cart.length > 0){
                this.cart.forEach((e) => {
                    if (product.product == e.product){
                        this.isHere = 1
                    }
                })
                if (this.isHere == 0) {
                    this.cart.push(product)
                }
            } else {
                this.cart.push(product)
            }
        },
    }
}
</script>
