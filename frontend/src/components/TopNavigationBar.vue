<template>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <span class="navbar-brand">VERMAN</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li v-for="item in navigation" v-bind:class="[item.name === currentRouteName ? 'active' : '']">
                    <router-link class="nav-link" :to="{name: item.name}">{{item.title}}</router-link>
                </li>
            </ul>
            <form class="form-inline mt-2 mt-md-0">
                <button class="btn btn-outline-success my-2 my-sm-0" @click="logout()">Logout</button>
            </form>
        </div>
    </nav>
</template>

<script>
    import store from '../store';

    export default {
        data() {
            return {
                currentRouteName: this.$router.currentRoute.name,
                navigation: [
                    {
                        name: 'dashboard',
                        title: 'Dashboard'
                    },
                    {
                        name: 'projects',
                        title: 'Projects',
                        roles: ['ROLE_PROJECT_MANAGER']
                    },
                    {
                        name: 'users',
                        title: 'Users',
                        roles: ['ROLE_USER_MANAGER']
                    }
                ]
            }
        },
        methods: {
            logout() {
                store.dispatch('session/logout');
            }
        }
    }
</script>
