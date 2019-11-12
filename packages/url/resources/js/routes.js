import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Dashboard from "./components/Dashboard";
import Statistics from "./components/Statistics";
import UrlDetail from "./components/UrlDetail";

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/dashboard',
            component: Dashboard
        },
        {
            path: '/statistics',
            component: Statistics
        },
        {
            name: 'UrlDetail',
            path: '/url-detail',
            component: UrlDetail
        },
    ]
});
