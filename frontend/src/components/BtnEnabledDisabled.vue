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
        data() {
            return {
                enabled: this.value
            }
        },
        methods: {
            click() {
                this.enabled = !this.enabled;
                this.$emit('input', this.enabled);
                this.$emit('click', this.enabled);
            }
        },
        computed: {
            enabledText() {
                return this.enabled ? 'YES' : 'NO';
            },
            enabledVariant() {
                return this.enabled ? 'outline-success' : 'outline-warning';
            }
        }
    }
</script>
