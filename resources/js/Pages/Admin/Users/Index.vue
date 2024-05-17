<script setup>
import {Head, router, Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import {ref, watch} from "vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";

const props = defineProps({
    users: Object,
    filters: Object,
});

const perPage = ref('5');
const searchQuery = ref(props.filters.search);

/*
 * Watch search query
 */
watch(searchQuery, () => {
    router.get(route('users.show'),{
            search: searchQuery.value, perPage: perPage.value
        },
        {
            preserveState: true,
            replace: true,
            onSuccess: (response) => {
                props.users.data = response.props.users.data;
            },
            onError: (error) => {
                console.log(error);
            }
        });
});

/**
 * Obtener los usuarios.
 */
function getUsers() {
    router.get(route('users.show'), {
        perPage: perPage.value, search: searchQuery.value
    }, {
        preserveState: true,
        replace: true,
    });
}


</script>

<template>
    <Head title="Estudiantes" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Estudiantes</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto space-y-8 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                    </div>
                </div>

                <div class="bg-white relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 px-2 py-2">
                        <div class="relative">
                            <div class="absolute inset-y-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="text" name="table-search" v-model="searchQuery"
                                   class="block p-2 ps-10 text-md text-gray-900 border border-gray-300 rounded-lg w-80
                                   bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Buscar por correo..."
                            >
                        </div>
                    </div>
                    <table class="w-full text-left divide-y divide-gray-100 shadow-sm border-gray-200 border">
                        <thead class="bg-gray-200/65 text-gray-800 uppercase text-sm">
                        <tr>
                            <th scope="col" class="px-3 py-3">Id</th>
                            <th scope="col" class="px-3 py-3">Nombre</th>
                            <th scope="col" class="px-3 py-3">Correo institucional</th>
                            <th scope="col" class="px-3 py-3">Fecha de nacimiento</th>
                            <th scope="col" class="px-3 py-3">Número de control</th>
                            <th scope="col" class="px-3 py-3">Carrera</th>
                            <th scope="col" class="px-3 py-3">Fecha de registro</th>
                            <th scope="col" class="px-3 py-3">Ultima actualización</th>
                            <th scope="col" class="px-3 py-3">Acciones</th>
                        </tr>
                        </thead>
                        <tbody v-if="users.data?.length > 0" class="divide-y divide-gray-200 text-md">
                        <tr v-for="user in users.data" :key="user.id" class="hover:bg-gray-200/60 duration-150">
                            <td class="px-3 py-2 whitespace-no-wrap">{{ user.id }}</td>
                            <td class="px-3 py-2 whitespace-no-wrap">{{ user.first_name }} {{ user.last_name}}</td>
                            <td class="px-3 py-2 whitespace-no-wrap">{{ user.email }}</td>
                            <td class="px-3 py-2 whitespace-no-wrap">{{ user.birthday }} <br> {{ user.age }} años</td>
                            <td class="px-3 py-2 whitespace-no-wrap">{{ user.student_number }}</td>
                            <td class="px-3 py-2 whitespace-no-wrap">{{ user.university_career }}</td>
                            <td class="px-3 py-2 whitespace-no-wrap">{{ user.created_at }}</td>
                            <td class="px-3 py-2 whitespace-no-wrap">{{ user.updated_at }}</td>
                            <td class="px-3 py-2 whitespace-no-wrap">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="p-1 bg-slate-100 border border-slate-300 shadow-sm rounded-xl"
                                            >
                                                <svg class="w-5 h-5 text-slate-700/90"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                     stroke="currentColor"
                                                >
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('users.edit', user)"
                                                      class="flex items-center text-blue-800"
                                        >
                                            <svg class="mr-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                            Editar
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </td>
                        </tr>
                        </tbody>
                        <tbody v-else class="text-center divide-y divide-gray-200">
                        <tr>
                            <td class="px-3 py-8 whitespace-no-wrap" colspan="13">No hay información disponible...</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="flex items-center justify-between">
                        <Pagination :pagination="props.users" />
                        <div class="flex">
                            <select
                                v-model="perPage"
                                @change="getUsers"
                                class="mr-3 py-2 w-full rounded-md bg-gray-50 border border-gray-300 text-md text-gray-600"
                            >
                                <option value="5">5 por página</option>
                                <option value="10">10 por página</option>
                                <option value="25">25 por página</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>

</template>
