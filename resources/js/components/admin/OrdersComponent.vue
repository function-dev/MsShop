<template>
    <div class="orders">
        <h1 class="page-title">Заказы</h1>
        <div class="orders-list">
            <div class="orders__item" v-for="order in orders">
                <div class="orders__item-body">
                    <h3 class="orders__item-title">Заказ №{{ order.id }}</h3>
                    <p class="orders__item-date"><span class="bold">Дата заказа: </span>{{ order.created_at }}</p>
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
                            <th>Размер</th>
                            <th>Коллекция</th>
                            <th>Всего</th>
                        </tr>
                        <tr v-for="product in products">
                            <td>{{ product.product_id }}</td>
                            <td>{{ product.quantity }}x</td>
                            <td>{{ product.price }} ₽</td>
                            <td>{{ product.size }}</td>
                            <td>{{ getProductName(product.product_id) }}</td>
                            <td>{{ getCollectionName(getProductCollection(product.product_id)) }}</td>
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
            orders: [],
            products: [],
            showProduct: undefined,
            hostname: location.protocol + '//' + location.hostname + ':8000',
            collectionList:[],
            allProducts: [],
        }
    },

    methods: {
        show(id){
            if (this.showProduct != id){
                this.showProduct = id
            } else {
                this.showProduct = undefined
            }

            this.getProducts(id)
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

        getFullPrice(){
            let fullPrice = 0

            this.products.forEach((e) => {
                fullPrice += e.price * e.quantity
            })

            return fullPrice
        },

        getOrder(){
            axios.get(this.hostname + '/api/ApiOrder').then((data)=> this.orders = data.data)
        },

        getProducts(id){
            axios.get(this.hostname + '/api/ApiOrdersProduct/' + id).then((data)=>this.products = data.data)
        },

        getAllProducts(){
            return axios.get(this.hostname + '/api/products').then((data)=>this.allProducts = data.data);
        },

        getProductName(id){
            let name
            this.allProducts.forEach((e)=>{
                if (e.id == id){
                    name = e.name
                }
            })
            return name
        },

        getProductCollection (id){
            let name
            this.allProducts.forEach((e)=>{
                if (e.id == id){
                    name = e.collection_id
                }
            })
            return name

        }
    },

    async beforeMount() {
        await this.getCollectionList()
        await this.getAllProducts()
        await this.getOrder()
    },
}
</script>
