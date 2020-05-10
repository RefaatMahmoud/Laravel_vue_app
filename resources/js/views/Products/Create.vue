<template>
    <div class="container-fluid">
        <div style="width: 100px;font-size: 20px;" class="col-md-12">
            <!--            <FlashMessage :position="'right top'"></FlashMessage>-->
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 style="display: inline-block" class="m-0 font-weight-bold text-primary">Create Product</h5>
            </div>
            <div class="card-body">
                <form @submit.prevent="createProduct">
                    <div class="row">
                        <div class="col-md-8 form-group">
                            <label>Name</label>
                            <input type="text"
                                   name="name"
                                   v-model="productData.name"
                                   class="form-control"
                                   placeholder="Enter product name"
                                   autocomplete="off">
                            <div v-if="errors['name']" class="pt-3 text-danger">{{errors['name'][0]}}</div>
                        </div>
                        <div class="col-md-8 form-group">
                            <label>Photo</label>
                            <input type="file"
                                   @change="attachImage"
                                   class="form-control">
                            <div v-if="errors['image']" class="pt-3 text-danger">{{errors['image'][0]}}</div>
                        </div>
                        <div class="col-md-8 form-group">
                            <div id="preview">
                                <img width="100px" v-if="url" :src="url"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <router-link to="/products" class="btn btn-danger">
                                <i class="fa fa-backward"></i> Back
                            </router-link>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import Axios from "axios";
    import * as ProductService from "../../services/product_service"

    export default {
        name: "ProductsCreate",
        data() {
            return {
                productData: {
                    name: '',
                    image: '',
                },
                url: null,
                errors: {}
            }
        },
        methods: {
            attachImage(e) {
                const file = e.target.files[0];
                this.url = URL.createObjectURL(file);
                this.productData.image = file
            },
            async createProduct() {
                try {
                    let data = new FormData();
                    data.append('name', this.productData.name);
                    data.append('image', this.productData.image);
                    const response = await ProductService.create(data);
                    if (response.status === 422 && response.hasOwnProperty('data')) {
                        this.errors = response.data.errors;
                    }
                } catch (error) {
                    alert(error)
                }
            }
        }
    }
</script>

<style scoped>

</style>
