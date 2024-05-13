<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <header class="antialiased py-2 w-full top-0 border-b border-gray-100 shadow-2xl z-50">
        <div class="max-w-screen-2xl mx-auto items-center lg:grid lg:grid-cols-2">
            <Link href="/">
                <ApplicationLogo />
            </Link>
            <nav class="hidden lg:block"
                 aria-label="Barra de navegación principal"
            >
                <ul class="flex items-center justify-end space-x-4">
                    <li>
                        <Link :href="route('login')"
                              aria-label="Inicio de sesión"
                              class="hover:opacity-80 duration-200"
                        >
                            Ingresar
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('register')"
                              aria-label="Registro"
                              class="bg-blue-950 px-4 py-2.5 text-slate-50 rounded-lg hover:opacity-80 duration-200"
                        >
                            Registrarse
                        </Link>
                    </li>
                </ul>
            </nav>
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
                <!-- Enlaces -->
                <div>
                    <h2 class="mb-5 text-sm font-bold font-monserrat lg:text-2xl">Lorem ipsum</h2>
                    <ul class="text-gray-50 dark:text-gray-400 font-lato">
                        <li class="mb-4">
                        </li>

                    </ul>
                </div>
                <div>
                    <h2 class="mb-5 text-sm font-bold font-monserrat lg:text-2xl">Lorem ipsum</h2>
                    <ul class="text-gray-50 dark:text-gray-400 font-lato">
                        <li class="mb-4">
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-5 text-sm font-bold font-monserrat lg:text-2xl">Lorem ipsum</h2>
                    <ul class="text-gray-50 dark:text-gray-400 font-lato">
                        <li class="mb-4">
                        </li>
                    </ul>
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
                <p>© 2024 lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    <br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </p>
            </div>
        </div>

    </footer>
</template>
