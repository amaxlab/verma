<template>
    <div>
        <CreateModal ref="createModal" :project-id="this.project['@id']" @created="onAccessCreated"></CreateModal>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2">Access</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <button type="button" class="btn btn-success" @click="createAccess"><i class="fa fa-plus"></i> Add </button>
                </div>
            </div>
        </div>
        <Grid ref="grid" :project="this.project"></Grid>
    </div>
</template>

<script>
    import Grid from "./Grid";
    import CreateModal from "./CreateModal";
    export default {
        components: {CreateModal, Grid},
        props: {
            project: Object
        },
        data() {
            return {
                roles: this.project.users
            }
        },
        methods: {
            createAccess() {
                this.$refs.createModal.show();
            },
            onAccessCreated(access) {
                this.project.users.push(access);
            },
        },
    }
</script>
