<script setup>

import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {Link} from "@inertiajs/vue3";
import DropdownLink from "@/Components/DropdownLink.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownNotification from "@/Components/Dashboard/Header/DropdownNotification.vue";

const props = defineProps({
    headerTitle: String,
});

</script>

<template>
    <header
        class="sticky top-0 z-40 flex w-full bg-white drop-shadow-sm"
    >
        <div class="flex flex-grow items-center justify-between py-4 px-4 shadow-2 md:px-6 2xl:px-11">
            <div class="flex items-center gap-2 sm:gap-4 lg:hidden">
                <!-- Hamburger Toggle -->
                <button class="z-50 block rounded-sm border border-stroke bg-white p-1.5 shadow-sm lg:hidden">
                    /
                </button>
                <Link :href="route('dashboard')" class="flex items-center">
                    <ApplicationLogo class="w-16 h-20 mr-1.5"/>
                    <span class="text-slate-50 text-md font-medium">COMUNIDAD DE INGENIERÍA EN SISTEMAS</span>
                </Link>
            </div>
            <div class="hidden sm:block">
                <slot name="header"/>
            </div>

            <div class="flex items-center gap-3">
                <ul class="flex items-center gap-2">
                    <li>
                        <DropdownNotification />
                    </li>
                </ul>

                <!-- User Area -->
                <div class="ms-3 relative">
                    <Dropdown align="right" width="48">
                        <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.first_name }} {{ $page.props.auth.user.last_name }}

                                                <svg
                                                    class="ms-2 -me-0.5 h-4 w-4"
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
                            <DropdownLink :href="route('profile.edit')"> Perfil </DropdownLink>
                            <DropdownLink :href="route('logout')" method="post" as="button">
                                Cerrar sesión
                            </DropdownLink>
                        </template>
                    </Dropdown>
                </div>
                <!-- User Area -->
            </div>
        </div>
    </header>
</template>
