require('../../bootstrap');
import Vue from 'vue'
import App from './components/App.vue'

let transactions = JSON.parse(document.getElementById('app').dataset['transactions']);
console.log(transactions);
const app = new Vue({
    render: h => h(App, {props: {transactions}})
}).$mount('#app');
