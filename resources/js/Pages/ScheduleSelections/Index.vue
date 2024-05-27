<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, router} from "@inertiajs/vue3";
import IconCalendar from "@/Assets/Icons8/icons8-calendar.gif";
import IconHistory from "@/Assets/Icons8/icons8-history.gif";
import {computed, ref} from "vue";
import MazDialog from 'maz-ui/components/MazDialog'
import DangerButton from "@/Components/DangerButton.vue";

const props = defineProps({
    selectedSchedules: Array
});

const inactiveSchedules = computed(() => {
    return props.selectedSchedules.filter(schedule => !schedule.active);
});

const isOpenDelete = ref(false)
const selectedSelectedSchedule = ref('');

/**
 * Abre el modal de eliminación.
 */
function openDeleteModal(selectedSchedule) {
    selectedSelectedSchedule.value = selectedSchedule;
    isOpenDelete.value = true;
}

// Filtrar y ordenar los horarios activos por fecha de inicio (start_date)
const sortedSchedules = props.selectedSchedules
    .filter(schedule => schedule.active)
    .sort((a, b) => {
        return new Date(a.schedule.start_date) - new Date(b.schedule.start_date);
    });

function removeAttendance() {
    console.log(selectedSelectedSchedule)
    router.put(route('schedule_selection.removeAttendance', selectedSelectedSchedule.value), {});
    isOpenDelete.value = false;
}
</script>

<template>
    <Head title="Mis registros" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">Tutorías seleccionadas</h2>
        </template>

        <div class="py-8">
            <div class="mt-4 p-4 bg-white rounded-md shadow-lg border border-gray-100">
                <div class="pb-2 flex items-center border-b border-slate-200">
                    <img :src="IconCalendar" alt="icono calendario">
                    <h3 class="ml-2 font-bold text-xl">¡Próximas tutorías por ocurrir!</h3>
                </div>
                <!-- Mostrar los horarios ordenados -->
                <div v-if="sortedSchedules.length > 0">
                    <div v-for="selectedSchedule in sortedSchedules"
                         :key="selectedSchedule.id"
                         class="py-4">
                        <div class="flex items-center p-4 gap-3 bg-slate-200/60 rounded-lg shadow-sm">
                            <div class="flex items-center justify-center h-10 w-10 rounded-full bg-white border border-slate-200">
                                <svg class="size-6 text-slate-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9.315 7.584C12.195 3.883 16.695 1.5 21.75 1.5a.75.75 0 0 1 .75.75c0 5.056-2.383 9.555-6.084 12.436A6.75 6.75 0 0 1 9.75 22.5a.75.75 0 0 1-.75-.75v-4.131A15.838 15.838 0 0 1 6.382 15H2.25a.75.75 0 0 1-.75-.75 6.75 6.75 0 0 1 7.815-6.666ZM15 6.75a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" clip-rule="evenodd" />
                                    <path d="M5.26 17.242a.75.75 0 1 0-.897-1.203 5.243 5.243 0 0 0-2.05 5.022.75.75 0 0 0 .625.627 5.243 5.243 0 0 0 5.022-2.051.75.75 0 1 0-1.202-.897 3.744 3.744 0 0 1-3.008 1.51c0-1.23.592-2.323 1.51-3.008Z" />
                                </svg>
                            </div>
                            <div class="w-full flex justify-between items-center">
                                <div>
                                    <h3 class="font-bold flex flex-col">
                                        {{ selectedSchedule.schedule.name }} |
                                        {{ selectedSchedule.schedule.course.name }}
                                        <span class="font-normal">{{ selectedSchedule.schedule.description }}</span>
                                    </h3>
                                    <p>{{ selectedSchedule.schedule.start_date }} {{ selectedSchedule.schedule.start_time }}</p>
                                </div>
                                <button @click="openDeleteModal(selectedSchedule)"
                                        class="bg-slate-300 rounded-full p-1">
                                    <svg class="size-6 text-slate-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else class="p-4 text-gray-500">No hay tutorías próximas por ocurrir.</div>
            </div>

            <div class="mt-12 p-4 bg-white rounded-md shadow-lg border border-gray-100">
                <div class="pb-2 flex items-center border-b border-slate-200">
                    <img :src="IconHistory" alt="icono restaurar">
                    <h3 class="ml-2 font-bold text-xl">Tutorías a las que haz asistido o rechazado</h3>
                </div>
                <table v-if="inactiveSchedules.length > 0" class="w-full text-left divide-y divide-gray-100 shadow-sm">
                    <thead class="bg-gray-200/65 text-gray-800 uppercase text-sm">
                    <tr>
                        <th scope="col" class="px-3 py-3">Titulo</th>
                        <th scope="col" class="px-3 py-3">Ubicación</th>
                        <th scope="col" class="px-3 py-3">Materia</th>
                        <th scope="col" class="px-3 py-3">Empieza</th>
                        <th scope="col" class="px-3 py-3">Termina</th>
                        <th scope="col" class="px-3 py-3">Hora</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-md">
                    <tr v-for="inactiveSchedule in inactiveSchedules" :key="inactiveSchedule.id" class="hover:bg-gray-200/60 duration-150">
                        <td class="px-3 py-2 whitespace-no-wrap">{{ inactiveSchedule.schedule.name }}</td>
                        <td class="px-3 py-2 whitespace-no-wrap">
                            <div class="flex flex-col">
                                <span>{{ inactiveSchedule.schedule.classroom_type }}</span>
                                <span class="uppercase text-slate-500 text-xs">{{ inactiveSchedule.schedule.classroom_location }}</span>
                            </div>
                        </td>
                        <td class="px-3 py-2 whitespace-no-wrap">{{ inactiveSchedule.schedule.course.name }}</td>
                        <td class="px-3 py-2 whitespace-no-wrap">{{ inactiveSchedule.schedule.start_date }}</td>
                        <td class="px-3 py-2 whitespace-no-wrap">{{ inactiveSchedule.schedule.end_date }}</td>
                        <td class="px-3 py-2 whitespace-no-wrap">{{ inactiveSchedule.schedule.start_time }}</td>
                    </tr>
                    </tbody>
                </table>
                <div v-else class="p-4 text-gray-500">No haz asistido a ninguna tutoría.</div>
            </div>
        </div>

        <MazDialog v-model="isOpenDelete" title="Eliminar asistencia">
            <p>¿Estás seguro que deseas confirmar tu inasistencia? Este proceso
                no tiene como revertirse.
            </p>
            <form @submit.prevent="removeAttendance">
                <div class="mt-4 flex gap-4 justify-end">
                    <DangerButton type="submit">
                        Confirmar
                    </DangerButton>
                </div>
            </form>
        </MazDialog>
    </AuthenticatedLayout>
</template>
