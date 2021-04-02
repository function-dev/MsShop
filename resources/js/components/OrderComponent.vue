<template>
    <div>
        <div id="order">
            <div class="order-form">
                <div class="order__group">
                    <label for="name" class="order__group-label">Имя*</label>
                    <input type="text" id="name" class="order__group-input" placeholder="Имя" v-model="name">
                </div>
                <div class="order__group">
                    <label for="surname" class="order__group-label">Фамилия</label>
                    <input type="text" id="surname" class="order__group-input" placeholder="Фамилия" v-model="surname">
                </div>
                <div class="order__group">
                    <label for="patronymic" class="order__group-label">Отчество</label>
                    <input type="text" id="patronymic" class="order__group-input" placeholder="Отчество" v-model="patronymic">
                </div>
                <div class="order__group">
                    <label for="phone" class="order__group-label">Номер телефона*</label>
                    <input type="tel" id="phone" class="order__group-input" placeholder="Номер телефона" v-model="tel">
                </div>
                <div class="order__group">
                    <label for="email" class="order__group-label">Электронная почта*</label>
                    <input type="email" id="email" class="order__group-input" placeholder="E-mail" v-model="mail">
                </div>
                <div class="order__group">
                    <label for="index" class="order__group-label">Почтовый индекс</label>
                    <input type="text" id="index" class="order__group-input" placeholder="Индекс" v-model="index">
                </div>
                <div class="order__group">
                    <label for="address" class="order__group-label">Место проживания*</label>
                    <input type="text" id="address" class="order__group-input" placeholder="Адрес" v-model="address">
                </div>
                <div class="order__group">
                    <label for="comment" class="order__group-label">Комментарий</label>
                    <textarea type="text" id="comment" class="order__group-input" placeholder="Комментарий" v-model="comment"></textarea>
                </div>
            </div>
            <p class="order-comment">* - Обязательные поля ввода</p>
        </div>
        <div class="order">
            <h3 class="order-text">Сумма заказа: {{ $props.allPrice }} ₽</h3>
            <h3 class="order-error" v-if="errorCheck !== null">Не заполнены обязательные поля</h3>
            <button class="btn-black" @click="pay">Заказать</button>
        </div>


        <div class="popup-thanks" v-if="thanks === 1">
            <div class="popup-body">
                <h3 class="popup-title">Спасибо за Ваш заказ!</h3>
                <p class="popup-text">Номер вашего заказа: {{ orderId }}</p>
                <button class="btn-black" @click="refreshPage">Закрыть</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "OrderComponent.vue",

    data() {
        return {
            hostname: location.protocol + '//' + location.hostname,
            name: null,
            surname: '',
            patronymic: '',
            tel: null,
            mail: null,
            address: null,
            index: '',
            comment: '',
            orderId: null,
            size: '',
            errorCheck: null,
            thanks: 0,
        }
    },

    props: [
        'cart',
        'allPrice'
    ],

    methods: {
        pay(){
            if (this.name === null | this.tel === null | this.mail === null | this.address === null){
                this.errorCheck = 'error'
                return
            }

            ipayCheckout({
                    amount: this.$props.allPrice,
                    currency:'RUB',
                    description: 'Покупка товаров'},
                function(order) { showSuccessfulPurchase(order) },
                function(order) { showFailurefulPurchase(order) }
            )
        },


        showSuccessfulPurchase(){
            axios
                .post(this.hostname + '/api/ApiOrder', {
                    surname: this.surname,
                    name: this.name,
                    patronymic: this.patronymic,
                    tel: this.tel,
                    mail: this.mail,
                    address: this.address,
                    index: this.index,
                    comment: this.comment
                })
                .then((data)=>this.setOrderProduct(data.data.id))
                .catch((error) => this.errorCheck = error)
        },

        setOrderProduct(id){
            this.$props.cart.forEach((e) => {
                axios.post(this.hostname + '/api/ApiOrdersProduct', {
                    order_id: id,
                    product_id: e.id,
                    quantity: e.quantity,
                    price: e.price,
                    size: e.size
                })
            })

            this.orderId = id

            localStorage.clear();

            this.thanks = 1
        },

        refreshPage(){
            document.location = '/'
        }
    },
}
</script>
