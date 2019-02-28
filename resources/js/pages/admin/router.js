import Vue from "vue"
import VueRouter from "vue-router"
import UsersPage from "./components/UsersPage.vue";
import UserEditPage from "./components/UserEditPage.vue";
Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        { path: "/admin", redirect: "/admin/users" },
        { path: "/admin/users/:id", component: UserEditPage},
        { path: "/admin/users", component: UsersPage},
    ]
});

export default router;
