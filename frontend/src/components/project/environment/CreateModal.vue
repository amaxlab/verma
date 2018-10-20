<template>
    <b-modal ref="modal" title="Create environment" @ok="handleOk">
        <Form ref="form" v-model="this.project"></Form>
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
                project: {
                    name: '',
                    enabled: true,
                    project: this.projectId
                }
            }
        },
        methods: {
            show() {
                this.$refs.modal.show();
            },
            handleOk(evt) {
                evt.preventDefault();
                api.environment.create(this.project).then(environment => {
                    this.$emit('created', environment);
                    this.$refs.modal.hide();
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>
