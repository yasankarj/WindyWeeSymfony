<template>
    <div>
        <product-list :products="products"/>
        <div class="row">

        </div>
        <legend-component :title="title" />
    </div>
</template>

<script>
import LegendComponent from '@/components/legend';
import ProductList from '@/components/product-list';
import ProductCard from '@/components/product-list'
import axios from 'axios';

export default {

    name: 'Catalog',
    components: {
        LegendComponent,
        ProductList,
    },
    data() {
        return {
            title: 'Shipping takes 10-12 weeks, and products probably won\'t work',
            products: [],
        };
    },
    async mounted() {
        const response = await axios.get('/api/products');
        this.products = response.data['hydra:member'];
    },
};
</script>

<style scoped>

</style>
