<template>
    <div>
        <h1><back-btn></back-btn>Project {{project.name}}</h1>
        <table class="table table-borderless">
            <tr>
                <td>Enabled:</td>
                <td>{{project.enabled}}</td>
            </tr>
            <tr>
                <td>Created At:</td>
                <td>{{moment(project.createdAt).fromNow()}}</td>
            </tr>
            <tr>
                <td>Updated At:</td>
                <td>{{moment(project.updatedAt).fromNow()}}</td>
            </tr>

        </table>
        <h2>Access</h2>
        <table class="table">
            <tr>
                <th>User</th>
                <th>Role</th>
                <th>Created At</th>
            </tr>
            <tr v-for="access in project.users">
                <td>{{access.user.username}}</td>
                <td>{{access.role}}</td>
                <td>{{moment(access.createdAt).fromNow()}}</td>
            </tr>
        </table>
        <h2>Environments</h2>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Enabled</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            <tr v-for="environment in project.environments">
                <td>{{environment.id}}</td>
                <td>{{environment.name}}</td>
                <td>{{environment.enabled}}</td>
                <td>{{moment(environment.createdAt).fromNow()}}</td>
                <td>{{moment(environment.updatedAt).fromNow()}}</td>
            </tr>
        </table>
        <h2>Components</h2>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Enabled</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            <tr v-for="component in project.components">
                <td>{{component.id}}</td>
                <td>{{component.name}}</td>
                <td>{{component.enabled}}</td>
                <td>{{moment(component.createdAt).fromNow()}}</td>
                <td>{{moment(component.updatedAt).fromNow()}}</td>
            </tr>
        </table>
    </div>
</template>

<script>
    import api from '@/api/';
    import moment from 'moment';
    import BackBtn from '../BackBtn';

    export default {
        components: {
            BackBtn
        },
        props: {
            projectId: Number,
        },
        data() {
            return {
                project: {}
            }
        },
        mounted() {
            api.project.get(this.projectId).then(project => {
                this.project = project;
            }).catch(error => {
                console.log(error);
            });
        },
        methods: {
            moment
        }
    }
</script>
