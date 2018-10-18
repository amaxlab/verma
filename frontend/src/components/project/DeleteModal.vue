<template>
    <b-modal ref="deleteProjectModal" title="Delete project?" @ok="handleOk">
        <p>Are you sure delete project "{{name}}"?</p>
    </b-modal>
</template>

<script>
    import api from '@/api/';

    export default  {
        data() {
            return {
                id: 0,
                name: '',
            }
        },
        methods: {
            show(id, name) {
                this.id = id;
                this.name = name;
                this.$refs.deleteProjectModal.show();
            },
            handleOk(evt) {
                evt.preventDefault();
                api.project.delete(this.id).then(result => {
                    this.$refs.deleteProjectModal.hide();
                    this.$emit('projectDeleted');
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>
