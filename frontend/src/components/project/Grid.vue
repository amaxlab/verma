<template>
    <div>
        <DeleteModal ref="deleteProjectModal" @projectDeleted="refreshGrid"></DeleteModal>
        <DataGrid
                :fields="[
                {key:'id', label: 'ID'},
                {key:'name', label: 'Name'},
                {key:'enabled', label: 'Enabled'},
                {key:'updatedAt', label: 'Updated At'},
                {key:'actions', label: 'Actions'}
            ]"
                ref="grid"
                url="/api/projects"
                defaultSortBy="name"
                :defaultSortDesc="true"
                @viewClick="viewProject"
                @enabledClick="enabledProject"
        >
            <template slot="actions" slot-scope="row">
                <b-button-group size="sm">
                    <b-button variant="outline-primary" @click="viewProject(row.row.item)"><i class="fa fa-eye"></i></b-button>
                    <b-button variant="outline-primary" @click="editProject(row.row.item)"><i class="fa fa-pencil"></i></b-button>
                    <b-button variant="outline-danger" @click="deleteProject(row.row.item)" v-if="row.row.item.enabled === false"><i class="fa fa-trash"></i></b-button>
                </b-button-group>
            </template>
        </DataGrid>
    </div>
</template>
<script>
    import api from '@/api/';
    import router from '@/router';
    import DataGrid from '../DataGrid';
    import DeleteModal from './DeleteModal';

    export default {
        components: {
            DataGrid, DeleteModal
        },
        methods: {
            editProject() {

            },
            refreshGrid() {
                this.$refs.grid.refresh();
            },
            deleteProject(item) {
                this.$refs.deleteProjectModal.show(item.id, item.name);
            },
            viewProject(item){
                router.push({name: 'project_view', params: {id: item.id}})
            },
            enabledProject(item) {
                api.project.setEnabled(item.id, !item.enabled).then(project => {
                    item.enabled = project.enabled;
                    item.updatedAt = project.updatedAt;
                }).catch(error => {
                    console.log(error)
                });
            }
        }
    }
</script>
