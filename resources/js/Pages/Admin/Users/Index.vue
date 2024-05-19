<script setup>
import {Head, router} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import {ref, watch} from "vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import MazDialog from 'maz-ui/components/MazDialog'
import DangerButton from "@/Components/DangerButton.vue";

const props = defineProps({
    users: Object,
    filters: Object,
});

const perPage = ref('5');
const searchQuery = ref(props.filters.search);
const isOpenDelete = ref(false)
const selectedUser = ref('')

/*
 * Watch search query
 */
watch(searchQuery, () => {
    router.get(route('users.index'),{
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

/**
 * Abre el modal de eliminación.
 * @param user
 */
function openDeleteModal(user) {
    selectedUser.value = user;
    isOpenDelete.value = true;
}

/**
 * Eliminar usuario.
 */
const deleteUser = () => {
    console.log('Eliminando usuario: ', selectedUser.value);
    router.delete(route('users.destroy', selectedUser.value), {}, {
        preserveState: true,
        replace: true,
        onSuccess: (response) => {
            console.log(response);
        },
        onFinish: () => {
            console.log('Finished');
        },
    });
    isOpenDelete.value = false;
};
</script>

<template>
    <Head title="Estudiantes" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Estudiantes</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto space-y-8 sm:px-6 lg:px-8">
                <div class="lg:space-x-6 lg:grid lg:grid-cols-3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 flex items-center text-blue-600">
                            <svg class="mr-3 w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                            <div class="flex flex-col">
                                <h2 class="text-lg">Estudiantes registrados</h2>
                                <span class="text-3xl font-bold">0</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 flex items-center text-indigo-800">
                            <svg class="mr-3 w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                            </svg>
                            <div class="flex flex-col">
                                <h2 class="text-lg">Estudiantes de CIS</h2>
                                <span class="text-3xl font-bold">0</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 flex items-center text-gray-600">
                            <svg class="mr-3 w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 0 1-.657.643 48.39 48.39 0 0 1-4.163-.3c.186 1.613.293 3.25.315 4.907a.656.656 0 0 1-.658.663v0c-.355 0-.676-.186-.959-.401a1.647 1.647 0 0 0-1.003-.349c-1.036 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401v0c.31 0 .555.26.532.57a48.039 48.039 0 0 1-.642 5.056c1.518.19 3.058.309 4.616.354a.64.64 0 0 0 .657-.643v0c0-.355-.186-.676-.401-.959a1.647 1.647 0 0 1-.349-1.003c0-1.035 1.008-1.875 2.25-1.875 1.243 0 2.25.84 2.25 1.875 0 .369-.128.713-.349 1.003-.215.283-.4.604-.4.959v0c0 .333.277.599.61.58a48.1 48.1 0 0 0 5.427-.63 48.05 48.05 0 0 0 .582-4.717.532.532 0 0 0-.533-.57v0c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.035 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.37 0 .713.128 1.003.349.283.215.604.401.96.401v0a.656.656 0 0 0 .658-.663 48.422 48.422 0 0 0-.37-5.36c-1.886.342-3.81.574-5.766.689a.578.578 0 0 1-.61-.58v0Z" />
                            </svg>
                            <div class="flex flex-col">
                                <h2 class="text-lg">Otras comunidades</h2>
                                <span class="text-3xl font-bold">0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-md sm:rounded-lg">
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
                            <th scope="col" class="px-3 py-3">Rol del usuario</th>
                            <th scope="col" class="px-3 py-3">Fecha de creación</th>
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
                            <td class="px-3 py-2 whitespace-no-wrap">
                                <span v-if="user.role === 'estudiante'"
                                      class="p-1.5 bg-emerald-500 border border-emerald-500 text-white rounded-xl text-xs uppercase"
                                >
                                    {{ user.role }}
                                </span>
                                <span v-else
                                      class="p-1.5 bg-blue-600 border border-blue-500 text-white rounded-xl text-xs uppercase"
                                >
                                    {{ user.role }}
                                </span>
                            </td>
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
                                                      class="flex items-center text-blue-500"
                                        >
                                            <svg class="mr-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                            Editar
                                        </DropdownLink>
                                        <button type="button"
                                                @click="openDeleteModal(user)"
                                                class="flex items-center text-red-600 w-full px-4 py-2 text-start text-sm leading-5
                                                hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition
                                                duration-150 ease-in-out"
                                        >
                                            <svg class="mr-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                            Eliminar
                                        </button>
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

        <MazDialog v-model="isOpenDelete" title="Eliminar">
            <p>¿Estás seguro de eliminar a {{ selectedUser.first_name }} {{ selectedUser.last_name }}? Este proceso
            no tiene como revertirse.
            </p>
            <form @submit.prevent="deleteUser">
                <div class="mt-4 flex gap-4 justify-end">
                    <DangerButton type="submit">
                        Eliminar
                    </DangerButton>
                </div>
            </form>
        </MazDialog>
    </AdminLayout>

</template>
