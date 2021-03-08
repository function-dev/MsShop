<template>
    <div class="add-collection">
        <h1 class="page-title">Добавление коллекции</h1>
        <div class="form-group">
            <label for="name" class="form-label">Название коллекции</label>
            <input type="text" id="name" class="form-input" v-model="name">
            <p class="btn-black" @click="saveCollection">Добавить</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "AddCollectionComponent",

    data(){
        return{
            name: null,
            hostname: location.protocol + '//' + location.hostname + ':8000',
        }
    },

    methods: {
        saveCollection() {
            axios.post(this.hostname + '/api/ApiCollectionList', {name: this.name})

            document.location = this.hostname + '/admin/collection'
        }
    }
}
</script>
