import Vue from 'vue'
import VueRouter from 'vue-router'
import MainDashboard from "./views/MainDashboard";
import Categories from "./views/Categories";

Vue.use(VueRouter)

const routes = [
    {path: '/', component: MainDashboard},
    {path: '/categories', component: Categories},
]

const router = new VueRouter(
    {
        routes: routes,
        linkActiveClass: "active",
        mode: "history"
    }
)

export default router
