<script setup>

import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {Link} from "@inertiajs/vue3";
import DropdownLink from "@/Components/DropdownLink.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownNotification from "@/Components/Dashboard/Header/DropdownNotification.vue";
import {useStore} from "vuex";
import {computed} from "vue";

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
    <header
        class="sticky top-0 z-40 flex w-full bg-white drop-shadow-sm"
    >
        <div class="flex flex-grow items-center justify-between py-4 px-4 shadow-2 md:px-6 2xl:px-11">
            <div class="flex items-center gap-2 sm:gap-4 lg:hidden">
                <!-- Hamburger Toggle -->
                <button class="z-50 block rounded-sm border border-stroke bg-white p-1.5 shadow-sm lg:hidden"
                        @click="toggleSidebar"
                >
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                <Link :href="route('dashboard')" class="flex items-center">
                    <ApplicationLogo class="w-[80px] h-[58px]"/>
                </Link>
            </div>
            <div class="hidden sm:block">
                <slot name="header"/>
            </div>

            <div class="flex items-center gap-3">
                <ul class="flex items-center gap-2">
                    <li class="hidden sm:block">
                        <DropdownNotification />
                    </li>
                </ul>

                <!-- User Area -->
                <div class="ms-3 relative">
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                        class="inline-flex items-center lg:px-3 lg:py-2 border border-transparent text-sm
                                        leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none
                                        transition ease-in-out duration-150"
                                >
                                    <span>{{ $page.props.auth.user.first_name }} <span class="hidden sm:block">{{ $page.props.auth.user.last_name }}</span></span>
                                    <svg
                                        class="ms-2 -me-0.5 h-5 w-5"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </button>
                            </span>
                        </template>

                        <template #content>
                            <DropdownLink :href="route('profile.edit')" class="text-slate-500 flex items-center">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                <span class="ml-1 text-md">Perfil</span>
                            </DropdownLink>
                            <DropdownLink :href="route('logout')" method="post" as="button" class="text-slate-500 flex items-center">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                </svg>
                                <span class="ml-1 text-md">Cerrar sesión</span>
                            </DropdownLink>
                        </template>
                    </Dropdown>
                </div>
                <!-- User Area -->
            </div>
        </div>
    </header>
</template>
