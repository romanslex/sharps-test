require('../../bootstrap');
import Vue from 'vue'
import App from './components/App.vue'
import router from './router'
import store from './store'

const app = new Vue({
    store,
    router,
    render: h => h(App),
}).$mount('#app');
