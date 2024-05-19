<script setup>

import {Head, router} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import MazDialog from "maz-ui/components/MazDialog";
import DangerButton from "@/Components/DangerButton.vue";
import {ref} from "vue";

const props = defineProps({
    roles: Object,
    filters: Object,
});

const isOpenDelete = ref(false)
const selectedRole = ref('')

/**
 * Abre el modal de eliminación.
 * @param role
 */
function openDeleteModal(role) {
    selectedRole.value = role;
    isOpenDelete.value = true;
}

/**
 * Eliminar usuario.
 */
const deleteRole = () => {
    console.log('Eliminando role: ', selectedRole.value);
    router.delete(route('roles.destroy', selectedRole.value), {}, {
        preserveState: true,
        replace: true,
        onSuccess: (response) => {
            console.log(response);
        },
    });
    isOpenDelete.value = false;
};


</script>

<template>
    <Head title="Roles" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Roles</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto space-y-8 sm:px-6 lg:px-8">
                <div class="lg:space-x-6 lg:grid lg:grid-cols-3">
                </div>

                <!-- Tabla -->
                <div class="bg-white  shadow-md sm:rounded-lg">
                    <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 px-2 py-2">
                        <div class="relative">
                            <div class="absolute inset-y-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="text" name="table-search"
                                   class="block p-2 ps-10 text-md text-gray-900 border border-gray-300 rounded-lg w-80
                                   bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Buscar por nombre..."
                            >
                        </div>
                        <Dropdown align="right" width="48" >
                            <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="p-1.5 flex items-center bg-slate-200 border border-slate-300
                                                rounded-md hover:opacity-85 duration-150"
                                                aria-label="Opciones de modificación"
                                            >
                                                 <svg class="w-6 h-6 text-slate-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                                                </svg>
                                                <span class="ml-1 text-sm uppercase font-bold">Opciones</span>
                                            </button>
                                        </span>
                            </template>
                            <template #content>
                                <DropdownLink :href="route('roles.create')"
                                              class="flex items-center text-blue-500"
                                >
                                    <svg class="mr-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    Crear
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>
                    <table class="w-full text-left divide-y divide-gray-100 shadow-sm border-gray-200 border">
                        <thead class="bg-gray-200/65 text-gray-800 uppercase text-sm">
                        <tr>
                            <th scope="col" class="px-3 py-3">Id</th>
                            <th scope="col" class="px-3 py-3">Nombre</th>
                            <th scope="col" class="px-3 py-3">Guard</th>
                            <th scope="col" class="px-3 py-3">Fecha de creación</th>
                            <th scope="col" class="px-3 py-3">Ultima actualización</th>
                            <th scope="col" class="px-3 py-3">Acciones</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-md">
                        <tr v-for="role in roles" :key="role.id" class="hover:bg-gray-200/60 duration-150">
                            <td class="px-3 py-2 whitespace-no-wrap">{{ role.id }}</td>
                            <td class="px-3 py-2 whitespace-no-wrap">{{ role.name }}</td>
                            <td class="px-3 py-2 whitespace-no-wrap">{{ role.guard_name }}</td>
                            <td class="px-3 py-2 whitespace-no-wrap">{{ role.created_at }}</td>
                            <td class="px-3 py-2 whitespace-no-wrap">{{ role.updated_at }}</td>
                            <td class="px-3 py-2">
                                <Dropdown align="right" width="48" >
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="p-1 bg-slate-100 border border-slate-300 shadow-sm rounded-xl
                                                hover:opacity-85 duration-150"
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
                                        <div class="relative z-50">
                                            <DropdownLink :href="route('roles.edit', role)"
                                                          class="flex items-center text-blue-500"
                                            >
                                                <svg class="mr-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                                Editar
                                            </DropdownLink>
                                            <button type="button"
                                                    @click="openDeleteModal(role)"
                                                    class="flex items-center text-red-600 w-full px-4 py-2 text-start text-sm leading-5
                                                hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition
                                                duration-150 ease-in-out"
                                            >
                                                <svg class="mr-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                                Eliminar
                                            </button>
                                        </div>
                                    </template>
                                </Dropdown>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <MazDialog v-model="isOpenDelete" title="Eliminar">
            <p>¿Estás seguro de eliminar el rol {{ selectedRole.name }}? Este proceso
                no tiene como revertirse.
            </p>
            <form @submit.prevent="deleteRole">
                <div class="mt-4 flex gap-4 justify-end">
                    <DangerButton type="submit">
                        Eliminar
                    </DangerButton>
                </div>
            </form>
        </MazDialog>
    </AdminLayout>
</template>
