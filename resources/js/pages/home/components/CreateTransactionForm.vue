<template lang="pug">
    form
        .form-group
            label Select a recipient
            v-select(:options="users" placeholder="Recipient")
        .form-group
            label(for='exampleInputEmail1') Amount PW to send
            input#amount.form-control(type='text' placeholder='Amount')
        button.btn.btn-primary(type='submit') Submit
</template>

<script>
    import vSelect from 'vue-select'

    export default {
        props: ['users'],
        components: {
            vSelect,
        }
    }
</script>

<style scoped lang="stylus">
    form
        >>>.dropdown-toggle::after
            display none
</style>