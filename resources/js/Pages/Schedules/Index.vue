<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, router} from '@inertiajs/vue3';
import Dropdown from "@/Components/Dropdown.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    schedules: Object,
});

/**
 * Obtener clase de píldora basada en el estado del schedule
 * @param {string} status - Estado del schedule
 * @returns {string} - Clase de TailwindCSS para el estado
 */
function pillClass(status) {
    switch (status) {
        case 'disponible':
            return 'bg-green-500';
        case 'lleno':
            return 'bg-yellow-400';
        case 'cancelado':
            return 'bg-red-600';
        case 'finalizado':
            return 'bg-blue-600';
        default:
            return 'bg-gray-600';
    }
}

function copyToClipboard(text) {
    const tempInput = document.createElement('input');
    tempInput.style.position = 'absolute';
    tempInput.style.left = '-9999px';
    tempInput.value = text;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand('copy');
    document.body.removeChild(tempInput);
    alert('Texto copiado: ' + text);
}

function registerSchedule(schedule) {
    router.post(route('schedule_selection.store', {schedule: schedule}))
}
</script>

<template>
    <Head title="Tutorías" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">Tutorías</h2>
        </template>

        <div class="py-8">
            <div class="gap-6 grid grid-rows-2 lg:grid lg:grid-cols-4">
                <div v-if="schedules" class="relative p-4 bg-white rounded-md shadow-lg border border-gray-100 min-h-[400px]"
                     v-for="schedule in schedules" :key="schedule.id"
                >
                    <!-- Píldora de estado -->
                    <div
                        :class="['absolute top-0 left-0 mt-[-10px] ml-[-10px] text-white text-xs font-semibold py-1 ' +
                         'px-3 rounded-full shadow', pillClass(schedule.status)]"
                    >
                        {{ schedule.status }}
                    </div>
                    <div class="h-full w-full flex flex-col justify-between">
                        <div class="flex flex-col w-full text-blue-800 border-b border-gray-100">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 mr-1">
                                    <path d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                                    <path d="M13.06 15.473a48.45 48.45 0 0 1 7.666-3.282c.134 1.414.22 2.843.255 4.284a.75.75 0 0 1-.46.711 47.87 47.87 0 0 0-8.105 4.342.75.75 0 0 1-.832 0 47.87 47.87 0 0 0-8.104-4.342.75.75 0 0 1-.461-.71c.035-1.442.121-2.87.255-4.286.921.304 1.83.634 2.726.99v1.27a1.5 1.5 0 0 0-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.66a6.727 6.727 0 0 0 .551-1.607 1.5 1.5 0 0 0 .14-2.67v-.645a48.549 48.549 0 0 1 3.44 1.667 2.25 2.25 0 0 0 2.12 0Z" />
                                    <path d="M4.462 19.462c.42-.419.753-.89 1-1.395.453.214.902.435 1.347.662a6.742 6.742 0 0 1-1.286 1.794.75.75 0 0 1-1.06-1.06Z" />
                                </svg>
                                <h2 class="text-lg font-black">{{ schedule.name }}</h2>
                            </div>
                            Por {{ schedule.user.first_name + ' ' + schedule.user.last_name }}
                        </div>
                        <div class="py-1.5 flex justify-between items-center border-b border-gray-200">
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-400 uppercase">Descripción</span>
                                <p class="text-md text-slate-600">{{ schedule.description }}</p>
                            </div>
                        </div>
                        <div class="py-1.5 flex justify-between items-center border-b border-gray-200">
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-400 uppercase">Formato</span>
                                <p class="text-md text-slate-600">{{ schedule.classroom_type }}</p>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-400 uppercase">Ubicación</span>
                                <p :id="'tooltip-trigger-' + schedule.id"
                                   :data-tooltip-target="'tooltip-' + schedule.id"
                                   class="text-md text-slate-600 cursor-pointer"
                                   @click="copyToClipboard(schedule.classroom_location)">
                                    {{ schedule.classroom_location.slice(0, 20) + '...' }}
                                </p>
                            </div>
                            <div :id="'tooltip-' + schedule.id"
                                 role="tooltip"
                                 class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                {{ schedule.classroom_location }}
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>

                        <div class="py-1.5 flex justify-between items-center border-b border-gray-200">
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-400 uppercase">Empieza</span>
                                <p class="text-md text-slate-600">{{ schedule.start_date }}
                                    <span class="text-slate-400">{{ schedule.start_time }}</span>
                                </p>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-400 uppercase">Termina</span>
                                <p class="text-md text-slate-600">{{ schedule.end_date }}</p>
                            </div>
                        </div>

                        <div class="py-1.5 flex justify-between items-center border-b border-gray-200">
                            <div v-if="schedule.days_of_week && schedule.days_of_week.length > 0" class="flex flex-col">
                                <span class="text-xs text-gray-400 uppercase">Días</span>
                                <p class="text-md text-slate-600">{{ schedule.days_of_week.join(', ') }}</p>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-400 uppercase">Registros</span>
                                <p class="text-md text-slate-600">{{ schedule.registered_users_count }}/{{ schedule.max_students }}</p>
                            </div>
                        </div>

                        <div class="py-1.5 flex justify-between items-center">
                            <PrimaryButton @click="registerSchedule(schedule)"
                                           class="w-full flex justify-center"
                                           :class="schedule.is_registered ? 'bg-slate-400 text-white hover:bg-slate-400 focus:disabled' : ''"
                                           :disabled="schedule.is_registered"
                            >
                                {{ schedule.is_registered ? 'Ya estás registrado' : 'Únirse' }}
                            </PrimaryButton>
                        </div>
                    </div>
                </div>


                <div v-else class="flex justify-center rounded-lg border-2 border-gray-300 duration-300">
                    <button class="p-20 flex flex-col w-full items-center font-bold text-gray-400
                    hover:text-blue-800 duration-300"
                    >
                        <span class="text-lg">No hay tutorías disponibles</span>
                    </button>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
