<template lang="pug">
    form
        .form-group
            label Select a recipient
            v-select(:options="users" placeholder="Recipient" v-model.trim="$v.recipient.$model")
            .error(v-if="!$v.recipient.required && displayError"): small.text-danger Field is required
        .form-group
            label(for='exampleInputEmail1') Amount PW to send
            input#amount.form-control(type='text' placeholder='Amount' v-model.trim="$v.amount.$model")
            .error(v-if="!$v.amount.required && displayError"): small.text-danger Field is required
            .error(v-if="!$v.amount.integer && displayError"): small.text-danger Amount must be integer
            .error(v-if="!$v.amount.minValue && displayError"): small.text-danger
                | Amount must be equals {{$v.amount.$params.minValue.min}} at least.
            .error(v-if="!$v.amount.maxValue && displayError"): small.text-danger
                | You got only {{$v.amount.$params.maxValue.max}} PW.
        button.btn.btn-primary(type="button" @click="createTransaction") Submit
</template>

<script>
    import vSelect from 'vue-select'
    import { required, integer, minValue, maxValue } from 'vuelidate/lib/validators'

    export default {
        props: ['users', 'user'],
        components: {
            vSelect,
        },
        data() {
            return {
                recipient: null,
                amount: '',

                displayError: false
            }
        },
        validations() {
            return {
                recipient: {
                    required,
                },
                amount: {
                    required,
                    integer,
                    minValue: minValue(1),
                    maxValue: maxValue(this.user.balance)
                }
            }

        },
        methods: {
            createTransaction() {
                this.displayError = false;
                if(this.$v.$invalid){
                    this.displayError = true;
                    return false;
                }

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