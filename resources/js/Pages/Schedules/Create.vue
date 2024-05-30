<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, router, useForm} from '@inertiajs/vue3';
import {ref, watch} from "vue";
import MazDialog from 'maz-ui/components/MazDialog';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { format, parseISO } from 'date-fns';
import { es } from 'date-fns/locale';
import Dropdown from "@/Components/Dropdown.vue";
import DangerButton from "@/Components/DangerButton.vue";

const props = defineProps({
    userSchedules: Object,
    courses: Object,
    classroomTypes: Object,
    scheduleStatus: Object,
});

const startDate = new Date();
const endDate = new Date();
endDate.setDate(startDate.getDate() + 1);
const isOpenCreate = ref(false)
const isOpenCancel = ref(false)
const selectedSchedule = ref('')

const form = useForm({
    name: '',
    description: '',
    classroom_type: '',
    classroom_location: '',
    start_date: startDate.toISOString().split('T')[0],
    end_date: endDate.toISOString().split('T')[0],
    start_time: '08:00',
    days_of_week: ['Lunes'],
    max_students: 1,
    course: '',
});

watch(() => form.days_of_week, (newValue) => {
    if (newValue.length === 0) {
        form.end_date = form.start_date;
    }
});

/**
 * Formatear fecha a "d MMMM" en español
 * @param {string} dateStr - Fecha en formato ISO (YYYY-MM-DD)
 * @returns {string} - Fecha formateada
 */
function formatDate(dateStr) {
    const date = parseISO(dateStr);
    return format(date, 'd MMMM', { locale: es });
}

/**
 * Abrir modal de crear
 */
function openCreateModal() {
    isOpenCreate.value = true;
}

function openCancelModal(schedule) {
    isOpenCancel.value = true;
    selectedSchedule.value = schedule;
}

const submit = () => {
    form.post(route('schedules.store'), {
        preserveScroll: true,
    });
    isOpenCreate.value = false;
};

const cancelSchedule = () => {
    router.put(route('schedules.cancel', selectedSchedule.value), {
        preserveScroll: true,
        onSuccess: () => {
            isOpenCancel.value = false;
        },
    });
};

const viewList = (schedule) => {
    router.get(route('schedules.list', schedule));
};

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
            return 'bg-gray-600'; // Clase por defecto
    }
}

function copyToClipboard(text) {
    // Crea un elemento de texto temporal
    const tempInput = document.createElement('input');
    tempInput.style.position = 'absolute';
    tempInput.style.left = '-9999px';
    tempInput.value = text;
    document.body.appendChild(tempInput);
    // Selecciona y copia el texto al portapapeles
    tempInput.select();
    document.execCommand('copy');
    document.body.removeChild(tempInput);
    // Muestra una alerta o notificación de que el texto se ha copiado
    alert('Texto copiado: ' + text);
}
</script>

