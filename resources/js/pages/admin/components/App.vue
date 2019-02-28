<template lang="pug">
    #app
        nav.navbar.navbar-expand-md.navbar-light.navbar-laravel
            .container
                a.navbar-brand(href="/")
                    | Sharps
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
                            )
                                | Admin
                                span.caret
                            .dropdown-menu.dropdown-menu-right(aria-labelledby='navbarDropdown')
                                a.dropdown-item(style="cursor: pointer" @click="logout") Logout
        main.py-4
            .container
                .row.justify-content-center
                    .col-md-2
                        .card
                            .card-header Menu
                            .card-body
                                ul.nav.flex-column
                                    li.nav-item
                                        a.nav-link.active(href='#') Users
                                    li.nav-item
                                        a.nav-link(href='#') Transactions
                    .col-md-10
                        .card
                            .card-header Transactions
                            .card-body Hi


</template>

<script>
    export default {
        methods: {
            logout() {
                axios
                    .post('/logout')
                    .then(() => location.reload())
            }
        }
    }
</script>