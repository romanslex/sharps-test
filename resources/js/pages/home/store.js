import Vue from "vue"
import Vuex from "vuex";
import moment from 'moment';

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
        createTransaction(state, payload) {
            let transactions = state.transactions.slice();
            transactions.push(payload);
            state.transactions = transactions;
        },
        setUserBalance(state, balance) {
            state.user.balance = balance;
        }
    },
    actions: {
        initState({commit}) {
            let transactions = JSON.parse(document.getElementById('app').dataset['transactions']);
            let user = JSON.parse(document.getElementById('app').dataset['user']);
            let users = JSON.parse(document.getElementById('app').dataset['users']);

            transactions = transactions.map(i => {
                i.performed_at = moment(i.performed_at);
                return i;
            });

            commit('initState', {
                transactions,
                users,
                user
            })
        },
        createTransaction({commit}, payload) {
            return new Promise((resolve, reject) => {
                axios
                    .post('/data/transactions', payload)
                    .then(response => {
                        let transaction = response.data;
                        commit('createTransaction', {
                            amount: transaction.amount,
                            balance: transaction.balance,
                            is_outbound: transaction.is_outbound,
                            name: transaction.name,
                            performed_at: moment(transaction.performed_at)
                        });
                        commit('setUserBalance', response.data.balance);
                    })
                    .catch(error => reject(error));
            });
        }
    }
});

export default store;