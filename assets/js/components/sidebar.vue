<template>
    <div
        :class="componentClass"
        :style="{ width: collapsed ? '70px' : 'auto' }"
    >
        <div v-show="!collapsed">
            <h5 class="text-center">
                Categories
            </h5>
            <ul class="nav flex-column mb4">
                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="/"
                    >All Products</a>
                </li>

                <li
                    v-for="category in categories"
                    :key="category.id"
                    class="nav-item"
                >
                    <a
                        class="nav-link"
                        :href="category.link"
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
  }

  &.collapsed {
    width: 70px;
  }
}
</style>
