<script lang="ts" setup>
import { Head, Link } from '@inertiajs/vue3';
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import BannerImage from "@/Assets/IMG_4709.webp";
import StudentsImage from "@/Assets/banner_estudiantes.webp";
import LocationImage from "@/Assets/edificio_cis.webp";
import MazGallery, { type MazGalleryImage } from 'maz-ui/components/MazGallery'

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

const images: MazGalleryImage[] = [
    'https://scontent-qro1-1.xx.fbcdn.net/v/t39.30808-6/443696142_748399050839014_1631235047726626806_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=5f2048&_nc_ohc=8VSLUvAdoRoQ7kNvgE9lX4A&_nc_ht=scontent-qro1-1.xx&oh=00_AYCSXrfKAAbXgeAu1R7LldXYE0YAaJdfPHgxNgVGQi7UXA&oe=665B1E85',
    { src: 'https://scontent-qro1-1.xx.fbcdn.net/v/t39.30808-6/337243097_755675146081715_4863086353676510530_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=5f2048&_nc_ohc=cjdAc2woAvUQ7kNvgGI0fxf&_nc_ht=scontent-qro1-1.xx&oh=00_AYCJtFg5RxDg5v595ULnyBXxwS5UsKazyHRrLANNTDamxA&oe=665B44F3', alt: 'image description' },
    { src: 'https://scontent-qro1-2.xx.fbcdn.net/v/t39.30808-6/277558037_3110154922590318_4920856926725909800_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=5f2048&_nc_ohc=_AAmAdmPM8EQ7kNvgEyiNlk&_nc_ht=scontent-qro1-2.xx&oh=00_AYARbfuzjzyLjRCx4lBL7kuZwZHJGmAMFoLrjfiE3VsFeg&oe=665B40CC', alt: 'image description' },
    'https://scontent-qro1-1.xx.fbcdn.net/v/t39.30808-6/442416953_748399234172329_5032031895706205947_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=5f2048&_nc_ohc=LCXlVwxBydUQ7kNvgG4UuZV&_nc_ht=scontent-qro1-1.xx&oh=00_AYDlCo4alwz4FzI9hLKZ2T_qhvwf_Nq-YzTFk2P-M7k0OA&oe=665B2121',
    'https://scontent-qro1-2.xx.fbcdn.net/v/t39.30808-6/370551797_595438252801762_2803034984623064011_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=5f2048&_nc_ohc=1GFETRIEmBIQ7kNvgH-fbZ_&_nc_ht=scontent-qro1-2.xx&oh=00_AYC_6wlYZDfvO_HN8-i1dM0pd_tp3-lQkzTuZdnF6iy6jQ&oe=665B304D',
    'https://scontent-qro1-1.xx.fbcdn.net/v/t39.30808-6/330320102_789486725980391_6333202681538680458_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=5f2048&_nc_ohc=qJkxQdlJvgcQ7kNvgEEUJu8&_nc_ht=scontent-qro1-1.xx&oh=00_AYAs1hlGfB1LoVlw_UhvdREtFJbtJ8ni_0FOQvAdFFiCxw&oe=665B38EF'
]
</script>

