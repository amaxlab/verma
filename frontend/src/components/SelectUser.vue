<template>
    <b-form-select :options="options" :value="value" @input="input"></b-form-select>
</template>
<script>
    import api from '@/api/';
    export default {
        props: {
            value: {
                type: String,
                default: '',
            }
        },
        data() {
            this.getUsers();
            return {
                options: [],
            }
        },
        methods: {
            input(e) {
                this.$emit('input', e);
            },
            getUsers() {
                api.user.getAll().then(users => {
                    let options = [];
                    users['hydra:member'].forEach(function(element) {
                        options.push({text: element.username, value: element['@id']});
                    });
                    this.options = options;
                }).catch(error => {
                    this.options = [];
                });
            },
        }
    }
</script>
