<template>
    <div class="product-add">
        <h1 class="page-title">Добавление товара</h1>
        <div class="product__nav">
            <div class="product__nav-item" :class="{active: 1 === step}" @click="step = 1">
                <p class="products__nav-title">Шаг 1</p>
                <p class="products__nav-subtitle">Товар</p>
            </div>
            <div class="product__nav-item" :class="{active: 2 === step}" @click="step = 2">
                <p class="products__nav-title">Шаг 2</p>
                <p class="products__nav-subtitle">Аттрибуты</p>
            </div>
            <div class="product__nav-item" :class="{active: 3 === step}" @click="step = 3">
                <p class="products__nav-title">Шаг 3</p>
                <p class="products__nav-subtitle">Размеры</p>
            </div>
            <div class="product__nav-item" :class="{active: 4 === step}" @click="step = 4">
                <p class="products__nav-title">Шаг 4</p>
                <p class="products__nav-subtitle">Подтверждение</p>
            </div>
        </div>
        <form class="product-form" v-if="step === 1">
            <div class="form-group">
                <label class="form-label" for="collection_id">Коллекция</label>
                <select class="form-input" name="collection_id" id="collection_id" v-model="collectionId">
                    <option :value="item.id" v-for="item in collectionList">{{ getCollectionName(item.id) }}</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="name">Название</label>
                <input class="form-input" type="text" name="name" id="name" v-model="name">
            </div>
            <div class="form-group">
                <label class="form-label" for="desc">Описание</label>
                <textarea class="form-input" name="desc" id="desc" v-model="desc"></textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="img">Изображение</label>
                <input class="form-input" type="text" name="img" id="img" v-model="img">
            </div>
            <div class="form-group">
                <label class="form-label" for="price">Цена</label>
                <input class="form-input" type="number" name="price" id="price" min="0" v-model="price">
            </div>
            <p class="btn-black form-product-btn" @click="addProduct">Следующий шаг</p>
        </form>
        <form class="attr-form" v-else-if="step === 2">
            <div class="attr-group" v-for="(item, index) in attr">
                <div class="form-group">
                    <label :for="'name' + index" class="form-label">Название</label>
                    <input type="text" :id="'name' + index" class="form-input" v-model="item.name">
                </div>
                <div class="form-group">
                    <label :for="'val' + index" class="form-label">Значение</label>
                    <input type="number" :id="'val' + index" class="form-input" min="1" v-model="item.value">
                </div>
            </div>
            <div class="attr-action">
                <span class="btn-black" @click="pushAttr">+</span>
                <span class="btn-black" @click="removeAttr">-</span>
            </div>
            <p class="btn-black form-attr-btn">Следующий шаг</p>
        </form>
        <form class="attr-form" v-else-if="step === 3">
            <div class="quantity-group" v-for="(item, index) in quantity">
                <div class="form-group">
                    <label :for="'size' + index" class="form-label">Размер</label>
                    <select :id="'size' + index" class="form-input" v-model="item.size">
                        <option value="XXS">XXS</option>
                        <option value="XS">XS</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="XXL">XXL</option>
                    </select>
                </div>
                <div class="form-group">
                    <label :for="'quantity' + index" class="form-label">Значение</label>
                    <input type="number" :id="'quantity' + index" class="form-input" min="1" v-model="item.quantity">
                </div>
            </div>
            <div class="attr-action">
                <span class="btn-black" @click="pushQuant">+</span>
                <span class="btn-black" @click="removeQuant">-</span>
            </div>
            <p class="btn-black form-quant-btn">Следующий шаг</p>
        </form>
    </div>
</template>

<script>
export default {
    name: "AddProductComponent",
    data(){
        return{
            collectionId: 1,
            name: '',
            desc: '',
            img: '',
            price: 0,
            step: 1,
            attr:[
                {
                    name: '',
                    value: 0
                },
                {
                    name: '',
                    value: 0
                },
            ],
            quantity:[
                {
                    size: 'XS',
                    quantity: 1
                },
                {
                    size: 'S',
                    quantity: 1
                },
            ],
            collectionList:[],
            hostname: location.protocol + '//' + location.hostname + ':8000',
            productId: null,
        }
    },

    methods: {
        addProduct(){
            axios.post(this.hostname + '/api/ApiProducts', {collection_id: this.collectionId, name: this.name, desc: this.desc, img: this.img, price: parseInt(this.price)}).then((data)=>this.productId = data.data);
            this.step = 2
        },

        pushAttr(){
            let arr = {name: '', value: 0}

            this.attr.push(arr)
        },

        removeAttr(){
            this.attr.splice(-1, 1)
        },

        pushQuant(){
            let arr = {size: '', quantity: 1}

            this.quantity.push(arr)
        },

        removeQuant(){
            this.quantity.splice(-1, 1)
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
    },
    async beforeMount() {
        await this.getCollectionList()
    }
}
</script>
