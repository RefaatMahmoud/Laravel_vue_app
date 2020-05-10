import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex)
const store = new Vuex.Store({
    state: {
        apiUrl: "http://localhost/laravel_vue_project/api",
        serverUrl: "http://localhost/laravel_vue_project",
        basePath: '/laravel_vue_project',
    },
    mutations: {},
    actions: {}
})
export default store
