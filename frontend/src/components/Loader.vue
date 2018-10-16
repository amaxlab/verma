<template>
    <div class="loader" v-if="this.$store.state.loader.visible">
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
        <span class="sr-only">Loading...</span>
    </div>
</template>

<script>
    export default {
    }
</script>

<style>
    .loader {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 1;
        width: 100px;
        height: 100px;
    }
</style>
