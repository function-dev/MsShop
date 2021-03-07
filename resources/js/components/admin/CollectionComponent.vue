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
                    <a href="#" class="collection-upd">Редактировать</a>
                    <br>
                    <a href="#" class="collection-del">Удалить</a>
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
            hostname: location.protocol + '//' + location.hostname + ':8000',
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
    },

    async beforeMount() {
        await this.getCollectionList()
    },
}
</script>
