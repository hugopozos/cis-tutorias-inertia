<script setup>

import {Head, Link, useForm} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    user: Object,
    careers: Object,
    roles: Object,
});

const form = useForm({
    first_name: props.user.first_name,
    last_name: props.user.last_name,
    email: props.user.email,
    birthday: props.user.birthday,
    university_career: props.user.university_career,
    student_number: props.user.student_number,
    role: props.user.role,
});
</script>

<template>
    <Head title="Estudiantes" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Estudiante {{ user.first_name }} {{ user.last_name }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto space-y-8 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ user }}
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form>
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
                                {{ roles }}
                                <InputLabel for="roles" value="Roles" />
                                <TextInput
                                    id="roles"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.role"
                                    autocomplete
                                />
                                <InputError class="mt-2" :message="form.errors.role" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <Link
                                    :href="route('users.show')"
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
