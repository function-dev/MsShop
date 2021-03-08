<template>
    <div class="product-add">
        <h1 class="page-title">Добавление товара</h1>
        <div class="product__nav">
            <div class="product__nav-item active">
                <p class="products__nav-title">Шаг 1</p>
                <p class="products__nav-subtitle">Товар</p>
            </div>
            <div class="product__nav-item">
                <p class="products__nav-title">Шаг 2</p>
                <p class="products__nav-subtitle">Аттрибуты</p>
            </div>
            <div class="product__nav-item">
                <p class="products__nav-title">Шаг 3</p>
                <p class="products__nav-subtitle">Размеры</p>
            </div>
        </div>
        <form class="product-form" method="post">
            <select name="collection_id" v-model="collectionId">
                <option value="1">Sprint 2020</option>
                <option value="2">Balticman 2021</option>
            </select>
            <input type="text" name="name" v-model="name">
            <textarea name="desc" cols="30" rows="10" v-model="desc"></textarea>
            <input type="text" name="img" v-model="img">
            <input type="number" name="price" min="0" v-model="price">
            <button class="btn-black" type="submit">Добавить</button>
        </form>
    </div>
</template>

<script>
export default {
    name: "AddProductComponent",
    data(){
        return{
            collectionId: 0,
            name: 0,
            desc: 0,
            img: 0,
            price: 0
        }
    },

    methods: {
        addProduct(){
            return axios.post(this.hostname + '/api/ApiProducts', {collection_id: this.collectionId, name: this.name, desc: this.desc, img: this.img, price: this.price});
        }
    },
}
</script>
