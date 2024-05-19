<script setup>

import {Head, Link, useForm} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Multiselect from 'vue-multiselect'


const props = defineProps({
    user: Object,
    careers: Object,
    roles: Object,
});

const userRole = props.roles.find(role => role.name === props.user.role);

const form = useForm({
    first_name: props.user.first_name,
    last_name: props.user.last_name,
    email: props.user.email,
    birthday: props.user.birthday,
    university_career: props.user.university_career,
    student_number: props.user.student_number,
    role: userRole,
});

const submit = () => {
    form.role = form.role.name;
    form.put(route('users.update',  { user: props.user.id }), {
        onFinish: () => form.role = props.roles.find(role => role.name === form.role),
    });
};
</script>

<template>
    <Head title="Estudiantes" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Estudiante {{ user.first_name }} {{ user.last_name }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto space-y-8 sm:px-6 lg:px-8">
                <div class="lg:space-x-6 lg:grid lg:grid-cols-3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 flex items-center text-emerald-600">
                            <svg class="mr-3 w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                            <div class="flex flex-col">
                                <h2 class="text-lg">Tutorías tomadas</h2>
                                <span class="text-3xl font-bold">0</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 flex items-center text-indigo-800">
                            <svg class="mr-3 w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                            </svg>
                            <div class="flex flex-col">
                                <h2 class="text-lg">Tutorías ofrecidas</h2>
                                <span class="text-3xl font-bold">0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit">
                            <div class="">
                                <InputLabel for="first_name" value="Nombres" />
                                <TextInput
                                    id="first_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.first_name"
                                    autocomplete="first_name"
                                />
                                <InputError class="mt-2" :message="form.errors.first_name" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="last_name" value="Apellidos" />
                                <TextInput
                                    id="last_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.last_name"
                                    autocomplete="last_name"
                                />
                                <InputError class="mt-2" :message="form.errors.last_name" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="birthday" value="Fecha de nacimiento" />
                                <TextInput
                                    id="birthday"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.birthday"
                                    autocomplete
                                />
                                <InputError class="mt-2" :message="form.errors.birthday" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="university_career" value="Carrera" />
                                <select
                                    id="university_career"
                                    class="mt-1 form-select block w-full border border-gray-300 focus-within:border-blue-800 focus-within:ring-blue-800 rounded-md shadow-sm"
                                    v-model="form.university_career"
                                >
                                    <option selected disabled value="">Seleccione tu carrera</option>
                                    <option v-for="career in careers" :key="career.id" :value="career.name">
                                        {{ career.name }}
                                    </option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.university_career" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="student_number" value="Número de control" />
                                <div class="relative block w-full">
                                    <input
                                        id="student_number"
                                        type="text"
                                        class="mt-1 block w-full pl-3 pr-10 py-2.5 text-base leading-6 sm:text-sm sm:leading-5 border border-gray-300
                                        focus-within:border-blue-800 focus-within:ring-blue-800 rounded-md shadow-sm"
                                        v-model="form.student_number"
                                        placeholder="Número de control"
                                        autocomplete="username"
                                    />
                                </div>
                                <InputError class="mt-2" :message="form.errors.student_number" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="email" value="Correo institucional" />
                                <TextInput
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    v-model="form.email"
                                    autocomplete
                                />
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="roles" value="Roles" />

                                <multiselect v-model="form.role" :options="roles" :multiple="false" :close-on-select="true" :clear-on-select="true"
                                             :preserve-search="true" placeholder="Selecciona un rol" label="name" track-by="name">
                                    <template #selection="{ values, search, isOpen }">
                                        <span class="multiselect__single"
                                              v-if="values.length"
                                              v-show="!isOpen">{{ values[0].name }}</span>
                                    </template>
                                </multiselect>

                                <InputError class="mt-2" :message="form.errors.role" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <Link
                                    :href="route('users.index')"
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    Regresar
                                </Link>

                                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Actualizar
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

