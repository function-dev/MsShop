<template>
    <div class="orders">
        <h1 class="page-title">Заказы</h1>
        <div class="orders-list">
            <div class="orders__item" v-for="order in orders">
                <div class="orders__item-body">
                    <h3 class="orders__item-title">Заказ №{{ order.id }}</h3>
                    <p class="orders__item-date"><span class="bold">Дата заказа: </span>{{ order.date }}</p>
                    <p class="orders__item-name"><span class="bold">ФИО: </span>{{ order.surname }} {{ order.name }} {{ order.patronymic }}</p>
                    <p class="orders__item-tel"><span class="bold">Телефон: </span>{{ order.tel }}</p>
                    <p class="orders__item-mail"><span class="bold">Почта: </span>{{ order.mail }}</p>
                    <p class="orders__item-address"><span class="bold">Адрес: </span>{{ order.address }}, {{ order.index }}</p>
                    <p class="orders__item-comment"><span class="bold">Комментарий: </span>{{ order.comment }}</p>
                </div>
                <button class="btn-black" @click="show(order.id)">Подробнее</button>
                <div class="orders__item-products" v-if="showProduct === order.id">
                    <table class="orders-table">
                        <tr>
                            <th>ID товара</th>
                            <th>Кол-во</th>
                            <th>Цена за шт.</th>
                            <th>Название</th>
                            <th>Коллекция</th>
                            <th>Всего</th>
                        </tr>
                        <tr v-for="product in order.products">
                            <td>{{ product.productId }}</td>
                            <td>{{ product.quantity }}x</td>
                            <td>{{ product.price }} ₽</td>
                            <td>{{ product.title }}</td>
                            <td>{{ getCollectionName(product.collectionId) }}</td>
                            <td>{{ getProductPrice(product.quantity, product.price) }} ₽</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><span class="bold">Итого: </span></td>
                            <td>{{ getFullPrice(order.id) }} ₽</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "OrdersComponent",

    data(){
        return{
            orders: [
                {
                    id: 1,
                    date: '06.03.2021',
                    surname: 'Иванов',
                    name: 'Иван',
                    patronymic: 'Иванович',
                    tel: '+79991234567',
                    mail: 'mail@mail.ru',
                    address: 'Россия, г. Санкт-Петербург, ул. Пушкина, д. Колотушкина',
                    index: '123456',
                    comment: 'Тут типа такой комментарий крутой, вот да, а ещё тут буквы чтобы проверить насколько много букав можно писать и все будет видно хорошо.',
                    products: [
                        {
                            productId: 1,
                            quantity: 2,
                            price: 1200,
                            title: 'Футболка',
                            collectionId: 1,
                        }
                    ]
                }
            ],
            showProduct: undefined,
            hostname: location.protocol + '//' + location.hostname + ':8000',
            collectionList:[],
        }
    },

    methods: {
        show(id){
            if (this.showProduct != id){
                this.showProduct = id
            } else {
                this.showProduct = undefined
            }
        },

        getCollectionList(){
            return axios.get(this.hostname + '/api/collectionList').then((data)=>this.collectionList = data.data);
        },

        getCollectionName(id){
            let name
            this.collectionList.forEach((e)=>{
                if (e.id == id){
                    name = e.name
                }
            })
            return name
        },

        getProductPrice(quantity, price){
            let fullPrice = 0

            fullPrice = quantity * price

            return fullPrice
        },

        getFullPrice(id){
            let order = this.orders.filter(order => order.id === id)
            let fullPrice = 0

            order[0].products.forEach((e) => {
                fullPrice += e.price * e.quantity
            })

            return fullPrice
        }
    },

    async beforeMount() {
        await this.getCollectionList()
    },
}
</script>
