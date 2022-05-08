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

export default {
    name: 'Product',
    components: {
        CatalogComponent,
        SidebarComponent,
    },
    data() {
        return {
            sideBarCollapsed: false,
            categories: [
                {
                    id: 1,
                    name: 'Ladies Wear',
                    link: '#',
                },
                {
                    id: 2,
                    name: 'Kids Wear',
                    link: '#',
                },
                {
                    id: 3,
                    name: 'Accessories',
                    link: '#',
                },
            ],
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
};
</script>

<style lang="scss" module>

</style>
