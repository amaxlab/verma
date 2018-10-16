<template>
    <div>
        <Loader ref="loader"></Loader>
        <TopNavigationBar></TopNavigationBar>
        <main role="main" class="container">
            <slot name="content"></slot>
        </main>
    </div>
</template>

<script>
    import TopNavigationBar from './TopNavigationBar';
    import Loader from './Loader';

    export default {
        components: {TopNavigationBar, Loader}
    }
</script>

<style>
    body {
        min-height: 75rem;
    }
    #app {
    }
</style>
