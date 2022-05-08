<template>
    <div class="container-fluid">
        <div class="row">
            <aside :class="asideClass">
                <sidebar-component
                    :categories="categories"
                    :collapsed="sideBarCollapsed"
                    @toggle-collapsed="toggleSidebarCollapsed"
                />
            </aside>
            <div :class="contentClass">
                <catalog-component />
            </div>
        </div>
    </div>
</template>

<script>
import CatalogComponent from '@/components/catalog';
import SidebarComponent from '@/components/sidebar';
import axios from 'axios';

export default {
    name: 'Product',
    components: {
        CatalogComponent,
        SidebarComponent,
    },
    data() {
        return {
            sideBarCollapsed: false,
            categories: [],
        };
    },
    computed: {
        asideClass() {
            return this.sideBarCollapsed ? 'asidebar-collapsed' : 'col-xs-12 col-3';
        },
        contentClass() {
            return this.sideBarCollapsed ? 'col-xs-12 col-11' : 'col-xs-12 col-9';
        },
    },
    methods: {
        toggleSidebarCollapsed() {
            this.sideBarCollapsed = !this.sideBarCollapsed;
        },
    },
    async mounted() {
        const response = await axios.get('/api/categories');
        this.categories = response.data['hydra:member'];
    },
};
</script>

<style lang="scss" module>

</style>
