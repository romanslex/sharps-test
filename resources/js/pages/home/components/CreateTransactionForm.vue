<template lang="pug">
    form
        .form-group
            label Select a recipient
            v-select(:options="users" placeholder="Recipient" v-model="recipient")
        .form-group
            label(for='exampleInputEmail1') Amount PW to send
            input#amount.form-control(type='text' placeholder='Amount' v-model="amount")
        button.btn.btn-primary(type="button" @click="createTransaction") Submit
</template>

<script>
    import vSelect from 'vue-select'

    export default {
        props: ['users'],
        components: {
            vSelect,
        },
        data() {
            return {
                recipient: null,
                amount: ''
            }
        },
        methods: {
            createTransaction() {
                axios
                    .post('/data/transactions', {
                        recipient: this.recipient.value,
                        amount: this.amount
                    })
                    .then(response => console.log(response))
                    .catch(error => console.log(error));
            }
        }
    }
</script>

<style scoped lang="stylus">
    form
        >>>.dropdown-toggle::after
            display none
</style>