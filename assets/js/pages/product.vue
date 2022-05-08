<template>
    <div class="container-fluid">
        <div class="row">
            <aside :class="asideClass">
                <sidebar-component
                    :categories="categories"
                    :collapsed="sideBarCollapsed"
                    :current-category-id="currentCategoryId"
                    @toggle-collapsed="toggleSidebarCollapsed"
                />
            </aside>
            <div :class="contentClass">
                <catalog-component
                    :current-category-id="currentCategoryId"
                    :categories="categories"
                />
            </div>
        </div>
    </div>
</template>

<script>
import CatalogComponent from '@/components/catalog';
import SidebarComponent from '@/components/sidebar';
import PageContextService from '@/services/page-context-service';
import CategoriesApiService from '@/services/categories-api-service';

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
        currentCategoryId() {
            return PageContextService.getCurrentCategoryId();
        },
    },
    async mounted() {
        const response = await CategoriesApiService.fetchCategories();
        this.categories = response.data['hydra:member'];
    },
    methods: {
        toggleSidebarCollapsed() {
            this.sideBarCollapsed = !this.sideBarCollapsed;
        },
    },
};
</script>

<style lang="scss" module>

</style>
