<template>
    <b-container fluid>
        <!-- Main table element -->
        <b-table show-empty
                 striped hover
                 stacked="md"
                 :items="items"
                 :fields="fields"
                 :current-page="currentPage"
                 :per-page="perPage"
                 :sort-by.sync="sortBy"
                 :sort-desc.sync="sortDesc"
                 :sort-direction="sortDirection"
                 ref="grid"
        >
            <template slot="actions" slot-scope="row">
                <slot name="actions" :row="row">
                    <b-button-group size="sm">
                        <b-button variant="outline-primary" @click="viewClick(row.item)"><i class="fa fa-eye"></i></b-button>
                        <b-button variant="outline-primary" @click="editClick(row.item)"><i class="fa fa-pencil"></i></b-button>
                        <b-button variant="outline-danger" @click="editClick(row.item)"><i class="fa fa-trash"></i></b-button>
                    </b-button-group>
                </slot>
            </template>

            <template slot="enabled" slot-scope="row">
                <BtnEnabledDisabled v-model="row.item.enabled" @click="enabledClick(row.item)"></BtnEnabledDisabled>
            </template>

            <template slot="createdAt" slot-scope="row">
                {{moment(row.item.createdAt).fromNow()}}
            </template>

            <template slot="updatedAt" slot-scope="row">
                {{moment(row.item.updatedAt).fromNow()}}
            </template>

        </b-table>

        <b-row v-if="this.paginationEnabled">
            <b-col md="6">
                <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
            </b-col>
        </b-row>

    </b-container>
</template>

<script>
    import moment from 'moment';
    import BtnEnabledDisabled from "./BtnEnabledDisabled";

    export default {
        components: {BtnEnabledDisabled},
        props: {
            fields: Array,
            items: Array,
            paginationEnabled: {
                type: Boolean,
                default: false,
            },
            defaultSortBy: {
                type: String,
                default: 'id'
            },
            defaultSortDirection: {
                type: String,
                default: 'asc'
            },
            defaultSortDesc: {
                type: Boolean,
                default: false
            },
        },
        data () {
            return {
                currentPage: 1,
                perPage: 10,
                isBusy: false,
                totalRows: 0,
                pageOptions: [ 5, 10, 15 ],
                sortBy: this.defaultSortBy,
                sortDirection: this.defaultSortDirection,
                sortDesc: this.defaultSortDesc,
            }
        },
        methods: {
            moment,
            editClick(item) {
                this.$emit('editClick', item);
            },
            viewClick(item) {
                this.$emit('viewClick', item);
            },
            enabledClick(item) {
                this.$emit('enabledClick', item);
            },
            refresh() {
                this.$refs.grid.refresh();
            },
        }
    }
</script>