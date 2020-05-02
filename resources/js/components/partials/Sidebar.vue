<template>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <li class="nav-item">
            <router-link class="nav-link" exact to="/">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </router-link>
        </li>

        <li class="nav-item">
            <router-link class="nav-link" exact to="/categories">
                <i class="fas fa-fw fa-list-alt"></i>
                <span>Categories</span>
            </router-link>
        </li>
    </ul>
</template>

<script>
    export default {
        name: "Sidebar"
    }
</script>

<style scoped>

</style>
