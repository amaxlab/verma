<template>
    <Page>
        <template slot="content">
            <h1><back-btn></back-btn>Project</h1>
            <projectView :projectId="$route.params.id"></projectView>
        </template>
    </Page>
</template>
<script>
    import Page from '../components/Page';
    import BackBtn from '../components/BackBtn';
    import View from '../components/project/View';

    export default {
        components: {Page, projectView: View, BackBtn}
    }
</script>
