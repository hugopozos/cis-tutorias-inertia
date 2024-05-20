import { createStore } from 'vuex';

const store = createStore({
    state: {
        isSidebarOpen: false,
    },
    mutations: {
        toggleSidebar(state) {
            state.isSidebarOpen = !state.isSidebarOpen;
        }
    },
    actions: {
        toggleSidebar({ commit }) {
            commit('toggleSidebar');
        }
    },
    getters: {
        isSidebarOpen: state => state.isSidebarOpen
    }
});

export default store;
