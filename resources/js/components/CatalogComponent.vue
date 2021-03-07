<template>
    <div>
        <div class="block" id="catalog">
            <div class="block-header">
                <div class="block-header-sort">
                    <h2 class="block-title">Каталог</h2>
                </div>
                <button class="block-btn btn-black" @click="openCatalog">Коллекции</button>
            </div>
            <transition name="slide">
                <div class="blur-bg" v-if="catalog == 1">
                    <div class="catalog-menu">
                        <div class="catalog-header">
                            <h2>Коллекции</h2>
                            <img src="/img/close.svg" alt="close menu" class="close-menu" @click="closeCatalog">
                        </div>
                        <div class="catalog-header">
                            <p class="catalog-options" @click="showAll">Выбрать все</p>
                            <p class="catalog-options" @click="hideAll">Убрать все</p>
                        </div>
                        <ul class="catalog__list">
                            <li class="catalog__list-item" v-for="item in collectionList">
                                <input type="checkbox" :id="'catalog-' + item.id" class="catalog__list-checkbox" :value="item.id" v-on:change="catalogList(item.id)">
                                <span class="catalog__list-indicator" @click="checkbox(item.id, item.name)"></span>
                                <label :for="'catalog-' + item.id" class="catalog__list-label">{{item.name}}</label>
                            </li>
                        </ul>
                        <button class="catalog-btn btn-white" @click="sort">Показать</button>
                    </div>
                </div>
            </transition>
            <div class="products">
                <div class="products-item" v-for="product in sortedProduct">
                    <div class="products-body">
                        <div class="products-body-info">
                            <h3 class="products-title">{{product.name}}</h3>
                            <p class="products-collection">{{getCollectionName(product.collection_id)}}</p>
                            <div class="products__attribute">
                                <p class="products__attribute-item" v-for="attr in product.attrs">{{attr.value}}% {{attr.name}}</p>
                            </div>
                            <p class="products-desc">
                                {{product.desc}}
                            </p>
                            <div class="products__size">
                                <div v-for="size in product.quantities" :class="{active: sizeSelect.size == size.size && sizeSelect.product == product.id}" class="products__size-item" @click="switchSize(product.id, size.size, size.id, size.quantity)">
                                    <span class="products__size-value">{{size.size}}</span>
                                </div>
                            </div>
                            <div class="products__info">
                                <p class="products__info-quantity" v-if="quant != 0 && sizeSelect.product == product.id">В наличии: {{ quant }} шт.</p>
                                <h3 class="products__info-price">{{ product.price }} ₽</h3>
                                <button class="btn-black" :class="{disabled: sizeSelect.product != product.id}" @click="addCart(product, sizeSelect)">Купить</button>
                            </div>
                        </div>
                        <img :src="product.img" class="products-body-img">
                    </div>
                </div>
            </div>
        </div>

        <cart-component :cart="cart" :allPrice="allPrice" :allQuantity="allQuantity" @price="price" @del-product="delProduct"></cart-component>
    </div>
</template>

