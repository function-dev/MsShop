<template>
    <div class="products">
        <h1 class="page-title">Товары</h1>
        <div class="products-block">
            <div class="search">
                <label class="search-label" for="search">Поиск</label>
                <input type="text" id="search" class="search-input" v-model="search" @input="doSearch">
            </div>
            <a :href="route" class="btn-black products-add">Добавить товар</a>
        </div>
        <table class="table" border="1" v-if="searchProduct.length > 0">
            <tr class="table-headers">
                <th>ID</th>
                <th>Изображение</th>
                <th>Название</th>
                <th>Коллекция</th>
                <th>Действия</th>
            </tr>
            <tr class="table-row" v-for="product in searchProduct">
                <td>{{ product.id }}</td>
                <td><img :src="'../' + product.img" :alt="product.name" class="product-img"></td>
                <td>{{ product.name }}</td>
                <td>{{ getCollectionName(product.collection_id) }}</td>
                <td>
                    <p class="products-upd">Редактировать</p>
                    <p class="products-del" @click="delProduct(product.id)">Удалить</p>
                </td>
            </tr>
        </table>
        <div class="empty-block" v-else>
            <h2 class="empty-title">Ничего не найдено</h2>
            <p class="empty-text">Добавьте товары или проверьте поисковый запрос</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProductComponent",

    data(){
        return{
            allProducts: [],
            hostname: location.protocol + '//' + location.hostname + ':8000',
            collectionList:[],
            search: '',
            searchProduct: [],
        }
    },

    props: {
        route: { type: String, required: true }
    },

    methods: {
        getAllProducts(){
            return axios.get(this.hostname + '/api/products').then((data)=>this.allProducts = data.data)
        },

        getSearchProducts(){
            return axios.get(this.hostname + '/api/products').then((data)=>this.searchProduct = data.data)
        },

        getCollectionList(){
            return axios.get(this.hostname + '/api/collectionList').then((data)=>this.collectionList = data.data)
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

        doSearch() {
            return axios.post(this.hostname + '/api/ApiSearch', {name: this.search}).then((data)=>this.searchProduct = data.data)
        },

        delProduct(id){
            axios.delete(this.hostname + '/api/ApiProducts/' + id)

            document.location = this.hostname + '/admin/catalog'
        }
    },

    async beforeMount() {
        await this.getAllProducts()
        await this.getCollectionList()
        await this.getSearchProducts()
    },
}
</script>
