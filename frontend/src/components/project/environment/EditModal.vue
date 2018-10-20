<template>
    <b-modal ref="modal" title="Edit environment" @ok="handleOk">
        <Form ref="form" v-model="environment"></Form>
    </b-modal>
</template>

<script>
    import api from '@/api/';
    import Form from './Form';

    export default  {
        components: {
            Form
        },
        data() {
            return {
                environment: {}
            }
        },
        methods: {
            show(environment) {
                this.environment = environment;
                this.$refs.form.setData(environment);
                this.$refs.modal.show();
            },
            handleOk(evt) {
                evt.preventDefault();
                api.environment.update(this.environment.id, this.environment).then(environment => {
                    this.$emit('updated', environment);
                    this.$refs.modal.hide();
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>
