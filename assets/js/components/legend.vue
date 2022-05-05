<template>
    <div class="row">
        <span class="p-3">
            {{ title }}
        </span>
    </div>
</template>

<script>
export default {
    name: 'Legend',
    props: {
        title: {
            type: String,
            required: true,
        },
    },
};
</script>

<style scoped>

</style>
