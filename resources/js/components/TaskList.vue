<template>
    <h2>Tareas actuales</h2>
    <v-list>

<!--Incompleted Tasks List-->
        <v-list-subheader>Tareas pendientes</v-list-subheader>
        <v-list-item
            v-for="task in incompletedTasks" :key="task.id"
            @mouseover="task.hovered = true"
            @mouseleave="task.hovered = false"
            :class="{'bg-grey-lighten-4': task.hovered}">
            <v-list-item
                :title='task.title'>
<!-- Mark as Completed-->
                <template v-slot:prepend>
                    <v-icon
                        @click="completeTask( task)"
                        :class="{'text-success': task.hovered}">
                        mdi-check-bold</v-icon>
                </template>
<!-- Remove Task-->
                <template v-slot:append>
                   <v-icon
                       @click="removeTask(task)"
                       :class="{'text-error': task.hovered}">
                       mdi-trash-can-outline
                   </v-icon>
                </template>
<!-- Edit Task-->
            </v-list-item>
        </v-list-item>

<!--Incompleted Tasks List-->
        <v-list-subheader>Tareas completas</v-list-subheader>
        <v-list-item
            class="bg-grey-lighten-4 text-grey-darken-2"
            v-for="task in completedTasks" :key="task.id"
            @mouseover="task.hovered = true"
            @mouseleave="task.hovered = false"
            :class="{'bg-grey-lighten-3': task.hovered}">
            <v-list-item
                :title='task.title'>
<!-- Remove Task-->
                <template v-slot:append>
                    <v-icon
                        @click="removeTask(task)"
                        :class="{'text-error': task.hovered}">
                        mdi-trash-can-outline
                    </v-icon>
                </template>
            </v-list-item>
        </v-list-item>
    </v-list>
</template>
<script>
export default {
    data() {
        return {
            tasks: [],
        }
    },
    computed: {
        completedTasks() {
            return this.tasks.filter(task => task.completed === true || task.completed === 1);
        },
        incompletedTasks() {
            return this.tasks.filter(task => task.completed === false || task.completed === 0);
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

    methods: {
        completeTask(task) {
            task.completed = true;
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
        }
    }
}
</script>
