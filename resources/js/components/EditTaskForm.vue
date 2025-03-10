<template>
    <v-dialog activator="parent">
        <template v-slot:default="{ isActive }">
            <!-- Dialog container for editing a task -->
            <v-card class="w-66 mx-auto">
                <v-card-title>Editar la tarea</v-card-title>
                <v-card-text>
                    <v-form>
                        <!-- Input field for task title -->
                        <v-text-field
                            label="Title"
                            v-model="task.title"
                        ></v-text-field>
                        <!-- Input field for task description -->
                        <v-textarea
                            label="Descripción"
                            v-model="task.description"
                        ></v-textarea>
                        <!-- Checkbox to mark the task as completed -->
                        <v-checkbox
                            v-model="task.completed"
                            label="Completada">
                        </v-checkbox>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <!-- Button to save the edited task -->
                    <v-btn @click="isActive.value = false; editTask()">Guardar</v-btn>
                    <!-- Button to remove the task -->
                    <v-btn @click="isActive.value = false; this.remove(task)">Eliminar</v-btn>
                    <!-- Button to cancel editing -->
                    <v-btn @click="isActive.value = false; this.upload()">Cancelar </v-btn>
                </v-card-actions>
            </v-card>
        </template>
    </v-dialog>
</template>

<script>
import axios from "axios";

export default {
    props: ['upload', 'task', 'remove'], // Receives props for the task, and functions for refreshing and deleting tasks
    methods: {
        // Sends a PUT request to update the task with the new data
        editTask() {
            axios.put(`/api/tasks/${this.task.id}`, {
                title: this.task.title,
                description: this.task.description,
                completed: this.task.completed,
            }).then(response => {
                console.log(response.data); // Log the response for debugging
            });
            this.upload(); // Refresh task list after editing
        },
    },
};
</script>
