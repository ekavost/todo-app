<template>
    <v-dialog activator="parent">
        <template v-slot:default="{ isActive }">
            <v-card class="w-66 mx-auto">
                <v-card-title>Editar la tarea</v-card-title>
                <v-card-text>
                    <v-form>
                        <v-text-field
                            label="Title"
                            v-model="task.title"
                        ></v-text-field>
                        <v-textarea
                            label="Descripción"
                            v-model="task.description"
                        ></v-textarea>
                        <v-checkbox
                            v-model="task.completed"
                        label="Completada">
                            </v-checkbox>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn @click="isActive.value = false; editTask()">Guardar</v-btn>
                    <v-btn @click="isActive.value = false; this.remove(task)">Eliminar</v-btn>
                    <v-btn @click="isActive.value = false; this.upload()">Cancelar </v-btn>
                </v-card-actions>
            </v-card>
        </template>
    </v-dialog>
</template>

<script>
import axios from "axios";

export default {
    props: ['upload', 'task', 'remove'],
    methods: {
        editTask() {
            axios.put(`/api/tasks/${this.task.id}`, {
                title: this.task.title,
                description: this.task.description,
                completed: this.task.completed,
            }).then(response => {
                console.log(response.data);
            });
            this.upload();
        },
    },
};
</script>
