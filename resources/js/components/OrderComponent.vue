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
            <button class="btn-black" @click="setOrder">Заказать</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "OrderComponent.vue",

    data() {
        return {
            hostname: location.protocol + '//' + location.hostname + ':8000',
            name: '',
            surname: '',
            patronymic: '',
            tel: '',
            mail: '',
            address: '',
            index: '',
            comment: '',
            orderId: null,
            size: '',
        }
    },

    props: [
        'cart',
        'allPrice'
    ],

    methods: {
        setOrder(){
            axios.post(this.hostname + '/api/ApiOrder', {
                surname: this.surname,
                name: this.name,
                patronymic: this.patronymic,
                tel: this.tel,
                mail: this.mail,
                address: this.address,
                index: this.index,
                comment: this.comment
            }).then((data)=>this.setOrderProduct(data.data.id))
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
        },
    },
}
</script>
