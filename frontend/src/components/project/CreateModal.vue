<template>
    <b-modal ref="creteProjectModal" title="Create project" @ok="handleOk">
        <EditForm ref="editForm"></EditForm>
    </b-modal>
</template>

<script>
    import api from '@/api/';
    import router from '@/router/';

    import EditForm from './EditForm';

    export default  {
        components: {
            EditForm
        },
        methods: {
            show() {
                this.$refs.creteProjectModal.show();
            },
            handleOk(evt) {
                evt.preventDefault();
                const {name, enabled} = this.$refs.editForm.getData();
                api.project.create({name, enabled}).then(project => {
                    this.$refs.creteProjectModal.hide();
                    router.push({name: 'project_view', params: {id: project.id}});
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>
