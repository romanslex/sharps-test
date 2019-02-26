export class Column {
    constructor(name, key) {
        this.name = name;
        this.key = key;
        this.sort = false;
        this.sortDesc = false;
    }
}

Column.prototype.unsort = function () {
    this.sort = false;
};
Column.prototype.changeSortDirection = function () {
    this.sortDesc = !this.sortDesc;
};
