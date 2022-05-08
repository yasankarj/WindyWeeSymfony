<template>
    <div>
        <product-list
            :products="products"
            :loading="loading"
        />
        <div class="row" />
        <legend-component :title="title" />
    </div>
</template>

<script>
import LegendComponent from '@/components/legend';
import ProductList from '@/components/product-list';

import axios from 'axios';
import ProductsApiService from '@/services/products-api-service';

export default {

    name: 'Catalog',
    components: {
        LegendComponent,
        ProductList,
    },
    props: {
        currentCategoryId: {
            type: String,
            default: null,
        },
    },
    data() {
        return {
            title: 'Contact : Yasanka +9477XXXXXXX',
            products: [],
            loading: false,
        };
    },
    async mounted() {
        const params = {};
        let response;

        try {
            if (this.currentCategoryId) {
                params.category = this.currentCategoryId;
            }
            this.loading = true;
            response = await ProductsApiService.fetchProducts(params);
            this.loading = false;
        } catch (e) {
            this.loading = false;
        }
        this.products = response.data['hydra:member'];
    },
};
</script>

<style scoped>

</style>
