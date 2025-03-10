<template>
    <v-dialog activator="parent">
        <template v-slot:default="{ isActive }">
            <v-card class="w-66 mx-auto">
                <v-card-title>Crear nueva tarea</v-card-title>
                <v-card-text>
                    <v-form @submit.prevent="createTask( isActive)">
                        <v-text-field
                            label="Title"
                            v-model="title"
                        ></v-text-field>
                        <v-textarea
                            label="Descripción"
                            v-model="description"
                        ></v-textarea>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn @click="isActive.value = false">Cancelar</v-btn>
                    <v-btn @click="createTask(isActive)">Guardar</v-btn>
                </v-card-actions>
            </v-card>
        </template>
    </v-dialog>
</template>

<script>
export default {
    props: {
        upload: Function,
        tasks: Array,
    },
    data() {
        return {
            title: '',
            description: '',
            completed: false,
        };
    },
    methods: {
        createTask(isActive) {
            axios.post('/', {
                title: this.title,
                description: this.description,
                completed: this.completed,
            }).then(() => {
                this.upload();
                this.title = '';
                this.description = '';
                this.completed = false;
                isActive.value = false;
            })
                .catch(error => {
                    console.error("Error al crear la tarea:", error);
                });
        },
    },
};
</script>
