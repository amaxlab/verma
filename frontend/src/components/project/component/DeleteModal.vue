<template>
    <b-modal ref="modal" title="Delete component?" @ok="handleOk">
        <p>Are you sure delete component "{{component.name}}"?</p>
    </b-modal>
</template>

<script>
    import api from '@/api/';

    export default  {
        data() {
            return {
                component: {}
            }
        },
        methods: {
            show(component) {
                this.component = component;
                this.$refs.modal.show();
            },
            handleOk(evt) {
                evt.preventDefault();
                api.component.delete(this.component.id).then(result => {
                    this.$refs.modal.hide();
                    this.$emit('deleted', this.component.id);
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>
