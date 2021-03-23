<template>
    <div class="product-add">
        <h1 class="page-title">Редактирование товара</h1>
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
                <select class="form-input" name="collection_id" id="collection_id" v-model="product[0].collection_id">
                    <option :value="item.id" v-for="item in collectionList">{{ getCollectionName(item.id) }}</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="name">Название</label>
                <input class="form-input" type="text" name="name" id="name" v-model="product[0].name">
            </div>
            <div class="form-group">
                <label class="form-label" for="desc">Описание</label>
                <textarea class="form-input" name="desc" id="desc" v-model="product[0].desc"></textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="img">Изображение</label>
                <input class="form-input" type="text" name="img" id="img" v-model="product[0].img">
            </div>
            <div class="form-group">
                <label class="form-label" for="price">Цена</label>
                <input class="form-input" type="number" name="price" id="price" min="0" v-model="product[0].price">
            </div>
            <p class="btn-black form-product-btn" @click="nextStep">Следующий шаг</p>
        </form>
        <form class="attr-form" v-else-if="step === 2">
            <div class="attr-group" v-for="(item, index) in product[0].attrs">
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
            <p class="btn-black" @click="nextStep">Следующий шаг</p>
        </form>
        <form class="attr-form" v-else-if="step === 3">
            <div class="attr-group" v-for="(item, index) in product[0].quantities">
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
            <p class="btn-black" @click="nextStep">Следующий шаг</p>
        </form>
        <div class="add-product" v-else-if="step === 4">
            <ul>
                <li><span class="bold">Название:</span>{{ product[0].name }}</li>
                <li><span class="bold">Коллекция:</span>{{ getCollectionName(product[0].collectionId) }}</li>
                <li><span class="bold">Описание:</span>{{ product[0].desc }}</li>
                <li><span class="bold">Цена:</span>{{ product[0].price }}</li>
                <li>
                    <span class="bold">Аттрибуты:</span>
                    <ul>
                        <li v-for="item in product[0].attrs">{{ item.name + ' - ' + item.value }}</li>
                    </ul>
                </li>
                <li>
                    <span class="bold">Размеры:</span>
                    <ul>
                        <li v-for="item in product[0].quantities">{{ item.size + ' - ' + item.quantity }}</li>
                    </ul>
                </li>
            </ul>
            <button class="btn-black" @click="saveProduct($props.id)">Сохранить товар</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "AddProductComponent",
    data(){
        return{
            product: [],
            collectionList:[],
            hostname: location.protocol + '//' + location.hostname + ':8000',
            productId: null,
            step: 1,
        }
    },

    props: {
        id: { type: String, required: true }
    },

    methods: {
        nextStep(){
            this.step += 1
        },

        pushAttr(){
            let arr = {name: '', value: 0}

            this.product[0].attrs.push(arr)
        },

        removeAttr(){
            this.product[0].attrs.splice(-1, 1)
        },

        pushQuant(){
            let arr = {size: '', quantity: 1}

            this.product[0].quantity.push(arr)
        },

        removeQuant(){
            this.product[0].quantity.splice(-1, 1)
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

        getProduct(id){
            axios.get(this.hostname + '/api/ApiProducts/' + id).then((data)=>this.product = data.data);
        },

        saveProduct(id){
            axios.put(this.hostname + '/api/ApiProducts/' + id, {
                collection_id: this.product[0].collection_id,
                name: this.product[0].name,
                desc: this.product[0].desc,
                img: this.product[0].img,
                price: this.product[0].price,
            });

            this.saveAttr(id)
        },

        saveAttr(id){
            let arr = this.product[0].attrs

            axios.put(this.hostname + '/api/ApiAttr/' + id, {arr: arr})

            this.saveQuantity(id)
        },

        saveQuantity(id){
            let arr = this.product[0].quantities

            axios.put(this.hostname + '/api/ApiQuantity/' + id, {arr: arr})

            document.location = this.hostname + '/admin/catalog'
        }
    },
    async beforeMount() {
        await this.getCollectionList()
        await this.getProduct(this.$props.id)
    }
}
</script>
