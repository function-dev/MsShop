<template>
    <div class="block">
        <div class="block-header">
            <div class="block-header-sort">
                <h2 class="block-title">Каталог</h2>
                <div class="block-dd">
                    <v-select :value="selected" :options="['По умолчанию', 'Большая цена', 'Меньшая цена']" @input="setSelected"></v-select>
                </div>
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
                        <li class="catalog__list-item">
                            <input type="checkbox" id="catalog-1" class="catalog__list-checkbox" value="123" v-on:change="catalogList('123')">
                            <span class="catalog__list-indicator"></span>
                            <label for="catalog-1" class="catalog__list-label">123</label>
                        </li>
                        <li class="catalog__list-item">
                            <input type="checkbox" id="catalog-2" class="catalog__list-checkbox" value="456" v-on:change="catalogList('456')">
                            <span class="catalog__list-indicator"></span>
                            <label for="catalog-2" class="catalog__list-label">456</label>
                        </li>
                    </ul>
                    <p>{{catalogArr}}</p>
                    <button class="catalog-btn btn-white">Показать</button>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    name: "CatalogComponent",
    data() {
        return {
            selected: 'По умолчанию',
            catalog: 0,
            outside: 0,
            catalogArr: [],
        }
    },
    methods: {
        setSelected(value){
            this.selected = value
        },

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
    }
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
