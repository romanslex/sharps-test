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
        },
        createTransaction(state, payload){
            let transactions = state.transactions.slice();
            transactions.push(payload);
            state.transactions = transactions;
        },
        setUserBalance(state, balance){
            state.user.balance = balance;
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
        },
        createTransaction({commit}, transaction){
            return new Promise((resolve, reject) => {
                axios
                    .post('/data/transactions', transaction)
                    .then(response => {
                        commit('createTransaction', response.data);
                        commit('setUserBalance', response.data.balance);
                        console.log(response.data)
                    })
                    .catch(error => reject(error));
            });
        }
    }
});

export default store;