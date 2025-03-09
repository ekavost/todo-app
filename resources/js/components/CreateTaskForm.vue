<template>
    <v-dialog activator="parent">
        <template v-slot:default="{ isActive }">
            <v-card class="w-66 mx-auto">
                <v-card-title>Crear Nueva tarea</v-card-title>
                <v-card-text>
                    <v-form>
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
                    <v-btn @click="isActive.value = false; createTask()">Guardar</v-btn>
                </v-card-actions>
            </v-card>
        </template>
    </v-dialog>
</template>

<script>
export default {
    data() {
        return {
            title: '',
            description: '',
            completed: false,
        };
    },
    methods: {
        createTask() {
            console.log(this.title);
            axios.post('/', {
                title: this.title,
                description: this.description,
                completed: this.completed,
            }).then(response => {
                console.log(response.data);
            });
        },
    },
};
</script>
