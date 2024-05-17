<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    careers: Object,
});

const form = useForm({
    first_name: '',
    last_name: '',
    student_number: '',
    email: '',
    password: '',
    password_confirmation: '',
    birthday: '',
    university_career: '',
});

const submit = () => {
    form.email = form.student_number + '@veracruz.tecnm.mx';
    console.log(form.email);
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Registro" />

        <form @submit.prevent="submit">
            <div class="flex items-center gap-3">
                <div>
                    <InputLabel for="first_name" value="Nombres" />
                    <TextInput
                        id="first_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.first_name"
                        autofocus
                        autocomplete="first_name"
                    />
                    <InputError class="mt-2" :message="form.errors.last_name" />
                </div>
                <div>
                    <InputLabel for="last_name" value="Apellidos" />
                    <TextInput
                        id="last_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.last_name"
                        autofocus
                        autocomplete="last_name"
                    />
                    <InputError class="mt-2" :message="form.errors.last_name" />
                </div>
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
                <InputLabel for="student_number" value="Correo institucional" />
                <div class="relative block w-full">
                    <input
                        id="student_number"
                        type="text"
                        class="block w-full pl-3 pr-10 py-2.5 text-base leading-6 sm:text-sm sm:leading-5 border border-gray-300
                        focus-within:border-blue-800 focus-within:ring-blue-800 rounded-md shadow-sm"
                        v-model="form.student_number"
                        placeholder="Número de control"
                        autocomplete="username"
                    />
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <button class="text-gray-500 sm:text-sm sm:leading-5">
                            @veracruz.tecnm.mx
                        </button>
                    </div>
                </div>
                <InputError class="mt-2" :message="form.errors.student_number" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Contraseña" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirmar Contraseña" />
                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    ¿Ya tienes una cuenta?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                   Registrar
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