<script>
export default {
    name: "CatalogComponent",

    data() {
        return {
            sortedProduct:[],
            sorting:0,
            catalog: 0,
            outside: 0,
            catalogArr: [],
            collectionList:[],
            hostname: location.protocol + '//' + location.hostname + ':8000',
            sizeSelect: {
                product: -1,
                size: -1,
                id: -1,
            },
            allProducts:{},
            quant: 0,
            cart: [],
            cartItem: {},
            allPrice: 0,
            allQuantity: 0 + ' товаров',
        }
    },

    mounted() {
        if (localStorage.cart) {
            this.cart = JSON.parse(localStorage.cart);
        }
        if (localStorage.price) {
            this.allPrice = localStorage.price;
        }
        if (localStorage.quantity) {
            this.allQuantity = localStorage.quantity;
        }
    },

    methods: {
        openCatalog(){
            this.catalogArr = []
            this.catalog = 1
        },

        closeCatalog(){
            this.catalogArr = []
            this.catalog = 0
            this.outside = 0
        },

        catalogList(value){
            let arr = this.catalogArr
            let check = 0

            check = arr.indexOf(value)

            if (check == -1){
                arr.push(value)
            } else if (check != -1){
                arr.splice(check, 1)
            }
        },

        showAll(){
            this.catalogArr = []
            let val
            let check=document.getElementsByClassName('catalog__list-checkbox')
            for(let i=0;i<check.length;i++)
            {
                if(check[i].type=='checkbox')
                {
                    check[i].checked=true;
                    val = check[i].defaultValue

                    let arr = this.catalogArr
                        arr.push(val)
                }
            }
        },

        hideAll(){
            this.catalogArr = []
            let uncheck=document.getElementsByClassName('catalog__list-checkbox')
            for(let i=0;i<uncheck.length;i++)
            {
                if(uncheck[i].type=='checkbox')
                {
                    uncheck[i].checked=false;
                }
            }
        },

        checkbox(id, value){
            let checkbox = document.getElementById('catalog-' + id)

            this.catalogList(id)

            if (checkbox.checked == false){
                checkbox.checked = true
            } else {
                checkbox.checked = false
            }
        },

        getCollectionList(){
            return axios.get(this.hostname + '/api/collectionList').then((data)=>this.collectionList = data.data);
        },

        getAllProducts(){
            return axios.get(this.hostname + '/api/products').then((data)=>this.allProducts = data.data);
        },
        getSortProducts(){
            return this.sortedProduct = this.allProducts;
        },

        switchSize(id, value, sizeId, quant){
            this.sizeSelect.product = id
            this.sizeSelect.size = value
            this.sizeSelect.id = sizeId

            this.quant = quant
        },

        addCart(product, size){
            let max = 0
            let check = 0
            let i = 0
            let a = 0

            if (size.size == -1 || size.product != product.id){
                return
            }

            product.quantities.forEach((e) => {
                if (size.id == e.id){
                    max = e.quantity
                }
            })

            this.cart.forEach((e) => {
                if (product.id == e.id & size.size == e.size){
                    check = 1
                    a = i
                }
                i++
            })

            if (check == 0){
                this.cartItem = {
                    id: product.id,
                    img: product.img,
                    title: product.name,
                    size: size.size,
                    price: product.price,
                    quantity: 1,
                    maxQuantity: max
                }

                this.cart.push(this.cartItem)
            }

            const parsed = JSON.stringify(this.cart);
            localStorage.setItem('cart', parsed);

            this.price()
        },

        price(){
            let price = 0

            this.cart.forEach((e) => {
                price += e.price * e.quantity
            })

            this.allPrice = price


            const parsed2 = JSON.stringify(this.cart);
            localStorage.setItem('cart', parsed2);

            const parsed = this.allPrice;
            localStorage.setItem('price', parsed);

            this.quantity()
        },

        quantity(){
            let quantity = 0
            let last = 0
            let word = ' товаров'



            this.cart.forEach((e) => {
                quantity += parseInt(e.quantity)
            })

            if (quantity > 19){
                last = quantity.toString().substr(-1)
                last = parseInt(last)
            } else {
                last = quantity
            }

            if (last == 1){
                word = ' товар'
            } else if (1 < last & last < 5){
                word = ' товара'
            } else{
                word = ' товаров'
            }

            this.allQuantity = quantity + word

            const parsed = this.allQuantity;
            localStorage.setItem('quantity', parsed);
        },

        delProduct(item){
            let i = 0
            let a = 0

            this.cart.forEach((e) => {
              if (item.id == e.id && item.size == e.size){
                  a = i
              }
              i++
            })

            this.cart.splice(a, 1)

            const parsed = JSON.stringify(this.cart);
            localStorage.setItem('cart', parsed);

            this.price()
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
        sort(){
            this.sortedProduct = []
            this.sorting = this.catalogArr
            this.catalog = 0
            this.sorting.forEach((e)=>{
                this.sortedProduct.push(this.allProducts.filter(product => product.collection_id == e));
            })
            this.sortedProduct = this.sortedProduct.flat()

        },
    },
    async  beforeMount() {
        await this.getCollectionList()
        await this.getAllProducts()
        await this.getSortProducts()
    },
}
</script>

<style>
.slide-enter-active, .slide-leave-active {
    transition: opacity .1s;
}
.slide-enter, .slide-leave-to {
    opacity: 0;
}
</style>
