import Vue from "vue"
import Vuex from "vuex";

Vue.use(Vuex);

const store = new Vuex.Store({
    strict: true,
    state: {
        users: [],
    },
    mutations: {
        initState(state, payload) {
            state.users = payload;
        }
    },
    actions: {
        initState({commit}) {
            let users = JSON.parse(document.getElementById('app').dataset['users']);
            commit('initState', users);
        },
        changeUser({commit}, user) {
            return new Promise((resolve, reject) => {
                axios
                    .put('/data/users/' + user.id, {is_banned: user.is_banned})
                    .then(response => {
                        commit('changeUser', response.data);
                        resolve();
                    })
                    .catch(error => reject(error));
            })
        }
    },
    getters: {
        user: state => id => state.users.find(i => i.id === parseInt(id))
    }
});

export default store;