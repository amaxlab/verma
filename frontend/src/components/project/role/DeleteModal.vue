<template>
    <b-modal ref="modal" title="Delete access?" @ok="handleOk">
        <p>Are you sure delete access "{{access.role}}"?</p>
    </b-modal>
</template>

<script>
    import api from '@/api/';
    export default  {
        data() {
            return {
                access: {}
            }
        },
        methods: {
            show(access) {
                this.access = access;
                this.$refs.modal.show();
            },
            handleOk(evt) {
                evt.preventDefault();
                api.project_access.delete(this.access.id).then(result => {
                    this.$refs.modal.hide();
                    this.$emit('deleted', this.access.id);
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>
