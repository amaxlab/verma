<template>
    <b-button :variant="enabledVariant" size="sm" @click="click">{{enabledText}}</b-button>
</template>
<script>
    export default {
        props: {
            value: {
                type: Boolean,
                default: true
            }
        },
        // data() {
        //     return {
        //         enabled: this.value
        //     }
        // },
        methods: {
            click() {
                const enabled = !this.value;
                this.$emit('input', enabled);
                this.$emit('click', enabled);
            }
        },
        computed: {
            enabledText() {
                return this.value ? 'YES' : 'NO';
            },
            enabledVariant() {
                return this.value ? 'outline-success' : 'outline-warning';
            }
        }
    }
</script>
