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
            th.header(v-for="column in columns" :key="column.name" @click="onSortClick(column)")
                | {{column.name}}
                i.fas.fa-sort-amount-up(v-show="column.sort && !column.sortDesc")
                i.fas.fa-sort-amount-down(v-show="column.sort && column.sortDesc")
            th
        tr(v-for="(row, i) in rows" :key="i")
            td {{row.performed_at.format('DD.MM.YYYY HH:mm')}}
            td {{row.name}}
            td
                i.far.fa-arrow-alt-circle-down.text-danger(style="margin-right:5px" v-if="row.is_outbound")
                i.far.fa-arrow-alt-circle-up.text-success(style="margin-right:5px" v-else)
                | {{row.amount}}
            td {{row.balance}}
            td
                i.far.fa-copy.copy-transaction(v-if="row.is_outbound" @click="copy(row)")

</template>

<script>
    import DatePicker from 'vue2-datepicker'
    import {EventBus} from '../../../../event-bus'

    export default {
        components: {
            DatePicker,
        },
        props: ['columns'],
        data() {
            return {
                rows: [],
                currentSortColumn: null
            }
        },
        computed: {
            data() {
                return this.$store.state.transactions
            }
        },
        watch: {
            data(){
                this.onFilterChange();
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
            copy(row) {
                EventBus.$emit('copy-transaction', {
                    name: row.name,
                    id: row.recipient_id,
                    amount: row.amount
                });
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
    i
        margin-left 10px

    .header
        cursor pointer

    .table
        >>> svg
            display none
        >>> .mx-datepicker-range
            width 210px

    .copy-transaction
        cursor pointer
</style>