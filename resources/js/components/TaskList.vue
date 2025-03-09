<template>
    <h2>Tareas actuales</h2>
    <v-data-table :hover="true"
                  :items="tasks"
    >
    </v-data-table>
</template>
<script>
import {VDataTable} from "vuetify/components";
export default {
    data(){
        return{
            tasks:[],
        }
    },
    mounted() {
        axios.get('/api/tasks')
            .then(response => {
                this.tasks = response.data;
            })
            .catch(error => {
                console.error('Error al obtener tareas:', error);
            });
    },

}
</script>
