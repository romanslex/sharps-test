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
                                transactions(:columns="columns" :data="data")

</template>

<script>
    import Transactions from './Transactions/Transactions.vue'
    import {Column} from "./Transactions/Column";

    export default {
        components: {
            Transactions,
        },
        data() {
            return {
                columns: [
                    new Column('DateTime', 'performed_at'),
                    new Column('Correspondent Name', 'name', Column.columnTypeString),
                    new Column('Amount', 'amount', Column.columnTypeString),
                    new Column('Balance', 'balance'),
                ],
                data: [
                    {
                        'performed_at': new Date(),
                        'name': "Vasia",
                        'amount': 1400,
                        'balance': 2000
                    },{
                        'performed_at': new Date(),
                        'name': "Alex",
                        'amount': 400,
                        'balance': 12
                    },{
                        'performed_at': new Date(),
                        'name': "Boris",
                        'amount': 10,
                        'balance': 2500
                    },
                ]
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
