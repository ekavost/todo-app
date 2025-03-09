<template>
    <v-form>
        <v-text-field label="Tarea" v-model="title"></v-text-field>
        <v-textarea label="Descripción" v-model="description"></v-textarea>
        <v-btn class="me-4" type="button" @click.prevent="createTask"> Crear </v-btn>
    </v-form>
</template>

<script>
export default {
    data(){
        return{
            title:'',
            description:'',
            completed:false,
        }
    },
    methods: {
        createTask(){
            console.log(this.title);
            axios.post('/', {
                title: this.title,
                description: this.description
            }).then(response => {console.log(response.data)})
        }
    }
}

</script>