<template>
    <Head title="Bienvenido" />

    <DefaultLayout>
        <section class="relative overflow-hidden bg-cover bg-no-repeat text-center h-screen flex
        items-center justify-center scale-100"
                 :style="`background-image: url(${BannerImage})`"
        >
            <div class="absolute inset-0 bg-gradient-to-b from-slate-900/60 to-black/80"></div>
            <div class="flex flex-col">
                <div>
                    <span class="border border-slate-50 p-1 rounded-full text-slate-100 uppercase text-sm lg:text-lg">
                        Comunidad de Ingeniería en Sistemas
                    </span>
                </div>
                <h1 class="mt-3 relative text-slate-50 text-4xl font-bold lg:text-6xl">
                    ¡Piensa, aprende, desarrolla y crea!
                </h1>
                <p class="mt-3 relative text-slate-300 text-lg lg:px-72 lg:text-xl">
                    Por el bien estudiantil y el desarrollo de la tecnología. Organizamos eventos, cursos y talleres,
                    y apoyamos el desarrollo de software para fomentar el crecimiento académico y
                    profesional de los estudiantes del Instituto Tecnológico de Veracruz.
                </p>
            </div>
        </section>

        <section class="w-full py-12 px-4">
            <div class="max-w-screen-xl mx-auto">
                <div class="items-center lg:space-x-4 lg:grid lg:grid-cols-12">
                    <div class="col-start-1 col-end-7"
                         data-aos="fade-up"
                         data-aos-duration="2000"
                    >
                        <h2 class="text-xs font-bold font-monserrat text-slate-400 tracking-widest uppercase lg:text-sm">
                            ¿Quienes somos?
                        </h2>
                        <span class="text-gray-950 text-3xl font-poppins font-bold lg:text-5xl">
                            Comunidad de Ingeniería en Sistemas
                        </span>
                        <p class="mt-4 text-md font-lato text-slate-500 lg:text-lg">
                            Somos una comunidad estudiantil que colabora en la formación y capacitación del estudiante
                            para potenciar los conocimientos adquiridos en clase y desarrollar habilidades que actualmente
                            se encuentran en pleno auge en el mundo laboral. Nuestra misión es brindar conocimiento y
                            actividades en pro de la comunidad estudiantil. Alentando al estudiante a lo largo de su carrera
                            ofreciendo competencias, talleres, ponencias y cursos que mejoren sus habilidades dentro
                            del área de Tecnologías de información.
                        </p>
                    </div>

                    <div class="col-start-7 col-end-13"
                         data-aos="fade-left"
                         data-aos-duration="2000"
                    >
                        <img :src="StudentsImage" alt="alumnado" class="shadow-md rounded-md">
                    </div>
                </div>
            </div>
        </section>

        <section class="w-full py-12 px-4">
            <div class="max-w-screen-xl mx-auto">
                <div class="">
                    <div class=""
                         data-aos="fade-up"
                         data-aos-duration="2000"
                    >
                        <h2 class="text-xs font-bold font-monserrat text-slate-400 tracking-widest uppercase lg:text-sm">
                            ¿Que hacemos?
                        </h2>
                        <span class="text-gray-950 text-3xl font-poppins font-bold lg:text-5xl">
                            Impulsando la Innovación Estudiantil: Eventos, Cursos, Talleres y Desarrollo de Software
                        </span>
                        <p class="mt-4 text-md font-lato text-slate-500 lg:text-lg">
                            Como parte de la comunidad estudiantil del Instituto Tecnológico de Veracruz, organizamos eventos,
                            cursos y talleres, y apoyamos el desarrollo de software, brindando a los estudiantes
                            oportunidades para adquirir conocimientos prácticos y experiencias valiosas.
                        </p>
                    </div>

                    <div class="mt-4"
                         data-aos="fade-up"
                         data-aos-duration="2000"
                    >

                        <MazGallery
                            :images="images"
                            :height="500"
                        />
                    </div>
                </div>
            </div>
        </section>

        <section class="w-full py-12 px-4 bg-gradient-to-b from-[#000021] to-blue-950">
            <div class="max-w-screen-xl mx-auto">
                <div class="items-center lg:space-x-4 lg:grid lg:grid-cols-12">
                    <div class="col-start-1 col-end-7"
                         data-aos="fade-up"
                         data-aos-duration="2000"
                    >
                        <h2 class="text-xs font-bold font-monserrat text-slate-400 tracking-widest uppercase lg:text-sm">
                            Instalaciones
                        </h2>
                        <span class="text-slate-100 text-3xl font-poppins font-bold lg:text-5xl">
                            Nuestro departamento
                        </span>
                        <p class="mt-4 text-md font-lato text-slate-400 lg:text-lg">
                            El departamento de sistemas y computación cuenta con diversos laboratorios de equipo de
                            cómputo en dónde los estudiantes podrán desempañarse en desarrollar diversos programas,
                            aplicaciones y proyectos a lo largo de sus clases prácticas en la carrera de ingeniería en
                            sistemas computacionales.
                            <br> <br>
                            Los laboratorios de cómputo están orientados a servir como herramientas de aprendizaje y
                            apoyo didáctico tanto para los docentes como los alumnos.
                        </p>
                    </div>

                    <div class="col-start-7 col-end-13"
                         data-aos="fade-left"
                         data-aos-duration="2000"
                    >
                        <img :src="LocationImage" alt="Instalaciones" class="shadow-md rounded-md">
                    </div>
                </div>
            </div>
        </section>

        <section class="w-full py-12 px-4">
            <div class="max-w-screen-xl mx-auto" data-aos="fade-up" data-aos-duration="2000">
                <div>
                    <h2 class="text-xs font-bold text-gray-400 tracking-widest
                     uppercase lg:text-sm">
                        Contenido
                    </h2>
                    <span class="text-gray-950 text-3xl font-bold font-monserrat tracking-tight lg:text-5xl">
                        Videos informativos y eventos
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
