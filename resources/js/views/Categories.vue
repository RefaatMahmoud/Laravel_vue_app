<template>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Categories Management</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table cellspacing="0" class="table table-bordered" id="dataTable" width="100%">
                        <thead>
                        <tr>
                            <th width="20%">ID</th>
                            <th width="40%">Name</th>
                            <th width="30%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>System Architect</td>
                            <td>
                                <button class="btn btn-info">
                                    <i class="fa fa-eye"></i>
                                    Show
                                </button>
                                <button class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </button>
                                <button class="btn btn-danger">
                                    <i class="fa fa-times"></i>
                                    Delete
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Categories"
    }
</script>

<style scoped>

</style>
