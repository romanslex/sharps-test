export class Column {
    constructor(name, key, type) {
        this.name = name;
        this.key = key;
        this.type = type || '';
        this.filterValue = '';
        this.sort = false;
        this.sortDesc = false;
    }

    static get stringFilter() {
        return stringFilter;
    }

    static get datetimeFilter() {
        return datetimeFilter;
    }
}

Column.prototype.unsort = function () {
    this.sort = false;
};
Column.prototype.changeSortDirection = function () {
    this.sortDesc = !this.sortDesc;
};
Column.prototype.filter = function (data) {
    switch (this.type) {
        case stringFilter:
            return data
                .filter(i => i[this.key]
                    .toString()
                    .toUpperCase()
                    .match(this.filterValue.toUpperCase()));
        default:
            return data;
    }
};

const stringFilter = 'string';
const datetimeFilter = 'datetime';
