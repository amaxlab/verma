<template>
    <div>
        <CreateEnvironmentModal ref="createEnvironmentModal" :project-id="this.project['@id']" @created="onEnvironmentCreated"></CreateEnvironmentModal>
        <EditEnvironmentModal ref="updateEnvironmentModal" @updated="onEnvironmentUpdate"></EditEnvironmentModal>
        <DeleteEnvironmentModal ref="deleteEnvironmentModal" @deleted="onEnvironmentDelete"></DeleteEnvironmentModal>
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
                <th>Actions</th>
            </tr>
            <tr v-for="environment in project.environments">
                <td>{{environment.name}}</td>
                <td><BtnEnabledDisabled v-model="environment.enabled" @click="onEnvironmentEnabledClick(environment)"></BtnEnabledDisabled></td>
                <td>{{moment(environment.createdAt).fromNow()}}</td>
                <td>
                    <b-button-group size="sm">
                        <b-button variant="outline-primary" @click="updateEnvironment(environment)"><i class="fa fa-pencil"></i></b-button>
                        <b-button v-if="environment.enabled === false" variant="outline-danger" @click="deleteEnvironment(environment)"><i class="fa fa-trash"></i></b-button>
                    </b-button-group>
                </td>
            </tr>
        </table>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2">Components</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <button type="button" class="btn btn-success" @click="createComponent"><i class="fa fa-plus"></i> Add </button>
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
    import CreateEnvironmentModal from "./environment/CreateModal";
    import EditEnvironmentModal from "./environment/EditModal";
    import DeleteEnvironmentModal from "./environment/DeleteModal";
    import BtnEnabledDisabled from "../BtnEnabledDisabled";

    export default {
        components: {
            CreateEnvironmentModal, EditEnvironmentModal, DeleteEnvironmentModal,
            BtnEnabledDisabled,
            BackBtn, Gravatar
        },
        props: {
            projectId: String,
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
            updateEnvironment(environment) {
                this.$refs.updateEnvironmentModal.show(environment);
            },
            deleteEnvironment(environment) {
                this.$refs.deleteEnvironmentModal.show(environment);
            },
            onEnvironmentCreated(env) {
                this.project.environments.push(env);
            },
            onEnvironmentUpdate(env) {
                const id = this.project.environments.findIndex(x => x.id === env.id);
                if (id >= 0) {
                    this.project.environments[id] = env;
                }
            },
            onEnvironmentDelete(environmentId) {
                const id = this.project.environments.findIndex(x => x.id === environmentId);
                if (id >= 0) {
                    this.project.environments.splice(id, 1);
                }
            },
            onEnvironmentEnabledClick(environment) {
                api.environment.setEnabled(environment.id, environment.enabled).then(env => {
                    environment = env;
                }).catch(error => {
                    console.log(error);
                });
            },
            createComponent() {
                this.project.environments[1].enabled = false;
            },

        }
    }
</script>
