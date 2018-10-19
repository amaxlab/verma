<template>
    <b-form>
        <b-form-group label="Name" label-for="name">
            <b-form-input id="name" type="text" v-model="environment.name" required placeholder="Enter project name"></b-form-input>
        </b-form-group>
        <b-form-group label="Enabled" label-for="enabled">
            <SelectYesNo v-model="environment.enabled"></SelectYesNo>
        </b-form-group>
    </b-form>
</template>

<script>
    import SelectYesNo from "../../SelectYesNo";
    export default {
        components: {SelectYesNo},
        data() {
            return {
                environment: {enabled: true},
                yesNo: [
                    {text: 'yes', value: true},
                    {text: 'no', value: false}
                ]
            };
        },
        methods: {
            getData() {
                return this.environment;
            },
            setData(data) {
                this.environment = data;
            }
        }
    }
</script>
