<script setup>
import {Link} from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {ref} from "vue";
import {useSidebarStore} from "@/Stores/sidebar.js";

const isSidebarOpen = ref(false)

const sidebarStore = useSidebarStore()

function toggleSidebar() {
    isSidebarOpen.value = !isSidebarOpen.value
}

</script>

<template>
    <aside aria-label="Aside"
           class="absolute left-0 top-0 z-50 flex h-screen w-72 flex-col overflow-y-hidden bg-gray-900 duration-300
           ease-linear lg:static lg:translate-x-0"
           :class="{ 'translate-x-0': isSidebarOpen, '-translate-x-full': !isSidebarOpen }"
    >
        <!-- Header del sidebar -->
        <div class="flex items-center justify-between gap-2 px-6 py-5 lg:py-6">
            <Link :href="route('dashboard')" class="flex items-center">
                <ApplicationLogo class="w-16 h-20 mr-1.5"/>
                <span class="text-slate-50 text-md font-medium">COMUNIDAD DE INGENIERÍA EN SISTEMAS</span>
            </Link>

            <button class="block lg:hidden" @click="isSidebarOpen = false">
                <svg
                    class="fill-current"
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
                <template>
                    <div>
                        <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Grupo</h3>

                        <ul class="mb-6 flex flex-col gap-1.5">
                            Item
                        </ul>
                    </div>
                </template>
            </nav>
        </div>
    </aside>

</template>
