<script setup>
import { Link } from '@inertiajs/vue3'
defineProps({
    pagination: Object
})
</script>

<template>
    <nav aria-label="Paginación" class="relative flex py-2">
        <template v-if="pagination && pagination.links">
            <template v-for="link in pagination.links" :key="link.label">
                <Link
                    preserve-scroll
                    :href="link.url ?? ''"
                    v-html="link.label"
                    class="flex items-center justify-center px-3.5 py-2 rounded-lg text-sm text-slate-600"
                    :class="{ 'border border-slate-400 text-slate-600 font-bold': link.active }"
                />
            </template>
        </template>
    </nav>
</template>
