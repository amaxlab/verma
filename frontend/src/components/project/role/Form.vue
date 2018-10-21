<template>
    <b-form>
        <b-form-group label="User" label-for="user">
            <SelectUser v-model="value.user"></SelectUser>
        </b-form-group>
        <b-form-group label="Role" label-for="role">
            <SelectRole v-model="value.role" id="role"></SelectRole>
        </b-form-group>
    </b-form>
</template>

<script>
    import SelectRole from "../../SelectRole";
    import SelectUser from "../../SelectUser";
    export default {
        components: {SelectUser, SelectRole},
        props: {
            value: Object
        },
    }
</script>
