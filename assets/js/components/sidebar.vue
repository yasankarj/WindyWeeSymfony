<template>
    <div
        :class="componentClass"
        :style="{ width: collapsed ? '70px' : 'auto' }"
    >
        <div v-show="!collapsed">
            <h5 class="text-center">
                Categories
            </h5>
            <loading-component v-show="loading"></loading-component>
            <ul class="nav flex-column mb4">
                <li class="nav-item">
                    <a
                        :class="{
                            'nav-link': true,
                            'selected': currentCategoryId === null,
                        }"
                        href="/"
                    >All Products</a>
                </li>

                <li
                    v-for="category in categories"
                    :key="category['@id']"
                    class="nav-item"
                >
                    <a
                        :class="{
                            'nav-link': true,
                            'selected': currentCategoryId === category['@id'],
                        }"
                        :href="`/category/${category.id}`"
                    >{{ category.name }}</a>
                </li>
            </ul>

            <hr>
        </div>

        <div class="d-flex justify-content-end">
            <button
                class="btn btn-secondary btn-sm"
                @click="$emit('toggle-collapsed')"
            >
                {{ collapsed ? '>>' : '<< Collapse' }}
            </button>
        </div>
    </div>
</template>

<script>

import LoadingComponent from '@/components/loading';

export default {
    name: 'Sidebar',
    props: {
        categories: {
            type: Array,
            required: true,
        },
        collapsed: {
            type: Boolean,
            required: true,
        },
        currentCategoryId: {
            type: String,
            default: null,
        },
    },
    // data() {
    //     return {
    //         collapsed: false,
    //     };
    // },
    computed: {
        /**
       *
       * @returns {[*, string, string]}
       */
        componentClass() {
            const classes = [this.$style.component, 'p-3', 'mb-5'];

            if (this.collapsed) {
                classes.push(this.$style.collapsed);
            }
            return classes;
        },
        loading() {
            return this.categories.length === 0;
        },
    },
    components: {
        LoadingComponent,
    },
    created() {
        console.log(this);
    },
};
</script>

<style lang="scss" module>
@import "~styles/components/light-component";
.component {
  @include light-component;

  ul {
    li a:hover {
      background: $blue-component-link-hover;
    }
    :global li a.selected {
      background: $light-component-border;
    }
  }

  &.collapsed {
    width: 70px;
  }
}
</style>
