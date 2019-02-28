<template lang="pug">
    .card
        .card-header Edit user - {{user.name}}
        .card-body
            table.table
                tr
                    td Name
                    td {{user.name}}
                tr
                    td Email
                    td {{user.email}}
                tr
                    td Balance
                    td {{user.balance}} PW
            .from-group
                input(type="checkbox" v-model="user.is_banned" style="margin-right: 10px")
                | Banned
        .card-footer
            button.btn.btn-primary(@click="changeUser") Save changes
</template>

<script>
    export default {
        computed: {
            user() {
                return this.$store.getters.user(
                    this.$route.params.id
                )
            }
        },
        methods: {
            changeUser(){
                console.log(this.user)
            }
        }
    }
</script>