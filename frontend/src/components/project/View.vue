<template>
    <div>
        <CreateEvironmentModal ref="createEnvironmentModal" :project-id="project['@id']" @created="onEnvironmentCreated"></CreateEvironmentModal>
        <h1><back-btn></back-btn>{{project.name}}</h1>
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
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2">Access</h1>
        </div>
        <table class="table">
            <tr>
                <th>User</th>
                <th>Role</th>
                <th>Created At</th>
            </tr>
            <tr v-for="access in project.users">
                <td><Gravatar :email="access.user.email" :size="40"/> {{access.user.username}}</td>
                <td>{{access.role}}</td>
                <td>{{moment(access.createdAt).fromNow()}}</td>
            </tr>
        </table>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2">Environments</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <button type="button" class="btn btn-success" @click="createEnvironment"><i class="fa fa-plus"></i> Add </button>
                </div>
            </div>
        </div>
        <table class="table">
            <tr>
                <th>Name</th>
                <th>Enabled</th>
                <th>Created At</th>
            </tr>
            <tr v-for="environment in project.environments">
                <td>{{environment.name}}</td>
                <td><BtnEnabledDisabled v-model="environment.enabled" @click="onEnvironmentEnabledClick(environment)"></BtnEnabledDisabled></td>
                <td>{{moment(environment.createdAt).fromNow()}}</td>
            </tr>
        </table>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2">Components</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Add </button>
                </div>
            </div>
        </div>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Enabled</th>
                <th>Created At</th>
            </tr>
            <tr v-for="component in project.components">
                <td>{{component.id}}</td>
                <td>{{component.name}}</td>
                <td>{{component.enabled}}</td>
                <td>{{moment(component.createdAt).fromNow()}}</td>
            </tr>
        </table>
    </div>
</template>

<script>
    import api from '@/api/';
    import Gravatar from 'vue-gravatar';
    import moment from 'moment';
    import BackBtn from '../BackBtn';
    import CreateEvironmentModal from "./environment/CreateModal";
    import BtnEnabledDisabled from "../BtnEnabledDisabled";

    export default {
        components: {
            BtnEnabledDisabled,
            CreateEvironmentModal,
            BackBtn, Gravatar
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
            moment,
            createEnvironment() {
                this.$refs.createEnvironmentModal.show();
            },
            onEnvironmentCreated(env) {
                this.project.environments.push(env);
            },
            onEnvironmentEnabledClick(environment) {
                api.environment.setEnabled(environment.id, environment.enabled).then(env => {
                    environment = env;
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>
