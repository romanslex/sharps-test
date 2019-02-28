<template lang="pug">
    .card
        .card-header Edit user - {{user.name}}
        .card-body
            .error-block.alert.alert-danger(v-show="showErrorBlock")
                .error-item During saving error has been occurred
            .succes-block.alert.alert-success(v-show="showSuccessBlock")
                .success-item Changes successfully saved
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
            button.btn.btn-primary(@click="changeUser" :disabled="isBtnLocked") Save changes
</template>

<script>
    export default {
        data() {
            return {
                showErrorBlock: false,
                showSuccessBlock: false,
                isBtnLocked: false,
                user: {}
            }
        },
        methods: {
            changeUser() {
                this.showErrorBlock = false;
                this.showSuccessBlock = false;
                this.isBtnLocked = true;

                this.$store
                    .dispatch("changeUser", this.user)
                    .then(() => {
                        this.showSuccessBlock = true;
                        this.isBtnLocked = false;
                    })
                    .catch(error => {
                        this.showErrorBlock = true;
                        this.isBtnLocked = false;
                    })
            }
        },
        created() {
            this.user = Object.assign({}, this.$store.getters.user(
                this.$route.params.id
            ))
        }
    }
</script>