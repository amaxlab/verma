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
    ></DataGrid>
</template>
<script>
    import DataGrid from '../DataGrid';

    export default {
        components: {
            DataGrid
        }
    }
</script>
