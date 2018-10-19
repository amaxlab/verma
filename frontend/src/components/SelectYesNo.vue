<template>
    <b-form-select :options="options" :value="value" @input="input"></b-form-select>
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
                options: [
                    {text: 'YES', value: true},
                    {text: 'NO', value: false}
                ]
            }
        },
        methods: {
            input(e) {
                this.$emit('input', e);
            }
        }
    }
</script>
