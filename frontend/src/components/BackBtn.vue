<template>
    <b-button variant="link" @click="goBack"><i class="fa fa-chevron-left"></i></b-button>
</template>

<script>
    export default {
        methods: {
            goBack() {
                this.$router.go(-1);
            }
        }
    }
</script>

