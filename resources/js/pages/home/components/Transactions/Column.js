import moment from 'moment'

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
        case datetimeFilter:
            return data.filter(i => {
                let columnDate = moment(i[this.key]).format('DD.MM.YYYY');
                let startDate = moment(this.filterValue[0]).format('DD.MM.YYYY');
                let endDate = moment(this.filterValue[1]).format('DD.MM.YYYY');

                return columnDate === startDate
                    || columnDate === endDate
                    || (columnDate > startDate && columnDate < endDate);
            });
        default:
            return data;
    }
};

const stringFilter = 'string';
const datetimeFilter = 'datetime';
