<template>
    <b-form-select :options="options" :value="value" @input="input"></b-form-select>
</template>
<script>
    export default {
        props: {
            value: {
                type: String,
                default: true
            }
        },
        data() {
            return {
                options: [
                    {text: 'Guest', value: 'guest'},
                    {text: 'Project manager', value: 'pm'},
                    {text: 'Tester', value: 'tester'},
                    {text: 'Administrator', value: 'admin'},
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
