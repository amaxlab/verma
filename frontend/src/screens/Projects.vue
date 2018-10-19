<template>
    <Page>
        <template slot="content">
            <CreateModal ref="createProjectModal"></CreateModal>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h1">Projects</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <b-btn @click="openCreateModal" variant="success"><i class="fa fa-plus"></i> New</b-btn>
                    </div>
                </div>
            </div>
            <Grid></Grid>
        </template>
    </Page>
</template>
<script>
    import Page from '../components/Page';
    import Grid from "../components/project/Grid";
    import CreateModal from "../components/project/CreateModal";

    export default {
        components: {Grid, Page, CreateModal},
        methods: {
            openCreateModal() {
                this.$refs.createProjectModal.show()
            }
        }
    }
</script>
