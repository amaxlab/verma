<template>
    <Page>
        <template slot="content">
            <h1>Users</h1>
            <ListDataGrid
                    :fields="[
                    {key:'id', label: 'ID'},
                    {key:'username', label: 'Username'},
                    {key:'email', label: 'Email'},
                    {key:'enabled', label: 'Enabled'},
                    {key:'createdAt', label: 'Created At'}
                ]"
                    ref="grid"
                    url="/api/users"
                    defaultSortBy="username"
                    :defaultSortDesc="true"
                    @viewClick="viewUser"
            ></ListDataGrid>
        </template>
    </Page>
</template>
<script>
    import Page from '../components/Page';
    import ListDataGrid from '../components/ListDataGrid';

    export default {
        components: {
            Page, ListDataGrid
        },
        methods: {
            viewUser(item) {
                this.$router.push({name: 'user_view', params: { id: item.id }})
            }
        }
    }
</script>
