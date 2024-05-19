<script setup>
import {Head, Link, useForm} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Multiselect from 'vue-multiselect'
import {computed, watch} from "vue";

const props = defineProps({
    permissions: Array,
});

const form = useForm({
    name: '',
    guard_name: '',
    permissions: [],
});

const submit = () => {
    form.post(route('roles.store'), {
        onBefore: () => {
            console.log('Creando rol...');
        },
        onSuccess: () => {
            console.log('Rol creado con éxito');
        },
    });
};

// Propiedad computada para filtrar los permisos por guard_name
const filteredPermissions = computed(() => {
    return props.permissions.filter(permission => permission.guard_name === form.guard_name);
});

// Watcher para limpiar los permisos cuando se cambia el guard_name
watch(() => form.guard_name, () => {
    form.permissions = [];
});
</script>

<template>
    <Head title="Estudiantes"/>

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear rol</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto space-y-8 sm:px-6 lg:px-8">
                <div class="lg:space-x-6 lg:grid lg:grid-cols-3">
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit">
                            <div class="flex space-x-4 w-full">
                                <div class="w-full">
                                    <InputLabel for="name" value="Nombre del rol"/>
                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.name"
                                        autocomplete="name"
                                    />
                                    <InputError class="mt-2" :message="form.errors.name"/>
                                </div>
                                <div class="w-full">
                                    <InputLabel for="guard_name" value="Tipo de usuario (guard)"/>
                                    <select
                                        id="guard_name"
                                        class="mt-1 form-select block w-full border border-gray-300 focus-within:border-blue-800 focus-within:ring-blue-800 rounded-md shadow-sm"
                                        v-model="form.guard_name"
                                    >
                                        <option selected disabled value="">Seleccione un tipo de usuario</option>
                                        <option value="web">
                                            usuario
                                        </option>
                                        <option value="admin">
                                            administrador
                                        </option>
                                    </select>
                                    <InputError class="mt-2" :message="form.errors.guard_name"/>
                                </div>
                            </div>

                            <div class="mt-4">
                                <InputLabel for="permissions" value="Permisos"/>
                                <Multiselect
                                    v-model="form.permissions"
                                    :options="filteredPermissions"
                                    :multiple="true"
                                    :close-on-select="false"
                                    :clear-on-select="false"
                                    :hide-selected="true"
                                    :preserve-search="true"
                                    placeholder="Seleccione uno o varios permisos"
                                    label="name"
                                    track-by="id"
                                />
                                <InputError class="mt-2" :message="form.errors.permissions"/>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <Link
                                    :href="route('roles.index')"
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    Regresar
                                </Link>

                                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                               :disabled="form.processing">
                                    Crear
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
