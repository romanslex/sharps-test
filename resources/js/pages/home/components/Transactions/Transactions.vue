<template lang="pug">
    table.table
        tr
            th(v-for="column in columns" :key="column.name" @click="sort(column)")
                | {{column.name}}
                i.fas.fa-sort-amount-up(v-show="column.sort && !column.sortDesc")
                i.fas.fa-sort-amount-down(v-show="column.sort && column.sortDesc")
</template>

<script>
    import {Column} from './Column'

    export default {
        props: ['cols'],
        data() {
            return {
                columns: []
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
            }
        },
        created() {
            this.columns = this.cols.map(i => new Column(i));
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