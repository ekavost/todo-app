<template>
    <v-app>
        <!-- App Header -->
        <v-app-bar title="Gestión de tareas">
            <div class="mr-5 font-italic">
                <!-- Displays a random quote -->
                <v-icon class="mr-2">mdi-format-quote-open</v-icon>
                {{ quote || 'Cargando frase...' }}
            </div>

            <template v-slot:extension>
                <!-- Button to open dialog for creating a new task -->
                <v-btn class="bg-deep-orange-darken-1 py-7" block rounded="0">
                    Crear nueva tarea
                    <CreateTaskForm :upload="upload" :tasks="tasks"></CreateTaskForm>
                </v-btn>
            </template>
        </v-app-bar>

        <!-- Main app content -->
        <v-main>
            <TaskList :tasks="tasks" :upload="upload"></TaskList>
        </v-main>

        <!-- Footer -->
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

export default {
    components: {
        CreateTaskForm, // Component for creating a new task
        TaskList, // Component for listing and managing tasks
    },
    data() {
        return {
            tasks: [], // Stores the fetched task data
            quote: 'Cargando frase...', // Placeholder for fetching the random quote
        };
    },
    methods: {
        // Method to fetch tasks from the backend
        upload() {
            axios.get('/api/tasks')
                .then(response => {
                    this.tasks = response.data; // Update tasks with server data
                })
                .catch(error => {
                    console.error('Error al obtener tareas:', error); // Log errors during fetch
                });
        },
        // Fetch a random quote from an external API
        fetchRandomQuote() {
            axios
                .get('https://v2.jokeapi.dev/joke/Any?type=single')
                .then(response => {
                    console.log('Respuesta de la API:', response.data); // Log API response
                    this.quote = response.data.joke; // Set quote
                })
                .catch(error => {
                    console.error('Error al obtener la frase:', error); // Log errors
                    this.quote = 'No se pudo cargar la frase. Inténtalo más tarde.'; // Fallback message
                });
        },
    },
    mounted() {
        this.upload(); // Load tasks on page load
        this.fetchRandomQuote(); // Load random quote on page load
    },
};
</script>
