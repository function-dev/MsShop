<template>
    <div class="add-collection">
        <h1 class="page-title">Редактирование коллекции</h1>
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

    props: {
        id: { type: String, required: true }
    },

    data(){
        return{
            name: null,
            hostname: location.protocol + '//' + location.hostname + ':8000',
        }
    },

    methods: {
        getCollectionList(){
            return axios.get(this.hostname + '/api/collectionList/').then((data)=>this.collectionList = data.data)
        },

        getCollectionName(id){
            let name
            this.collectionList.forEach((e)=>{
                if (e.id == id){
                    name = e.name
                }
            })

            this.name = name
        },

        saveCollection() {
            axios.put(this.hostname + '/api/ApiCollectionList/' + this.$props.id, {name: this.name})

            document.location = this.hostname + '/admin/collection'
        }
    },

    async beforeMount() {
        await this.getCollectionList()
        await this.getCollectionName(this.$props.id)
    }
}
</script>

