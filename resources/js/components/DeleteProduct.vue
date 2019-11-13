<template>
    <a href="#" class="btn btn-sm btn-danger btn-product-delete" @click="deleteProduct()"><i class="fa fa-trash"></i></a>
</template>

<script>
    export default {
        name: "delete-product",
        props: ['productid'],
        data() {
            return {
                status: false
            }
        },
        methods: {
            deleteProduct() {
                let _this = this;
                let productid = _this.productid;
                this.$swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        axios.post('/admin/products/'+productid+'/delete', {
                            id: productid,
                        }).then (function(response){
                            if (response.data.status === 'success') {
                                _this.$swal(response.data.message, {
                                    icon: "success",
                                });
                            } else {
                                _this.$swal("Your Product not deleted!", {
                                    icon: "error",
                                });
                            }
                        }).catch(function (error) {
                            console.log(error);
                        });
                    } else {
                        this.$swal("Action cancelled!", {
                            icon: "info",
                        });
                    }
                });
            }
        }
    }
</script>

