<template lang="pug">
    #app
        nav.navbar.navbar-expand-md.navbar-light.navbar-laravel
            .container
                a.navbar-brand(href="/")
                    | Laravel
                button.navbar-toggler(
                    type='button'
                    data-toggle='collapse'
                    data-target='#navbarSupportedContent'
                    aria-controls='navbarSupportedContent'
                    aria-expanded='false'
                    aria-label="Toggle navigation"
                )
                    span.navbar-toggler-icon
                #navbarSupportedContent.collapse.navbar-collapse
                    ul.navbar-nav.mr-auto
                    ul.navbar-nav.ml-auto
                        li.nav-item.dropdown
                            a#navbarDropdown.nav-link.dropdown-toggle(
                                href='#' role='button'
                                data-toggle='dropdown'
                                aria-haspopup='true'
                                aria-expanded='false'
                                v-pre=''
                            ) Roman
                                span.caret
                            .dropdown-menu.dropdown-menu-right(aria-labelledby='navbarDropdown')
                                a.dropdown-item(style="cursor: pointer" @click="logout") Logout
        main.py-4
            .container
                .row.justify-content-center
                    .col-md-8
                        .card
                            .card-header Dashboard
                            .card-body
                                transactions(:columns="columns" :data="transactions")
                    .col-md-4
                        .card
                            .card-header Create transaction
                            .card-body
                                create-transaction-form(:users="users")

</template>

<script>
    import Transactions from './Transactions/Transactions.vue';
    import {Column} from "./Transactions/Column";
    import CreateTransactionForm from './CreateTransactionForm.vue';

    export default {
        props: ['transactions', 'user'],
        components: {
            Transactions,
            CreateTransactionForm,
        },
        data() {
            return {
                columns: [
                    new Column('DateTime', 'performed_at', Column.datetimeFilter),
                    new Column('Correspondent Name', 'name', Column.stringFilter),
                    new Column('Amount', 'amount', Column.stringFilter),
                    new Column('Balance', 'balance'),
                ],
                users: [
                    {label: 'Maximilian O\'Keefe', value: 1},
                    {label: 'Cristian Jenkins', value: 2},
                    {label: 'Blake Rosenbaum', value: 3},
                ],
            }
        },
        methods: {
            logout() {
                axios
                    .post('/logout')
                    .then(() => location.reload())
            }
        }
    }
</script>
