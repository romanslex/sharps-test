<template lang="pug">
    table.table
        tr
            th(v-for="column in columns" :key="column.name" @click="sort(column)")
                | {{column.name}}
                i.fas.fa-sort-amount-up(v-show="column.sort && !column.sortDesc")
                i.fas.fa-sort-amount-down(v-show="column.sort && column.sortDesc")
        tr(v-for="row in data")
            td(v-for="column in columns") {{row[column.key]}}
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
        },
        created() {
            this.columns[0].sort = true;
        }
    }
</script>

<style scoped lang="stylus">
    i
        margin-left 10px
    th
        cursor pointer
</style>