<template>
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
    ></DataGrid>
</template>
<script>
    import router from '@/router';
    import DataGrid from '../DataGrid';

    export default {
        components: {
            DataGrid
        },
        methods: {
            viewProject: item => {router.push({name: 'project_view', params: {id: item.id}})}
        }
    }
</script>
