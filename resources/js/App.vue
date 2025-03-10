<template>
    <v-app>
        <v-app-bar
            title="Gestión de tareas"
            class="text-center">
            <template v-slot:extension>
                <v-btn class="bg-deep-orange-darken-2 py-7" block rounded="0">
                    Crear nueva tarea
                    <CreateTaskForm :upload="upload" :tasks="tasks"></CreateTaskForm>
                </v-btn>
            </template>
        </v-app-bar>

        <v-main>
            <TaskList :tasks="tasks" :upload="upload"></TaskList>
        </v-main>

        <v-footer class="d-flex flex-column">
            <div class="bg-grey-lighten-3 w-100 d-flex justify-space-between px-10 py-5">
                <strong>Prueba para desarrollador web</strong>
                <span>Wondella</span>
            </div>
            <div class="px-4 py-2 bg-grey-darken-2 text-center w-100">
                Ekaterina Vostrikova | 2025
            </div>
        </v-footer>
    </v-app>
</template>

<script>
import axios from "axios";
import CreateTaskForm from './components/CreateTaskForm.vue';
import TaskList from './components/TaskList.vue';
export default{
    components:{
        CreateTaskForm,
        TaskList,
    },
    data(){
        return {
            tasks:[],
        }
    },
    methods:{
        upload(){
            axios.get('/api/tasks')
                .then(response => {
                    this.tasks = response.data;
                })
                .catch(error => {
                    console.error('Error al obtener tareas:', error);
                });
        },
    },
    mounted(){
        this.upload();
    },
}
</script>
