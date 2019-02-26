<template lang="pug">
    table.table
        tr
            th(v-for="column in columns" :key="column.key")
                input.form-control(
                    type="search"
                    v-if="column.type === 'string'"
                    v-model="column.filterModel"
                    @input="filterInput(column)"
                    placeholder="Filter"
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
    export default {
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
                    return;
                }
                this.columns.map(i => i.unsort());
                column.sort = true;
            },
            filterInput(column) {
                this.rows = this.data
                    .filter(i => i[column.key]
                        .toString()
                        .toUpperCase()
                        .match(column.filterModel.toUpperCase()))
            }
        },
        created() {
            this.columns[0].sort = true;
            this.rows = this.data;
        }
    }
</script>

<style scoped lang="stylus">
    i
        margin-left 10px
    .header
        cursor pointer
</style>