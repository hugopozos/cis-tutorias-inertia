<script setup>
import {computed, ref, watch} from "vue";
import {cva} from "class-variance-authority";
import {
    InformationCircleIcon,
    ExclamationTriangleIcon,
    XCircleIcon,
    CheckCircleIcon
} from '@heroicons/vue/24/solid'
import {usePage} from "@inertiajs/vue3";

const alert = computed(() => usePage().props.notification.message)
const showAlert = ref(false);

watch(alert, (newValue) => {
    console.log('Alerta: ' + alert)
    showAlert.value = newValue !== null;
    console.log('Nueva alerta recibida: ' + showAlert.value)
    if (showAlert.value) {
        console.log('Alerta finaliza: ' + showAlert.value)
        setTimeout(closeAlert, 5000);
    }
});

const closeAlert = () => {
    usePage().props.notification.message = null;
};

const containerClass = computed(() => {
    return cva("flex p-4 rounded-md space-x-3", {
        variants: {
            intent: {
                message: "bg-blue-200 border border-blue-400",
                success: "bg-green-200 border border-green-400",
                warning: "bg-yellow-100 border border-yellow-400",
                error: "bg-red-200 border border-red-400",
            }
        }
    })({
        intent: alert.value.type
    })
});

const messageClas = computed(() => {
    return cva("text-md", {
        variants: {
            intent: {
                message: "text-blue-900",
                success: "text-green-900",
                warning: "text-yellow-900",
                error: "text-red-900",
            }
        }
    })({
        intent: alert.value.type
    })
});

const tittleClass = computed(() => {
    return cva("text-md font-bold", {
        variants: {
            intent: {
                message: "text-blue-900",
                success: "text-green-900",
                warning: "text-yellow-900",
                error: "text-red-900",
            }
        }
    })({
        intent: alert.value.type
    })
});

const buttonClass = computed(() => {
    return cva("p-0.5 rounded-md", {
        variants: {
            intent: {
                message: "text-blue-900/70 hover:bg-blue-300",
                success: "text-green-900/70 hover:bg-green-300",
                warning: "text-yellow-900/70 hover:bg-yellow-300",
                error: "text-red-900/70 hover:bg-red-300",
            }
        }
    })({
        intent: alert.value.type
    })
});

const iconClass = computed(() => {
    return cva("w-6 h-6", {
        variants: {
            intent: {
                message: "text-blue-900",
                success: "text-green-900",
                warning: "text-yellow-900",
                error: "text-red-900",
            }
        }
    })({
        intent: alert.value.type
    })
});

const iconComponent = computed(() => {
    const icons = {
        message: InformationCircleIcon,
        success: CheckCircleIcon,
        warning: ExclamationTriangleIcon,
        error: XCircleIcon,
    };
    return icons[alert.value.type];
});

</script>

<template>
    <transition enter-from-class="translate-y-[150%] opacity-0"
                enter-active-class="transition duration-500"
                enter-to-class="opacity-100"
                leave-to-class="opacity-0"
                leave-active-class="transition duration-300"
    >
        <div v-if="alert" class="absolute end-0 mt-24 mr-14 z-50">
            <div :class="containerClass">
                <div class="shrink-0">
                    <component :is="iconComponent" :class="iconClass" />
                </div>
                <div class="flex-1 w-52">
                    <h2 :class="tittleClass">{{ alert.title }}</h2>
                    <p :class="messageClas">{{ alert.message }}</p>
                </div>
                <div class="shrink-0" >
                    <button @click="closeAlert" :class="buttonClass">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </transition>
</template>
