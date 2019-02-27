import moment from 'moment'

export class Column {
    constructor(name, key, type) {
        this.name = name;
        this.key = key;
        this.type = type || '';
        this.sort = false;
        this.sortDesc = false;
        this.initDefaultFilterValue();
    }

    initDefaultFilterValue(){
        switch (this.type) {
            case datetimeFilter:
                this.filterValue = [null, null];
                break;
            case stringFilter:
                this.filterValue = '';
                break;
        }
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
Column.prototype.sortData = function (data) {
    let result = data.slice();
    if (this.sortDesc)
        result.sort((a, b) => {
            a = a[this.key];
            b = b[this.key];
            if(typeof a === 'number')
                return b - a;
            if(typeof a === 'string')
                return b.localeCompare(a);
            return 0;
        });
    else
        result.sort((a, b) => {
            a = a[this.key];
            b = b[this.key];
            if(typeof a === 'number')
                return a - b;
            if(typeof a === 'string')
                return a.localeCompare(b);
            return 0;
        });
    return result;
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
            if(this.filterValue[0] === null)
                return data;
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
