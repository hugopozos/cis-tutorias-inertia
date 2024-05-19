import { ref } from 'vue'

export function useSidebarStore() {
    const isSidebarOpen = ref(false)

    function toggleSidebar() {
        isSidebarOpen.value = !isSidebarOpen.value
    }

    return { isSidebarOpen, toggleSidebar }
}
