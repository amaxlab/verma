<template>
    <b-form>
        <b-form-group label="Name" label-for="name">
            <b-form-input id="name" type="text" v-model="project.name" required placeholder="Enter project name"></b-form-input>
        </b-form-group>
        <b-form-group label="Enabled" label-for="enabled">
            <b-form-select id="enabled" :options="yesNo" required v-model="project.enabled"></b-form-select>
        </b-form-group>
    </b-form>
</template>

<script>
    export default {
        data() {
            return {
                project: {enabled: true},
                yesNo: [
                    {text: 'yes', value: true},
                    {text: 'no', value: false}
                ]
            };
        },
        methods: {
            getData() {
                return this.project;
            },
            setData(data) {
                this.project = data;
            }
        }
    }
</script>
