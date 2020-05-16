<template>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 style="display: inline-block" class="m-0 font-weight-bold text-primary">Products Management</h5>
                <div class="fa-pull-right">
                    <router-link :to="{ name : 'products.create'}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Create Product
                    </router-link>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table cellspacing="0" class="table table-bordered" id="dataTable" width="100%">
                        <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="30%">Name</th>
                            <th width="30%">Image</th>
                            <th width="30%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(product,index) in products" :key="index">
                            <td>{{index+1}}</td>
                            <td>{{product.name}}</td>
                            <td><img style="width: 80px;height: 80px;" :src="product.image"></td>
                            <td>
                                <a href="#" class="text text-info p-2">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="#" class="text text-primary p-2">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a @click="deleteProduct(product)" class="text text-danger p-2"
                                   data-target="#exampleModal"
                                   data-toggle="modal"
                                   href="#">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <FlashMessage :position="'right top'"></FlashMessage>
    </div>
</template>

<script>
    import * as ProductService from "../../services/product_service";

    export default {
        name: "ProductsIndex",
        data() {
            return {
                products : null
            }
        },
        mounted() {
            this.getProducts();
        },
        methods: {
            async getProducts() {
                try {
                    const response = await ProductService.get();
                    console.log(response);
                    this.products = response;
                } catch (e) {
                    alert(e);
                }
            },
            async deleteProduct(product) {
                let confirm_delete = window.confirm('Are you sure to delete this product');
                if (confirm_delete) {
                    try {
                        let response = await ProductService.remove(product.id);
                        console.log(response.data.status);
                        if (response.data.status === true) {
                            this.products = this.products.filter(obj => {
                                return obj.id != product.id
                            })
                            this.flashMessage.success({
                                message: 'Product is deleted successfully',
                                time: 1000,
                                blockClass: 'custom-block-class'
                            });
                        }
                    } catch (error) {
                        alert(error)
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>
