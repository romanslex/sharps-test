require('../../bootstrap');
import Vue from 'vue'
import App from './components/App.vue'
import Vuelidate from 'vuelidate'

Vue.use(Vuelidate);
import store from './store';

const app = new Vue({
    store,
    render: h => h(App),
    created() {
        this.$store.dispatch("initState");
    }
}).$mount('#app');
