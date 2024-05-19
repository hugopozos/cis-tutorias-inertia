<script setup lang="ts">
import { ref } from 'vue'

const target = ref(null)
const dropdownOpen = ref(false)
const notifying = ref(true)

</script>

<template>
    <li class="relative" ref="target">
        <button
            @click="dropdownOpen = !dropdownOpen"
            class="flex items-center justify-center w-9 h-9 rounded-full bg-slate-200 border border-slate-300
            text-gray-500 hover:text-blue-800 duration-150 focus:outline-none"
            :class="{ 'text-indigo-900 ring-1 focus:ring-blue-900/50': dropdownOpen }"
        >
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
            </svg>
        </button>

        <!-- Dropdown Start -->
        <Transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-95"
        >
            <div
                v-show="dropdownOpen"
                class="absolute -right-27 mt-2.5 flex h-90 w-75 flex-col rounded-sm border border-stroke bg-white shadow-md sm:right-0 sm:w-80"
            >
                <div class="px-4 py-3">
                    <h5 class="text-sm font-medium text-slate-500">Notificaciones</h5>
                </div>

                <ul class="flex h-auto flex-col overflow-y-auto">
                    <!--
                    <template v-for="(item, index) in notificationItems" :key="index">
                        <li>
                            <span
                                class="flex flex-col gap-2.5 border-t border-stroke px-4.5 py-3 hover:bg-gray-2 dark:border-strokedark dark:hover:bg-meta-4"
                                :to="item.route"
                            >
                                <p class="text-sm">
                                    <span class="text-black dark:text-white">{{ item.title }}</span>
                                    {{ item.details }}
                                </p>

                                <p class="text-xs">{{ item.time }}</p>
                            </span>
                        </li>
                    </template>
                    -->
                    <li class="flex flex-col gap-2 border-t border-stroke px-4 py-3 hover:bg-gray-100">
                        <span class="text-slate-700 text-md">¡No tienes ningún mensaje!</span>
                    </li>
                </ul>
            </div>
        </Transition>
        <!-- Dropdown End -->
    </li>
</template>
