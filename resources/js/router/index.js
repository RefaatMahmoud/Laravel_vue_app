import Vue from 'vue'
import VueRouter from 'vue-router'
import MainDashboard from "../views/MainDashboard";
import ProductsIndex from "../views/Products/Index";
import ProductsCreate from "../views/Products/Create"
import store from "../store";

Vue.use(VueRouter)

const basePath = store.state.basePath

const routes = [
    {path: basePath + '/', name: 'dashboard', component: MainDashboard},
    {path: basePath + '/products', name: 'products.index', component: ProductsIndex},
    {path: basePath + '/products/create', name: 'products.create', component: ProductsCreate},
]

const router = new VueRouter(
    {
        mode: "history",
        routes: routes,
        linkActiveClass: "active"
    }
)

export default router
