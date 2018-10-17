<template>
    <Page>
        <template slot="content">
            <h1>Projects</h1>
            <Grid></Grid>
        </template>
    </Page>
</template>
<script>
    import Page from '../components/Page';
    import Grid from "../components/project/Grid";

    export default {
        components: {Grid, Page}
    }
</script>
