<template>
    <Page>
        <template slot="content">
            <CreateModal ref="createProjectModal"></CreateModal>
            <h1>Projects</h1>
            <b-btn @click="openCreateModal">Create project</b-btn>
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
