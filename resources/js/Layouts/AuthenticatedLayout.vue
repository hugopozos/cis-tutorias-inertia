<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import SidebarArea from "@/Components/Dashboard/Sidebar/SidebarArea.vue";
import HeaderArea from "@/Components/Dashboard/Header/HeaderArea.vue";

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="flex h-screen bg-[#f0f4f9] overflow-hidden">
        <!-- Barra lateral -->
        <SidebarArea />

        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <HeaderArea>
                <template #header>
                    <slot name="header"/>
                </template>
            </HeaderArea>
            <!-- Contenido principal -->
            <main>
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
