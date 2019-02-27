<template lang="pug">
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
            th.header(v-for="column in columns" :key="column.name" @click="sort(column)")
                | {{column.name}}
                i.fas.fa-sort-amount-up(v-show="column.sort && !column.sortDesc")
                i.fas.fa-sort-amount-down(v-show="column.sort && column.sortDesc")
        tr(v-for="(row, i) in rows" :key="i")
            td(v-for="column in columns" :key="column.key") {{row[column.key]}}
</template>

<script>
    import DatePicker from 'vue2-datepicker'

    export default {
        components: {
            DatePicker,
        },
        props: ['columns', 'data'],
        data() {
            return {
                rows: []
            }
        },
        methods: {
            sort(column) {
                if (column.sort) {
                    column.changeSortDirection();
                } else {
                    this.columns.map(i => i.unsort());
                    column.sort = true;
                }
                this.rows = column.sortData(this.rows);
            },
            onFilterChange() {
                let data = this.data;
                this.columns.map(i => data = i.filter(data));
                this.rows = data;
            }
        },
        created() {
            this.columns[0].sort = true;
            this.rows = this.data;
            this.sort(this.columns[0]);
        }
    }
</script>

<style scoped lang="stylus">
    i
        margin-left 10px

    .header
        cursor pointer

    .table
        >>> svg
            display none
</style>