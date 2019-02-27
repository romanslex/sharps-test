require('../../bootstrap');
import Vue from 'vue'
import App from './components/App.vue'
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate);

let transactions = JSON.parse(document.getElementById('app').dataset['transactions']);
let user = JSON.parse(document.getElementById('app').dataset['user']);
let users = JSON.parse(document.getElementById('app').dataset['users']);

const app = new Vue({
    render: h => h(App, {
        props: {
            transactions,
            user,
            users
        }})
}).$mount('#app');
