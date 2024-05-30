<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import MazDrawer from 'maz-ui/components/MazDrawer'
import {ref} from "vue";

const isOpenedRight = ref(false)
</script>

<template>
    <header class="antialiased py-2 w-full top-0 border-b border-gray-100 shadow-2xl z-50">
        <div class="flex justify-between max-w-screen-2xl mx-auto items-center lg:grid lg:grid-cols-2">
            <Link href="/">
                <ApplicationLogo />
            </Link>
            <nav class="hidden lg:block"
                 aria-label="Barra de navegación principal"
            >
                <ul class="flex items-center justify-end space-x-4">
                    <li>
                        <a href="#quienes-somos">¿Quienes somos?</a>
                    </li>
                    <li>
                        <a href="#que-hacemos">¿Qué hacemos?</a>
                    </li>
                    <li>
                        <a href="#instalaciones">Instalaciones</a>
                    </li>
                    <li>
                        <a href="#contenido">Contenido</a>
                    </li>
                    <li>
                        <Link :href="route('login')"
                              aria-label="Registro"
                              class="bg-blue-950 px-4 py-2.5 text-slate-50 rounded-lg hover:opacity-80 duration-200"
                        >
                            Ingresar
                        </Link>
                    </li>
                </ul>
            </nav>
            <div class="lg:hidden text-black">
                <button @click="isOpenedRight = !isOpenedRight">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 mr-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <main class="antialiased min-h-screen bg-slate-50"
          aria-label="Contenido principal del sitio"
    >
        <slot />
    </main>

    <footer class="antialiased py-12 bg-[#04043B] w-full bottom-0"
            aria-label="Footer del sitio"
    >
        <div class="text-gray-50 max-w-screen-xl mx-auto">
            <div class="grid grid-cols-4 lg:grid-cols-5">
                <!-- Logo -->
                <div class="col-span-1 lg:col-span-2">
                    <ApplicationLogo class="w-16 select-none pointer-events-none" />
                </div>
            </div>
            <hr class="h-px my-8 bg-gray-400 border-0">
            <div class="text-gray-50 font-lato">
                <ul class="flex flex-row space-x-4 text-sm lg:text-lg">
                    <li class="">
                        <Link class="hover:underline ">Documentacion legal</Link>
                    </li>
                    <li class="">
                        <Link class="hover:underline">Politica de privacidad</Link>
                    </li>
                    <li >
                        <Link class="hover:underline">Terminos y condiciones del sitio web</Link>
                    </li>
                    <li>
                        <Link class="hover:underline">Politicas sobre cookies</Link>
                    </li>
                </ul>
            </div>
            <div class="mt-8 text-gray-300 text-sm lg:text-md">
                <p>© 2024 CIS | Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <MazDrawer variant="right" v-model="isOpenedRight">
        <template #title>
            Menu
        </template>
        <template #default="{ close }">
            <div style="padding: 16px;">
                <ul class="space-y-4">
                    <li>
                        <Link :href="route('login')"
                              aria-label="Registro"
                              class="bg-blue-950 px-4 py-2.5 w-full text-slate-50 rounded-lg hover:opacity-80 duration-200"
                        >
                            Ingresar
                        </Link>
                    </li>
                </ul>
                <div class="mt-4 flex flex-wrap gap-05">
                    <button @click="close">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 text-slate-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </template>
    </MazDrawer>
</template>
