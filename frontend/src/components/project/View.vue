<template>
    <table>
        <tr>
            <td>Name:</td>
            <td>{{project.name}}</td>
        </tr>
        <tr>
            <td>Enabled:</td>
            <td>{{project.enabled}}</td>
        </tr>
    </table>
</template>

<script>
    import api from '@/api/';

    export default {
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
        }
    }
</script>
