<template>
    <v-app>
        <v-app-bar
            title="Gestión de tareas"
            class="text-center">
        </v-app-bar>

        <v-main>
            <v-btn class="bg-pink py-10" block rounded="0"
                   @click="showTaskForm = !showTaskForm">
                   Crear nueva tarea
            </v-btn>
            <TaskList></TaskList>
            <TaskForm v-if="showTaskForm"></TaskForm>
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
import TaskForm from './components/TaskForm.vue';
import TaskList from './components/TaskList.vue';
export default{
    components:{
        TaskForm,
        TaskList,
    },
    data(){
        return{
            showTaskForm: false,
        }
    },
}
</script>
