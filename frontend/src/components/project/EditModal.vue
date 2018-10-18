<template>
    <b-modal ref="editProjectModal" title="Edit project" @ok="handleOk">
        <EditForm ref="editForm"></EditForm>
    </b-modal>
</template>

<script>
    import api from '@/api/';
    import EditForm from './EditForm';

    export default  {
        components: {
            EditForm
        },
        data() {
            return {
                project: {}
            }
        },
        methods: {
            show(project) {
                this.project = project;
                this.$refs.editForm.setData(project);
                this.$refs.editProjectModal.show();
            },
            handleOk(evt) {
                evt.preventDefault();
                const project = this.$refs.editForm.getData();
                api.project.update(this.project.id, project).then(result => {
                    this.project = project;
                    this.$refs.editProjectModal.hide();
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>
