<template>
    <div class="collection">
        <h1 class="page-title">Коллекции</h1>
        <div class="products-block">
            <a :href="route" class="btn-black products-add">Добавить коллекцию</a>
        </div>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Действия</th>
            </tr>
            <tr v-for="collection in collectionList">
                <td>{{ collection.id }}</td>
                <td>{{ collection.name }}</td>
                <td>
                    <p class="products-upd" @click="editCollection(collection.id)">Редактировать</p>
                    <p class="products-del" @click="delCollection(collection.id)">Удалить</p>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
export default {
    name: "CollectionComponent",

    data() {
        return {
            hostname: location.protocol + '//' + location.hostname,
            collectionList:[],
        }
    },

    props: {
        route: { type: String, required: true }
    },

    methods: {
        getCollectionList(){
            return axios.get(this.hostname + '/api/collectionList').then((data)=>this.collectionList = data.data);
        },

        delCollection(id){
            axios.delete(this.hostname + '/api/ApiCollectionList/' + id)

            document.location = this.hostname + '/admin/collection'
        },

        editCollection(id){
            document.location = this.hostname + '/admin/collection/edit/' + id
        }
    },

    async beforeMount() {
        await this.getCollectionList()
    },
}
</script>
