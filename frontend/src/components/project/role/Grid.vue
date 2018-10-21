<template>
    <div>
        <DeleteModal ref="deleteModal" @deleted="onAccessDeleted"></DeleteModal>
        <DataGrid ref="grid" :fields="fields" :items="project.users" :pagination-enabled="false">
            <template slot="actions" slot-scope="row">
                <b-button-group size="sm">
                    <b-button v-if="row.row.item.role !== 'owner'" variant="outline-danger" @click="deleteAccess(row.row.item)"><i class="fa fa-trash"></i></b-button>
                </b-button-group>
            </template>
        </DataGrid>
    </div>
</template>
<script>
    import DataGrid from "../../DataGrid";
    import DeleteModal from "./DeleteModal";
    export default {
        components: {DataGrid, DeleteModal},
        props: {
            project: Object,
        },
        data() {
            return {
                fields: [
                    {key: 'user.username', label: 'User'},
                    {key: 'role', label: 'Role'},
                    {key: 'createdAt', label: 'Created At'},
                    {key: 'actions', label: 'Actions'},
                ],
            }
        },
        methods: {
            deleteAccess(access) {
                this.$refs.deleteModal.show(access);
            },
            onAccessDeleted(accessId) {
                const id = this.project.users.findIndex(x => x.id === accessId);
                if (id >= 0) {
                    this.project.users.splice(id, 1);
                }
            },
        },
    }
</script>
