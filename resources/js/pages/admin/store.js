import Vue from "vue"
import Vuex from "vuex";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        users: [],
    },
    mutations: {
        initState(state, payload){
            state.users = payload;
        }
    },
    actions: {
        initState({commit}){
            let users = JSON.parse(document.getElementById('app').dataset['users']);
            commit('initState', users);
        }
    }
});

export default store;