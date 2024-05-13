<script setup>
import { Head, Link } from '@inertiajs/vue3';
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import BannerImage from "@/Assets/edificio_cis.webp";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Bienvenido" />

    <DefaultLayout>
        <section class="relative overflow-hidden bg-cover bg-no-repeat text-center h-screen flex
        items-center justify-center"
                 :style="`background-image: url(${BannerImage})`"
        >
            <div class="absolute inset-0 bg-gradient-to-b from-slate-900/60 to-black/80"></div>
            <h1 class="relative text-slate-50 text-4xl font-bold lg:text-6xl">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            </h1>
        </section>

        <section class="w-full py-16">
            <div class="max-w-screen-xl mx-auto" data-aos="fade-up" data-aos-duration="2000">
                <div>
                    <h2 class="text-xs font-bold text-gray-400 tracking-widest
                     uppercase lg:text-sm">
                        Contenido
                    </h2>
                    <span class="text-gray-950 text-3xl font-bold font-monserrat tracking-tight lg:text-5xl">
                    Nuestros videos informativos
                </span>
                    <p id="helper-youtube" class="text-sm text-gray-400">Mira y aprende de todos nuestros videos en
                        <a href="https://www.youtube.com/@CISYT" class="font-medium flex gap-2 text-blue-600 hover:underline">
                            YouTube
                            <svg class="w-6" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 461.001 461.001"
                                 xml:space="preserve" fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                <g>
                                    <path style="fill:#F61C0D;"
                                          d="M365.257,67.393H95.744C42.866,67.393,0,110.259,0,163.137v134.728 c0,52.878,42.866,95.744,95.744,95.744h269.513c52.878,0,95.744-42.866,95.744-95.744V163.137 C461.001,110.259,418.135,67.393,365.257,67.393z M300.506,237.056l-126.06,60.123c-3.359,1.602-7.239-0.847-7.239-4.568V168.607 c0-3.774,3.982-6.22,7.348-4.514l126.06,63.881C304.363,229.873,304.298,235.248,300.506,237.056z">
                                    </path>
                                </g>
                            </g>
                        </svg>
                        </a>
                    </p>
                </div>
                <div class="py-12 lg:grid lg:grid-cols-7">
                    <div class="lg:col-start-1 lg:col-end-6 lg:mr-6">
                        <iframe class="w-full h-full rounded-xl"
                                src="https://www.youtube.com/embed/PDShqWbV7F4?si=vspHLd7l9oBrqMVL" title="YouTube video player"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen>
                        </iframe>
                    </div>
                    <div class="flex flex-row gap-x-4 lg:col-span-2 lg:grid lg:grid-rows-3 lg:gap-y-6">
                        <div>
                            <iframe class="w-full h-full rounded-xl"
                                    src="https://www.youtube.com/embed/M4RINM5aymE?si=VjiYw9dVHwjbbCfq"
                                    title="YouTube video player"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen>
                            </iframe>
                        </div>
                        <div>
                            <iframe class="w-full h-full rounded-xl"
                                    src="https://www.youtube.com/embed/4Y7V-LfL5gw?si=ix4NwnX9_5knti_S"
                                    title="YouTube video player"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen>
                            </iframe>
                        </div>
                        <div>
                            <iframe class="w-full h-full rounded-xl"
                                    src="https://www.youtube.com/embed/4FBHLB0AdIQ?si=mYnx2k3v9WEPw53W"
                                    title="YouTube video player"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
