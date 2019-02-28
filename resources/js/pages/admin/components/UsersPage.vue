<template lang="pug">
    .card
        .card-header Users page
        .card-body hi
</template>

<script>
    export default {
        created() {
            console.log(this.$store.state.users)
        }
    }
</script>