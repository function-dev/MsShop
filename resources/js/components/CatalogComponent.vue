<template>
    <div class="block">
        <div class="block-header">
            <div class="block-header-sort">
                <h2 class="block-title">Каталог</h2>
            </div>
            <button class="block-btn btn-black" @click="openCatalog">Коллекции</button>
        </div>
        <transition name="slide">
            <div class="blur-bg" v-if="catalog == 1">
                <div class="catalog-menu" v-click-outside="outsideClose">
                    <div class="catalog-header">
                        <h2>Каталог</h2>
                        <img src="/img/close.svg" alt="close menu" class="close-menu" @click="closeCatalog">
                    </div>
                    <div class="catalog-header">
                        <p class="catalog-options" @click="showAll">Выбрать все</p>
                        <p class="catalog-options" @click="hideAll">Убрать все</p>
                    </div>
                    <ul class="catalog__list">
                        <li class="catalog__list-item" v-for="item in collectionList">
                            <input type="checkbox" :id="'catalog-' + item.id" class="catalog__list-checkbox" :value="item.name" v-on:change="catalogList(item.name)">
                            <span class="catalog__list-indicator" @click="checkbox(item.id, item.name)"></span>
                            <label :for="'catalog-' + item.id" class="catalog__list-label">{{item.name}}</label>
                        </li>
                    </ul>
                    <button class="catalog-btn btn-white">Показать</button>
                </div>
            </div>
        </transition>
        <div class="products">
            <div class="products-item" v-for="product in allProducts">
                <div class="products-body">
                    <div class="products-body-info">
                        <h3 class="products-title">{{product.name}}</h3>
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
                            <p class="products__info-quantity" v-if="quant.quantity != 0 && sizeSelect.product == product.id">В наличии: {{ quant.quantity }} шт.</p>
                            <h3 class="products__info-price">{{ product.price }} ₽</h3>
                            <button class="btn-black" @click="() => {$emit('add-cart', product = Object.assign(product, sizeSelect, quant, thisQuant))}">Купить</button>
                        </div>
                    </div>
                    <img :src="product.img" class="products-body-img">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CatalogComponent",
    data() {
        return {
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
            quant: {quantity: 0},
            cartAdd: {},
            thisQuant: {thisQuant: 1}
        }
    },
    methods: {
        openCatalog(){
            this.catalog = 1
        },

        closeCatalog(){
            this.catalogArr = []
            this.catalog = 0
            this.outside = 0
        },

        outsideClose(){
            this.catalogArr = []
            if (this.outside == 0){
                this.outside = 1
            } else if (this.outside == 1){
                this.catalog = 0
                this.outside = 0
            }
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

            this.catalogList(value)

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

        switchSize(id, value, sizeId, quant){
            this.sizeSelect.product = id
            this.sizeSelect.size = value
            this.sizeSelect.id = sizeId

            this.quant.quantity = quant
        },
    },
    async  beforeMount() {
        await this.getCollectionList()
        await this.getAllProducts()
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
