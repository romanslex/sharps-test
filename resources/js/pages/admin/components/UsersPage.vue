<template lang="pug">
    .card
        .card-header Users page
        .card-body
            table.table
                tr
                    th(v-for="column in columns" :key="column.key")
                        input.form-control(
                        type="search"
                        v-if="column.type === 'string'"
                        v-model="column.filterValue"
                        @input="onFilterChange()"
                        placeholder="Filter"
                        )
                        date-picker(
                        input-class='form-control'
                        v-if="column.type === 'datetime'"
                        v-model="column.filterValue"
                        lang="en"
                        range
                        @change="onFilterChange()"
                        )
                tr
                    th.header(v-for="column in columns" :key="column.name" @click="onSortClick(column)")
                        | {{column.name}}
                        i.fas.fa-sort-amount-up(v-show="column.sort && !column.sortDesc")
                        i.fas.fa-sort-amount-down(v-show="column.sort && column.sortDesc")
                    th Banned
                tr(v-for="user in rows" :key="user.id")
                    td {{user.id}}
                    td: router-link(:to="'/admin/users/' + user.id") {{user.name}}
                    td {{user.email}}
                    td {{user.balance}}
                    td
                        i.fas.fa-ban.text-danger(v-if="user.is_banned" data-toggle="popover" title="User has been banned")

</template>

<script>
    import {Column} from "../../shared/Column";
    import {sortableFilterableTableMixin} from "../../shared/sortable-filterable-table";

    export default {
        mixins: [sortableFilterableTableMixin],
        data() {
            return {
                columns: [
                    new Column('#', 'id', Column.stringFilter),
                    new Column('Name', 'name', Column.stringFilter),
                    new Column('Email', 'email', Column.stringFilter),
                    new Column('Balance', 'balance', Column.stringFilter),
                ],
            }
        },
        methods: {

        },
        computed: {
            data() {
                return this.$store.state.users;
            }
        },
        created() {
            this.currentSortColumn.sortDesc = false;
            this.sort(this.currentSortColumn);
        }
    }
</script>

<style scoped lang="stylus">
    .table i
        margin-left 10px
</style>