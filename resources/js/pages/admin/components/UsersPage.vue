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
                    th
                tr(v-for="user in rows" :key="user.id")
                    td {{user.id}}
                    td {{user.name}}
                    td {{user.email}}
                    td {{user.balance}}

</template>

<script>
    import {Column} from "../../shared/Column";

    export default {
        data() {
            return {
                columns: [
                    new Column('#', 'id', Column.stringFilter),
                    new Column('Name', 'name', Column.stringFilter),
                    new Column('Email', 'email', Column.stringFilter),
                    new Column('Balance', 'balance', Column.stringFilter),
                ],
                rows: []
            }
        },
        methods: {
            onSortClick(column) {
                if (column.sort)
                    column.changeSortDirection();
                this.sort(column);
            },
            sort(column) {
                this.columns.map(i => i.unsort());
                column.sort = true;
                this.currentSortColumn = column;
                this.rows = column.sortData(this.rows);
            },
            onFilterChange() {
                let data = this.data;
                this.columns.map(i => data = i.filter(data));
                this.rows = data;
                this.sort(this.currentSortColumn);
            },
        },
        computed: {
            data() {
                return this.$store.state.users;
            }
        },
        created() {
            this.currentSortColumn = this.columns[0];
            this.currentSortColumn.sort = true;
            this.currentSortColumn.sortDesc = true;
            this.rows = this.data;
            this.sort(this.currentSortColumn);
        }
    }
</script>

<style scoped lang="stylus">
    .table i
        margin-left 10px
</style>