<template>
    <b-modal ref="modal" title="Edit component" @ok="handleOk">
        <Form ref="form" v-model="component"></Form>
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
                component: {}
            }
        },
        methods: {
            show(component) {
                this.component = component;
                this.$refs.form.setData(component);
                this.$refs.modal.show();
            },
            handleOk(evt) {
                evt.preventDefault();
                api.component.update(this.component.id, this.component).then(component => {
                    this.$emit('updated', component);
                    this.$refs.modal.hide();
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>
