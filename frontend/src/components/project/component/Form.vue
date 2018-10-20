<template>
    <b-form>
        <b-form-group label="Name" label-for="name">
            <b-form-input id="name" type="text" v-model="component.name" required placeholder="Enter component name"></b-form-input>
        </b-form-group>
        <b-form-group label="Enabled" label-for="enabled">
            <SelectYesNo v-model="component.enabled"></SelectYesNo>
        </b-form-group>
    </b-form>
</template>

<script>
    import SelectYesNo from "../../SelectYesNo";
    export default {
        components: {SelectYesNo},
        props: {
            value: Object
        },
        data() {
            return {
                component: this.value
            };
        },
        methods: {
            setData(data) {
                this.component = data;
            }
        }
    }
</script>
