<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";

const props = defineProps({
    selections: Array
});
</script>

<template>
    <Head title="Registros" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">Lista de usuarios</h2>
        </template>

        <div class="py-8">
            <table class="w-full text-left divide-y divide-gray-100 bg-white shadow-sm border-gray-200 border">
                <thead class="bg-gray-200/65 text-gray-800 uppercase text-sm">
                <tr>
                    <th scope="col" class="px-3 py-3">Nombre</th>
                    <th scope="col" class="px-3 py-3">Correo institucional</th>
                    <th scope="col" class="px-3 py-3">Fecha de nacimiento</th>
                    <th scope="col" class="px-3 py-3">Número de control</th>
                    <th scope="col" class="px-3 py-3">Carrera</th>
                    <th scope="col" class="px-3 py-3">Rol del usuario</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-md">
                <tr v-for="selection in selections" :key="selection.id" class="hover:bg-gray-200/60 duration-150">
                    <td class="px-3 py-2 whitespace-no-wrap">{{ selection.user.first_name }} {{ selection.user.last_name}}</td>
                    <td class="px-3 py-2 whitespace-no-wrap">{{ selection.user.email }}</td>
                    <td class="px-3 py-2 whitespace-no-wrap">{{ selection.user.birthday }} <br> {{ selection.user.age }} años</td>
                    <td class="px-3 py-2 whitespace-no-wrap">{{ selection.user.student_number }}</td>
                    <td class="px-3 py-2 whitespace-no-wrap">{{ selection.user.university_career }}</td>
                    <td class="px-3 py-2 whitespace-no-wrap">
                        <span v-if="selection.user.role === 'estudiante'"
                              class="p-1.5 bg-emerald-500 border border-emerald-500 text-white rounded-xl text-xs uppercase"
                        >
                            {{ selection.user.role }}
                        </span>
                        <span v-else
                              class="p-1.5 bg-blue-600 border border-blue-500 text-white rounded-xl text-xs uppercase"
                        >
                            {{ selection.user.role }}
                        </span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>
