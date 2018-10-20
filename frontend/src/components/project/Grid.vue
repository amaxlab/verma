<template>
    <div>
        <DeleteModal ref="deleteProjectModal" @projectDeleted="refreshGrid"></DeleteModal>
        <EditModal ref="editProjectModal" @projectDeleted="refreshGrid"></EditModal>
        <DataGrid
                :fields="[
                {key:'id', label: 'ID', sortable: true},
                {key:'name', label: 'Name', sortable: true},
                {key:'enabled', label: 'Enabled', sortable: true},
                {key:'updatedAt', label: 'Updated At', sortable: true},
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
    import EditModal from "./EditModal";

    export default {
        components: {
            EditModal,
            DataGrid, DeleteModal
        },
        methods: {
            refreshGrid() {
                this.$refs.grid.refresh();
            },
            editProject(item) {
                this.$refs.editProjectModal.show(item);
            },
            deleteProject(item) {
                this.$refs.deleteProjectModal.show(item.id, item.name);
            },
            viewProject(item){
                router.push({name: 'project_view', params: {id: item.id.toString()}})
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
