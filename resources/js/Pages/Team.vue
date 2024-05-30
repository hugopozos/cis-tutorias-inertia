<script setup>
import {Head} from "@inertiajs/vue3";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

const teamMembers = [
    {
        name: "Hugo Fabrizio Pozos Herrera",
        role: "Desarrollador Fullstack",
        email: "l20021273@veracruz.tecnm.mx",
    },
    {
        name: "Uriel Méndez Romero",
        role: "Base de datos",
        email: "l20021262@veracruz.tecnm.mx",
    },
    {
        name: "Naydeline Hernandez Tenorio",
        role: "Diseñadora de interfaces",
        email: "l20021229@veracruz.tecnm.mx",
    },
    {
        name: "Zabdi Reyes Perez",
        role: "Desarrollador Frontend",
        email: "l20021280@veracruz.tecnm.mx",
    },
];
</script>

<template>
    <Head title="Integrantes" />

    <DefaultLayout>
        <section>
            <section class="w-full py-12 px-4">
                <div class="max-w-screen-2xl mx-auto">
                    <div class="py-4 border-b border-gray-200">
                        <h1 class="text-4xl font-bold text-slate-700">Integrantes</h1>
                        <p class="text-gray-600 mt-2">Conoce al equipo encargado de desarrollar la plataforma de tutorías.</p>
                    </div>
                    <div class="py-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- cards para cada integrante -->
                        <div v-for="member in teamMembers" :key="member.email" class="bg-white shadow-md rounded-lg p-6 flex items-center">
                            <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-xl font-semibold text-gray-700">{{ member.name }}</h2>
                                <p class="text-gray-500">{{ member.role }}</p>
                                <p class="text-gray-400 text-sm">{{ member.email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </DefaultLayout>
</template>
