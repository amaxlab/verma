<template>
    <b-container fluid>
        <!-- Main table element -->
        <b-table show-empty
                 striped hover
                 stacked="md"
                 :items="items"
                 :fields="fields"
                 :busy.sync="isBusy"
                 :current-page="currentPage"
                 :per-page="perPage"
                 :filter="filter"
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
                    </b-button-group>
                </slot>
            </template>

            <template slot="enabled" slot-scope="row">
                <b-badge :variant="row.item.enabled ? 'success' : 'warning'">{{row.item.enabled ? 'YES' : 'NO'}}</b-badge>
            </template>

            <template slot="createdAt" slot-scope="row">
                {{moment(row.item.createdAt).fromNow()}}
            </template>

            <template slot="updatedAt" slot-scope="row">
                {{moment(row.item.updatedAt).fromNow()}}
            </template>

        </b-table>

        <b-row>
            <b-col md="6">
                <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
            </b-col>
        </b-row>

    </b-container>
</template>

<script>
    import Axios from 'axios';
    import moment from 'moment';
    import store from '../store';

    export default {
        name: 'b-grid',
        props: {
            fields: Array,
            url: String,
            viewLinkPattern: String,
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
            // this.loadData();
            return {
                items: this.loadData,
                currentPage: 1,
                perPage: 10,
                isBusy: false,
                totalRows: 0,
                pageOptions: [ 5, 10, 15 ],
                filter: null,
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
            refresh() {
                this.$refs.grid.refresh();
            },
            loadData(ctx) {
                this.isBusy = true;
                store.commit('loader/show');
                const params = {};
                params.page = ctx.currentPage;
                params.perPage = ctx.perPage;

                if(ctx.sortBy != null) {
                    params['order[' + ctx.sortBy + ']'] = ctx.sortDesc ? 'desc' : 'asc';
                }

                const promise = Axios.get('http://127.0.0.1:8000'+this.url, {
                    headers: {
                        Accept: 'application/ld+json',
                        Authorization: 'bearer '+store.state.session.accessToken
                    },
                    params: params
                });

                return promise.then(r => {
                    this.isBusy = false;
                    this.totalRows = r.data['hydra:totalItems'];
                    store.commit('loader/hide');

                    return r.data['hydra:member'];
                }).catch(e => {
                    this.totalRows = 0;
                    this.isBusy = false;
                    store.commit('loader/hide');
                    return [];
                });
            }
        }
    }
</script>