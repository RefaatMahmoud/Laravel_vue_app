<template>
    <div>
        <!-- Page Wrapper -->
        <div id="wrapper">
            <Sidebar></Sidebar>
            <!-- Content Wrapper -->
            <div class="d-flex flex-column" id="content-wrapper">

                <div id="content">
                    <Navbar></Navbar>
                    <router-view></router-view>
                </div>
                <Footer></Footer>
            </div>
        </div>


    </div>
</template>

<script>
    import Sidebar from "./components/partials/Sidebar";
    import Navbar from "./components/partials/Navbar";
    import Statistics from "./components/partials/Statistics";
    import Footer from "./components/partials/Footer";

    export default {
        name: "App",
        components: {
            Sidebar,
            Navbar,
            Statistics,
            Footer
        }
    }
</script>

<style scoped>

</style>
