<template>
    <b-modal ref="modal" title="Delete environment?" @ok="handleOk">
        <p>Are you sure delete environment "{{environment.name}}"?</p>
    </b-modal>
</template>

<script>
    import api from '@/api/';

    export default  {
        data() {
            return {
                environment: {}
            }
        },
        methods: {
            show(environment) {
                this.environment = environment;
                this.$refs.modal.show();
            },
            handleOk(evt) {
                evt.preventDefault();
                api.environment.delete(this.environment.id).then(result => {
                    this.$refs.modal.hide();
                    this.$emit('deleted', this.environment.id);
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>
