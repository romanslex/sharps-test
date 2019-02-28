export const sortableFilterableTableMixin = {
    data() {
        return {
            rows: [],
            columns: [],
            currentSortColumn: null
        };
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
    created() {
        this.currentSortColumn = this.columns[0];
        this.currentSortColumn.sort = true;
        this.currentSortColumn.sortDesc = true;
        this.rows = this.data;
        this.sort(this.currentSortColumn);
    }
};