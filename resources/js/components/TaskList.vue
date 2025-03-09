<template>
    <h2>Tareas actuales</h2>
    <v-list>
        <v-list-subheader>Tareas pendientes</v-list-subheader>
        <v-list-item
            v-for="task in incompletedTasks" :key="task.id"
            @mouseover="task.hovered = true"
            @mouseleave="task.hovered = false"
            :class="{'bg-grey-lighten-4': task.hovered}">
            <v-list-item
                :title='task.title'>
                <template v-slot:prepend>
                    <v-icon
                        @click="completeTask( task)"
                        :class="{'text-success': task.hovered}">
                        mdi-check-bold</v-icon>
                </template>
            </v-list-item>
        </v-list-item>

        <v-list-subheader>Tareas completas</v-list-subheader>
        <v-list-item  class="bg-grey-lighten-4 text-grey-darken-2"
            v-for="task in completedTasks" :key="task.id">
            <v-list-item
                :title='task.title'>
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
            return this.tasks.filter(task => task.completed === true);
        },
        incompletedTasks() {
            return this.tasks.filter(task => task.completed !== true);
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
        }
    }
}
</script>
