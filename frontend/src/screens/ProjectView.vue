<template>
    <Page>
        <template slot="content">
            <projectView :projectId="$route.params.id"></projectView>
        </template>
    </Page>
</template>
<script>
    import Page from '../components/Page';
    import View from '../components/project/View';

    export default {
        components: {Page, projectView: View}
    }
</script>
