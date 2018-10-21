<template>
    <b-modal ref="modal" title="New access" @ok="handleOk">
        <Form ref="form" v-model="this.access"></Form>
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
                access: {
                    user: '',
                    role: 'guest',
                }
            }
        },
        methods: {
            show() {
                this.$refs.modal.show();
            },
            handleOk(evt) {
                evt.preventDefault();
                this.access.project = this.projectId;
                api.project_access.create(this.access).then(access => {
                    this.$emit('created', access);
                    this.$refs.modal.hide();
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>
