<template>
    <v-dialog activator="parent">
        <template v-slot:default="{ isActive }">
            <!-- Dialog container for creating a new task -->
            <v-card class="w-66 mx-auto">
                <v-card-title>Crear nueva tarea</v-card-title>
                <v-card-text>
                    <v-form @submit.prevent="createTask(isActive)">
                        <!-- Input field for task title -->
                        <v-text-field
                            label="Title"
                            v-model="title"
                        ></v-text-field>
                        <!-- Input field for task description -->
                        <v-textarea
                            label="Descripción"
                            v-model="description"
                        ></v-textarea>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <!-- Button to cancel task creation -->
                    <v-btn @click="isActive.value = false">Cancelar</v-btn>
                    <!-- Button to save a new task -->
                    <v-btn @click="createTask(isActive)">Guardar</v-btn>
                </v-card-actions>
            </v-card>
        </template>
    </v-dialog>
</template>

<script>
export default {
    props: {
        upload: Function, // Function to refresh the task list
        tasks: Array, // Array of tasks
    },
    data() {
        return {
            title: '', // Title field for the new task
            description: '', // Description field for the new task
            completed: false, // Default completion status for the new task
        };
    },
    methods: {
        // Sends a POST request to create a new task
        createTask(isActive) {
            axios.post('/', {
                title: this.title,
                description: this.description,
                completed: this.completed,
            }).then(() => {
                this.upload(); // Refresh the task list upon successful creation
                this.title = ''; // Reset the title field
                this.description = ''; // Reset the description field
                this.completed = false; // Reset the completion status
                isActive.value = false; // Close the dialog
            }).catch(error => {
                console.error("Error al crear la tarea:", error); // Log errors
            });
        },
    },
};
</script>
