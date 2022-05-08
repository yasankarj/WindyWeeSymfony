<template>
    <div class="row">
        <div class="col-12">
            <div class="mt-4">
                <loading v-show="products.length === 0"/>
            </div>
        </div>
        <product-card
            v-for="product in products"
            :key="product['@id']"
            class="col-xs-12 col-4 mb-2 pb-2"
            :product="product"
        />
    </div>
</template>

<script>
import Loading from '@/components/loading';
import ProductCard from '@/components/product-list/product-card';

export default {
    name: 'ProductList',
    components: {
        ProductCard,
        Loading,
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