<template>
    <Head title="Ofrecer tutoría" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">Ofrecer tutoría</h2>
        </template>

        <div class="py-8">
            <div class="gap-6 grid grid-rows-2 lg:grid lg:grid-cols-4">
                <div class="relative p-4 bg-white rounded-md shadow-lg border border-gray-100"
                     v-for="schedule in userSchedules" :key="schedule.id"
                >
                    <!-- Píldora de estado -->
                    <div
                        :class="['absolute top-0 left-0 mt-[-10px] ml-[-10px] text-white text-xs font-semibold py-1 ' +
                         'px-3 rounded-full shadow', pillClass(schedule.status)]"
                    >
                        {{ schedule.status }}
                    </div>
                    <div class="h-full w-full grid grid-rows-3">
                        <div class="flex justify-between items-center w-full text-blue-800 border-b border-gray-100">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 mr-1">
                                    <path d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                                    <path d="M13.06 15.473a48.45 48.45 0 0 1 7.666-3.282c.134 1.414.22 2.843.255 4.284a.75.75 0 0 1-.46.711 47.87 47.87 0 0 0-8.105 4.342.75.75 0 0 1-.832 0 47.87 47.87 0 0 0-8.104-4.342.75.75 0 0 1-.461-.71c.035-1.442.121-2.87.255-4.286.921.304 1.83.634 2.726.99v1.27a1.5 1.5 0 0 0-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.66a6.727 6.727 0 0 0 .551-1.607 1.5 1.5 0 0 0 .14-2.67v-.645a48.549 48.549 0 0 1 3.44 1.667 2.25 2.25 0 0 0 2.12 0Z" />
                                    <path d="M4.462 19.462c.42-.419.753-.89 1-1.395.453.214.902.435 1.347.662a6.742 6.742 0 0 1-1.286 1.794.75.75 0 0 1-1.06-1.06Z" />
                                </svg>
                                <h2 class="text-lg font-black">{{ schedule.name }}</h2>
                            </div>
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                <span class="inline-flex">
                                    <button type="button"
                                            class="inline-flex items-center text-gray-500 hover:text-gray-400
                                            focus:outline-none transition ease-in-out duration-150"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                             class="w-6 h-6"
                                        >
                                            <path fill-rule="evenodd" d="M10.5 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm0 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm0 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                                </template>
                                <template #content>
                                    <button @click="openCancelModal(schedule)" class="flex p-2 hover:bg-gray-100 w-full duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                             class="mr-1 w-5 h-5 text-red-500"
                                        >
                                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-gray-900">Cancelar</span>
                                    </button>
                                    <button @click="viewList(schedule)" class="flex p-2 hover:bg-gray-100 w-full duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                             class="mr-1 w-5 h-5 text-blue-500"
                                        >
                                            <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z" clip-rule="evenodd" />
                                            <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375Zm9.586 4.594a.75.75 0 0 0-1.172-.938l-2.476 3.096-.908-.907a.75.75 0 0 0-1.06 1.06l1.5 1.5a.75.75 0 0 0 1.116-.062l3-3.75Z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-gray-900">Ver registros</span>
                                    </button>
                                </template>
                            </Dropdown>
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
                                <span class="text-xs text-gray-400 uppercase">Limite</span>
                                <p class="text-md text-slate-600">{{ schedule.max_students }} estudiantes</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nueva tutoría -->
                <div class="flex justify-center rounded-lg border-2 border-gray-300 hover:border-blue-800 duration-300">
                    <button @click="openCreateModal" class="p-20 flex flex-col w-full items-center font-bold text-gray-400
                    hover:text-blue-800 duration-300"
                    >
                        <svg  class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-lg">Nueva tutoría</span>
                    </button>
                </div>
            </div>
        </div>

        <MazDialog v-model="isOpenCreate" title="Crear nueva tutoría" scrollable>
            <form @submit.prevent="submit">
                <div>
                    <div>
                        <InputLabel for="name" value="Titulo" />
                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            autocomplete="name"
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="description" value="Descripción" />
                        <TextInput
                            id="description"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.description"
                            autocomplete="description"
                        />
                        <InputError class="mt-2" :message="form.errors.description" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="course" value="Materia" />
                        <select
                            id="course"
                            class="mt-1 form-select block w-full border border-gray-300 focus-within:border-blue-800 focus-within:ring-blue-800 rounded-md shadow-sm"
                            v-model="form.course"
                        >
                            <option selected disabled value="">Selecciona una materia</option>
                            <option v-for="course in courses" :key="course.id" :value="course.id">
                                {{ course.name }}
                            </option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.course" />
                    </div>

                    <div class="mt-4 flex items-center space-x-4">
                        <div class="w-full">
                            <InputLabel for="classroom_type" value="Tipo de salon" />
                            <select
                                id="classroom_type"
                                class="mt-1 form-select block w-full border border-gray-300 focus-within:border-blue-800 focus-within:ring-blue-800 rounded-md shadow-sm"
                                v-model="form.classroom_type"
                            >
                                <option selected disabled value="">Selecciona formato</option>
                                <option v-for="classroomType in classroomTypes">
                                    {{ classroomType }}
                                </option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.classroom_type" />
                        </div>
                        <div class="w-full">
                            <InputLabel for="classroom_location" value="Ubicación" />
                            <TextInput
                                id="classroom_location"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.classroom_location"
                                autocomplete="classroom_location"
                                :placeholder="form.classroom_type === 'virtual' ? 'Ingrese URL' : 'Ingrese salón de clase'"
                            />
                            <InputError class="mt-2" :message="form.errors.classroom_location" />
                        </div>
                    </div>

                    <div class="mt-4 flex items-center space-x-4">
                        <div class="w-full">
                            <InputLabel for="start_date" value="Comienza" />
                            <TextInput
                                id="start_date"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="form.start_date"
                                autocomplete="start_date"
                            />
                            <InputError class="mt-2" :message="form.errors.start_date" />
                        </div>
                        <div class="w-full">
                            <InputLabel for="end_date" value="Termina" />
                            <TextInput
                                id="end_date"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="form.end_date"
                                autocomplete="end_date"
                                :disabled="form.days_of_week.length === 0"
                            />
                            <InputError class="mt-2" :message="form.errors.end_date" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <InputLabel for="start_time" value="Hora" />
                        <TextInput
                            id="start_time"
                            type="time"
                            class="mt-1 block w-full"
                            v-model="form.start_time"
                            autocomplete="start_time"
                        />
                        <InputError class="mt-2" :message="form.errors.start_time" />
                    </div>

                    <div class="mt-4 overflow-x-scroll scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                        <InputLabel for="days_of_week" value="Días de la semana" />

                        <div class="mt-1 flex gap-4">
                            <label v-for="(day, index) in ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo']"
                                   :key="index"
                                   class="flex items-center"
                            >
                                <input
                                    type="checkbox"
                                    :value="day"
                                    v-model="form.days_of_week"
                                    :checked="form.days_of_week.includes(day)"
                                    class="form-checkbox h-5 w-5 text-blue-600 border-gray-300 rounded"
                                />
                                <span class="ml-2 text-gray-700">{{ day }}</span>
                            </label>
                        </div>

                        <InputError class="mt-2" :message="form.errors.days_of_week" />
                        <p class="mt-2 text-slate-500 text-sm">Si no selecciona ningún día, se considerará que la tutoría ocurre una sola vez.</p>
                    </div>

                    <div class="mt-4">
                        <InputLabel for="max_students" value="Máximo de estudiantes" />
                        <input
                            id="max_students"
                            type="number"
                            class="mt-1 w-full border-gray-300 focus:border-blue-800 focus:ring-blue-800 rounded-md shadow-sm"
                            v-model="form.max_students"
                            autocomplete="max_students"
                        />
                        <InputError class="mt-2" :message="form.errors.max_students" />
                    </div>

                    <div class="mt-4">
                        <p v-if="form.days_of_week.length === 0" class="text-slate-500 text-sm">
                            Ocurre una sola vez el {{ formatDate(form.start_date) }} a las {{ form.start_time }} horas
                            {{ form.classroom_type === 'virtual' ? 'en línea'
                            : form.classroom_type === 'presencial' ? 'de forma presencial' : 'en ' + form.classroom_location }}
                        </p>
                        <p v-else class="text-slate-500 text-sm">
                            Ocurre cada
                            <span class="font-bold" v-if="form.days_of_week">{{ form.days_of_week.join(', ') }}</span>
                            a las {{ form.start_time }} horas
                        </p>
                    </div>
                </div>

                <div class="mt-4 flex gap-4 justify-end">
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                        Crear
                    </PrimaryButton>
                </div>
            </form>
        </MazDialog>

        <MazDialog v-model="isOpenCancel" title="Crear nueva tutoría" scrollable>
            <form @submit.prevent="cancelSchedule">
                <p>Cancelar tutoría {{ selectedSchedule.name }}</p>
                <div class="mt-4 flex gap-4 justify-end">
                    <DangerButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                        Cancelar
                    </DangerButton>
                </div>
            </form>
        </MazDialog>

    </AuthenticatedLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>

