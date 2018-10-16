<template>
    <Page>
        <template slot="content">
            <h1><back-btn></back-btn>User</h1>
        </template>
    </Page>
</template>
<script>
    import Page from '../components/Page';
    import BackBtn from '../components/BackBtn';

    export default {
        components: {Page, BackBtn}
    }
</script>
