<template>
    <v-app>
        <v-app-bar title="Gestión de tareas">
            <div class="mr-5 font-italic">
                <v-icon class="mr-2">mdi-format-quote-open</v-icon>
                {{ quote || 'Cargando frase...' }}
            </div>

            <template v-slot:extension>
                <v-btn class="bg-deep-orange-darken-1 py-7" block rounded="0">
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
            quote: 'Cargando frase...',
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

        fetchRandomQuote() {
            axios
                .get('https://v2.jokeapi.dev/joke/Any?type=single')
                .then(response => {
                    console.log('Respuesta de la API:', response.data);
                    this.quote = response.data.joke;
                })
                .catch(error => {
                    console.error('Error al obtener la frase:', error);
                    this.quote = 'No se pudo cargar la frase. Inténtalo más tarde.';
                });
        }
    },
    mounted(){
        this.upload();
        this.fetchRandomQuote();
    },
}
</script>
