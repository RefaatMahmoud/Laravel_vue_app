<template>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="#"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>
        <Statistics></Statistics>
    </div>
</template>

<script>
    import Statistics from "../components/partials/Statistics";

    export default {
        name: "MainDashboard",
        components: {
            Statistics
        }
    }
</script>

<style scoped>

</style>
