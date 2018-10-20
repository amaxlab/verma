<template>
    <b-modal ref="modal" title="Create component" @ok="handleOk">
        <Form ref="form" v-model="this.component"></Form>
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
                component: {
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
                this.component.project = this.projectId;
                api.component.create(this.component).then(component => {
                    this.$emit('created', component);
                    this.$refs.modal.hide();
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>
