export class Column {
    constructor(name, key, type) {
        this.name = name;
        this.key = key;
        this.type = type;
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

const stringFilter = 'string';
const datetimeFilter = 'datetime';
