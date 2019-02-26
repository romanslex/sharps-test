export class Column {
    constructor(name) {
        this.name = name;
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
