<script setup>
import {Link} from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {computed, ref} from "vue";
import {useStore} from "vuex";

// Access Vuex store
const store = useStore();

// Map the state from Vuex store
const isSidebarOpen = computed(() => store.state.isSidebarOpen);

// Map the action from Vuex store
const toggleSidebar = () => {
    store.dispatch('toggleSidebar');
};
</script>

<template>
    <aside aria-label="Aside"
           class="absolute left-0 top-0 z-50 flex h-screen w-72 flex-col overflow-y-hidden duration-300
           ease-linear bg-gradient-to-b from-slate-900 to-blue-950 lg:static lg:translate-x-0"
           :class="{ 'translate-x-0': isSidebarOpen, '-translate-x-full': !isSidebarOpen }"
    >
        <!-- Header del sidebar -->
        <div class="flex items-center justify-between gap-2 px-6 py-5 lg:py-6">
            <Link :href="route('dashboard')" class="flex items-center">
                <ApplicationLogo class="w-16 h-20 mr-1.5"/>
                <span class="text-slate-50 text-md font-medium">COMUNIDAD DE INGENIERÍA EN SISTEMAS</span>
            </Link>

            <button class="block lg:hidden" @click="toggleSidebar">
                <svg
                    class="fill-current text-white"
                    width="20"
                    height="18"
                    viewBox="0 0 20 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z"
                        fill=""
                    />
                </svg>
            </button>
        </div>

        <div class="flex flex-col overflow-y-auto duration-200 ease-linear">
            <!-- Menu -->
            <nav class="mt-5 py-4 px-4 lg:mt-9 lg:px-6">
                <div>
                    <!-- Usuario -->
                    <h3 class="mb-4 ml-4 text-sm font-medium text-slate-300 uppercase">Menu</h3>
                    <ul class="mb-6 flex flex-col gap-1.5 text-slate-100">
                        <li>
                            <Link
                                :href="route('dashboard')"
                                :class="{ 'bg-slate-700': route().current('dashboard')}"
                                class="group relative flex items-center gap-2.5 rounded-md py-2 px-4 font-medium
                                duration-300 ease-in-out hover:bg-slate-700"
                            >
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                                </svg>
                                Dashboard
                            </Link>
                        </li>
                        <li>
                            <Link
                                :href="route('schedules.index')"
                                :class="{ 'bg-slate-700': route().current('schedules.index')}"
                                class="group relative flex items-center gap-2.5 rounded-md py-2 px-4 font-medium
                                duration-300 ease-in-out hover:bg-slate-700"
                            >
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                </svg>
                                Tutorías
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('schedule_selection.index')"
                                  :class="{ 'bg-slate-700': route().current('schedule_selection.index')}"
                                  class="group relative flex items-center gap-2.5 rounded-md py-2 px-4 font-medium
                            duration-300 ease-in-out hover:bg-slate-700"
                            >
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                </svg>
                                Mis registros
                            </Link>
                        </li>
                    </ul>

                    <!-- Tutor -->
                    <h3 class="mb-4 ml-4 text-sm font-medium text-slate-300 uppercase">Tutor</h3>
                    <ul class="mb-6 flex flex-col gap-1.5 text-slate-100">
                        <li>
                            <Link
                                :href="route('schedules.create')"
                                :class="{ 'bg-slate-700': route().current('schedules.create')}"
                                class="group relative flex items-center gap-2.5 rounded-md py-2 px-4 font-medium
                                duration-300 ease-in-out hover:bg-slate-700"
                            >
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                </svg>
                                Ofrecer tutoría
                            </Link>
                        </li>
                    </ul>

                </div>
            </nav>
        </div>
    </aside>

</template>
