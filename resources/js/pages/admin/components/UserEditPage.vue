<template lang="pug">
    .card
        .card-header Edit user - {{user.name}}
        .card-body
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
    }
</script>