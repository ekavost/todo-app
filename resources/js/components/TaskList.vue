<template>
    <v-sheet class="pa-5 ma-5"
        elevation="2">
    <h2>Tareas actuales</h2>
    <v-list>
<!--Incomplete Tasks List-->
        <v-list-subheader>Tareas pendientes</v-list-subheader>
        <v-list-item
            v-for="task in incompletedTasks" :key="task.id"
            @mouseover="task.hovered = true"
            @mouseleave="task.hovered = false"
            :class="{'bg-grey-lighten-4': task.hovered}">
            <v-list-item
                :title='task.title'>

                <template v-slot:append>
                    <v-btn-group>
    <!-- Mark as Completed-->
                        <v-btn @click="toggleCompleteTask(task)" class="bg-transparent"
                               @mouseover="task.markBtnHovered = true"
                               @mouseleave="task.markBtnHovered = false">
                            <v-icon :class="{'text-success': task.markBtnHovered}">mdi-check-bold</v-icon>
                        </v-btn>

    <!-- Edit Task-->
                        <v-btn class="bg-transparent">
                            <v-icon>mdi-pencil-outline</v-icon>
                            <EditTaskForm :upload="upload" :task="task" :remove="removeTask"></EditTaskForm>
                        </v-btn>

    <!-- Remove Task-->
                        <v-btn @click="removeTask(task)" class="bg-transparent" @mouseover="task.removeBtnHovered = true"
                               @mouseleave="task.removeBtnHovered = false">
                            <v-icon :class="{'text-error': task.removeBtnHovered}">mdi-trash-can-outline</v-icon>
                        </v-btn>
                    </v-btn-group>
                </template>
            </v-list-item>
        </v-list-item>
<v-divider></v-divider>
<!--Completed Tasks List-->
        <v-list-subheader>Tareas completas</v-list-subheader>
        <v-list-item
            class="text-disabled"
            v-for="task in completedTasks" :key="task.id"
            @mouseover="task.hovered = true"
            @mouseleave="task.hovered = false"
            :class="{'bg-grey-lighten-3': task.hovered}">
            <v-list-item
                :title='task.title'>
    <!-- Completed Icon-->
                <template v-slot:prepend>
                    <v-icon>mdi-check-bold</v-icon>
                </template>

                <template v-slot:append>
                    <v-btn-group>
    <!-- Mark as Incomplete-->
                        <v-btn @click="toggleCompleteTask(task)" class="bg-transparent"
                               @mouseover="task.undoBtnHovered = true"
                               @mouseleave="task.undoBtnHovered = false">
                            <v-icon :class="{'text-success': task.undoBtnHovered}">mdi-undo</v-icon>
                        </v-btn>
    <!-- Remove Task-->
                        <v-btn @click="removeTask(task)" class="bg-transparent" @mouseover="task.removeBtnHovered = true"
                               @mouseleave="task.removeBtnHovered = false">
                            <v-icon :class="{'text-error': task.removeBtnHovered}">mdi-trash-can-outline</v-icon>
                        </v-btn>
                    </v-btn-group>

                </template>
            </v-list-item>
        </v-list-item>
    </v-list>
    </v-sheet>
</template>
<script>
import EditTaskForm from "./EditTaskForm.vue";
export default {
    components: {
        EditTaskForm,
    },
   props: {
        tasks: Array,
       upload: Function,
   },
    computed: {
        completedTasks() {
            return this.tasks.filter(task => task.completed === true || task.completed === 1);
        },
        incompletedTasks() {
            return this.tasks.filter(task => task.completed === false || task.completed === 0);
        }
    },

    methods: {
        toggleCompleteTask(task) {
            task.completed = !task.completed;
            axios.patch(`/api/tasks/${task.id}`, task)
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.error('Error al completar tarea:', error);
                });
        },

        removeTask(task) {
            axios.delete(`/api/tasks/${task.id}`)
                .then(response => {
                    console.log(response.data);
                })
        .catch(error => {
                    console.error('Error al eliminar tarea:', error);
                });
            this.upload();
        }
    },
}
</script>
