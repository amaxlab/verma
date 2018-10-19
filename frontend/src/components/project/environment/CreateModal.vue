<template>
    <b-modal ref="modal" title="Create environment" @ok="handleOk">
        <Form ref="form"></Form>
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
                projectId: ''
            }
        },
        methods: {
            show(projectId) {
                this.projectId = projectId;
                this.$refs.modal.show();
            },
            handleOk(evt) {
                evt.preventDefault();
                const {name, enabled} = this.$refs.form.getData();
                api.environment.create({name, enabled, project: this.projectId}).then(environment => {
                    this.$emit('created', environment);
                    this.$refs.modal.hide();
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>
