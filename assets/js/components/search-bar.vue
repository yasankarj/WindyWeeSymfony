<template>
    <div>
        <input
            v-model="searchTerm"
            class="form-control"
            placeholder="Search for Products..."
            type="search"
        >
    </div>
</template>

<script>
export default {
    name: 'SearchBar',
    data() {
        return {
            searchTerm: '',
        };
    },
    methods: {
        onInputChange() {
            this.$emit('search-product', { term: this.searchTerm });
        },
    },
};
</script>

<style scoped>

</style>
