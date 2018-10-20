<template>
    <b-modal ref="modal" title="Create environment" @ok="handleOk">
        <Form ref="form" v-model="this.environment"></Form>
    </b-modal>
</template>

<script>
    import api from '@/api/';
    import Form from './Form';

    export default  {
        props: {
            projectId: String
        },
        components: {
            Form
        },
        data() {
            return {
                environment: {
                    name: '',
                    enabled: true
                }
            }
        },
        methods: {
            show() {
                this.$refs.modal.show();
            },
            handleOk(evt) {
                evt.preventDefault();
                this.environment.project = this.projectId;
                api.environment.create(this.environment).then(environment => {
                    this.$emit('created', environment);
                    this.$refs.modal.hide();
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>
