import Vue from "vue"
import Vuex from "vuex";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        transactions: [],
        users: [],
        user: {}
    },
    mutations: {
        initState(state, payload) {
            state.transactions = payload.transactions;
            state.users = payload.users;
            state.user = payload.user;
        }
    },
    actions: {
        initState({commit}) {
            let transactions = JSON.parse(document.getElementById('app').dataset['transactions']);
            let user = JSON.parse(document.getElementById('app').dataset['user']);
            let users = JSON.parse(document.getElementById('app').dataset['users']);

            commit('initState', {
                transactions,
                users,
                user
            })
        }
    }
});

export default store;