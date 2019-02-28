import Vue from "vue"
import VueRouter from "vue-router"
import UsersPage from "./components/UsersPage.vue";
import UserEditPage from "./components/UserEditPage.vue";
import TransactionsPage from "./components/TransactionsPage.vue";
Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        { path: "/admin/users/:id", component: UserEditPage},
        { path: "/admin/users", component: UsersPage},
        { path: "/admin/transactions", component: TransactionsPage},
        { path: "/admin*", redirect: "/admin/users" }
    ]
});

export default router;
