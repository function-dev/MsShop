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
            <div class="products-item">
                <div class="products-body">
                    <div class="products-body-info">
                        <h3 class="products-title">Футболка "lorem"</h3>
                        <div class="products__attribute">
                            <p class="products__attribute-item">80% хлопок</p>
                            <p class="products__attribute-item">20% полиэстер</p>
                        </div>
                        <p class="products-desc">
                            Чёрная брендированая футблока “lorem” для всех размеров
                        </p>
                        <div class="products__size">
                            <div class="products__size-item" :class="{active: size[0] == 'XXS'}" @click="switchSize('XXS', 0)">
                                <span class="products__size-value">XXS</span>
                            </div>
                            <div class="products__size-item" :class="{active: size[0] == 'XS'}" @click="switchSize('XS', 0)">
                                <span class="products__size-value">XS</span>
                            </div>
                            <div class="products__size-item" :class="{active: size[0] == 'S'}" @click="switchSize('S', 0)">
                                <span class="products__size-value">S</span>
                            </div>
                            <div class="products__size-item" :class="{active: size[0] == 'M'}" @click="switchSize('M', 0)">
                                <span class="products__size-value">M</span>
                            </div>
                            <div class="products__size-item" :class="{active: size[0] == 'L'}" @click="switchSize('L', 0)">
                                <span class="products__size-value">L</span>
                            </div>
                            <div class="products__size-item" :class="{active: size[0] == 'XL'}" @click="switchSize('XL', 0)">
                                <span class="products__size-value">XL</span>
                            </div>
                            <div class="products__size-item" :class="{active: size[0] == 'XXL'}" @click="switchSize('XXL', 0)">
                                <span class="products__size-value">XXL</span>
                            </div>
                        </div>
                        <div class="products__info">
                            <p class="products__info-quantity">В наличии: 100+ шт.</p>
                            <h3 class="products__info-price">1330 ₽</h3>
                            <button class="btn-black">Купить</button>
                        </div>
                    </div>
                    <img src="img/products/test.png" class="products-body-img">
                </div>
            </div>
            <div class="products-item">
                <div class="products-body">
                    <div class="products-body-info">
                        <h3 class="products-title">Футболка "lorem"</h3>
                        <div class="products__attribute">
                            <p class="products__attribute-item">80% хлопок</p>
                            <p class="products__attribute-item">20% полиэстер</p>
                        </div>
                        <p class="products-desc">
                            Чёрная брендированая футблока “lorem” для всех размеров
                        </p>
                        <div class="products__size">
                            <div class="products__size-item" :class="{active: size[1] == 'XXS'}" @click="switchSize('XXS', 1)">
                                <span class="products__size-value">XXS</span>
                            </div>
                            <div class="products__size-item" :class="{active: size[1] == 'XS'}" @click="switchSize('XS', 1)">
                                <span class="products__size-value">XS</span>
                            </div>
                            <div class="products__size-item" :class="{active: size[1] == 'S'}" @click="switchSize('S', 1)">
                                <span class="products__size-value">S</span>
                            </div>
                            <div class="products__size-item" :class="{active: size[1] == 'M'}" @click="switchSize('M', 1)">
                                <span class="products__size-value">M</span>
                            </div>
                            <div class="products__size-item" :class="{active: size[1] == 'L'}" @click="switchSize('L', 1)">
                                <span class="products__size-value">L</span>
                            </div>
                            <div class="products__size-item" :class="{active: size[1] == 'XL'}" @click="switchSize('XL', 1)">
                                <span class="products__size-value">XL</span>
                            </div>
                            <div class="products__size-item" :class="{active: size[1] == 'XXL'}" @click="switchSize('XXL', 1)">
                                <span class="products__size-value">XXL</span>
                            </div>
                        </div>
                        <div class="products__info">
                            <p class="products__info-quantity">В наличии: 100+ шт.</p>
                            <h3 class="products__info-price">1330 ₽</h3>
                            <button class="btn-black">Купить</button>
                        </div>
                    </div>
                    <img src="img/products/test.png" class="products-body-img">
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
            size: ['123'],
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

        switchSize(value, i){
            Vue.set(this.size, i, value)
        }
    },
    async  beforeMount() {
        await this.getCollectionList()
    },
}
</script>

<style>
.slide-enter-active, .slide-leave-active {
    transition: opacity .1s;
}
.slide-enter, .slide-leave-to /* .fade-leave-active до версии 2.1.8 */ {
    opacity: 0;
}
</style>
