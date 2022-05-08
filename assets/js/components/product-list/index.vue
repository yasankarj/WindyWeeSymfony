<template>
    <div class="row">
        <product-card
            v-for="product in products"
            :key="product['@id']"
            class="col-xs-12 col-4 mb-2 pb-2"
            :product="product"
        />
    </div>
</template>

<script>
import ProductCard from '@/components/product-list/product-card';

export default {
    name: 'ProductList',
    components: {
        ProductCard,
    },
    props: {
        products: {
            type: Array,
            required: true,
        },
    },
};
</script>

<style scoped>

</style>
