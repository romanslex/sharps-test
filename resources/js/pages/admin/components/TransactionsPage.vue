<template lang="pug">
    .card
        .card-header Transactions page
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
                tr(v-for="transaction in data" :key="transaction.id")
                    td {{transaction.payer}}
                    td {{transaction.recipient}}
                    td {{transaction.amount}}
                    td {{transaction.performed_at}}


</template>

<script>
    import {Column} from "../../shared/Column";
    import DatePicker from 'vue2-datepicker';

    export default {
        components: {
            DatePicker,
        },
        data() {
            return {
                columns: [
                    new Column('Payer Name', 'payer', Column.stringFilter),
                    new Column('Recipient Name', 'recipient', Column.stringFilter),
                    new Column('Amount, PW', 'amount', Column.stringFilter),
                    new Column('Performed At', 'performed_at', Column.datetimeFilter)
                ]
            }
        },
        computed: {
            data() {
                return this.$store.state.transactions;
            }
        },
    }
</script>

<style lang="stylus" scoped>
    .table
        >>> svg
            display none

        >>> .mx-datepicker-range
            width 210px
</style>