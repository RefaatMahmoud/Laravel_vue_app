import Vue from 'vue';
import App from './App';
import store from "./store";
import FlashMessage from "@smartweb/vue-flash-message"


import router from "./router/index";
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap';

Vue.use(FlashMessage);

new Vue({
    el: '#app',
    router : router,
    store : store,
    render: h => h(App)
});
