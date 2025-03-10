<template>
    <v-sheet class="pa-5 ma-5"
             elevation="2">
        <h2>Tareas actuales</h2>
        <v-list>
<!--Incomplete Tasks List-->
            <v-list-subheader class="text-deep-orange-darken-3">Tareas pendientes</v-list-subheader>
            <v-list-item
                v-for="task in uncompletedTasks" :key="task.id"
                @mouseover="task.hovered = true"
                @mouseleave="task.hovered = false"
                :class="{'bg-grey-lighten-4': task.hovered}">
                <v-list-item :title="task.title">
    <!-- Show description -->
                    <v-list-item-subtitle>{{ task.description }}</v-list-item-subtitle>
                    <template v-slot:append>
                        <v-btn-group>
    <!-- Mark as Completed-->
                            <v-btn @click="toggleTaskCompletion(task)" class="bg-transparent"
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
            <v-divider class="mt-3"></v-divider>

<!--Completed Tasks List-->
            <v-list-subheader class="text-deep-orange-darken-3">Tareas completas</v-list-subheader>
            <v-list-item
                class="text-disabled"
                v-for="task in completedTasks" :key="task.id"
                @mouseover="task.hovered = true"
                @mouseleave="task.hovered = false"
                :class="{'bg-grey-lighten-3': task.hovered}">
                <v-list-item :title="task.title">
    <!-- Show description -->
                    <v-list-item-subtitle>{{ task.description }}</v-list-item-subtitle>
                    <!-- Completed Icon-->
                    <template v-slot:prepend>
                        <v-icon>mdi-check-bold</v-icon>
                    </template>

                    <template v-slot:append>
                        <v-btn-group>
    <!-- Mark as Incomplete-->
                            <v-btn @click="toggleTaskCompletion(task)" class="bg-transparent"
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
        uncompletedTasks() {
            return this.tasks.filter(task => task.completed === false || task.completed === 0);
        }
    },

    methods: {
        toggleTaskCompletion(task) {
            task.completed = !task.completed;
            this.makeApiRequest('patch', `/api/tasks/${task.id}`, task, 'Error al completar tarea');
        },
        removeTask(task) {
            this.makeApiRequest('delete', `/api/tasks/${task.id}`, null, 'Error al eliminar tarea')
                .then(() => this.upload());
        },

        makeApiRequest(method, url, data = null, errorMessage) {
            return axios[method](url, data)
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.error(errorMessage, error);
                });
        }
    }
}
</script>
