window.Vue = require('vue');
window.axios = require('axios');
import router from "./routes";

import BootstrapVue from 'bootstrap-vue';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
Vue.use(BootstrapVue);

Vue.component('pagination', require('laravel-vue-pagination'));

Vue.component('app', require('./components/App').default);
Vue.component('navbar', require('./components/Navbar').default);
Vue.component('dashboard', require('./components/Dashboard').default);
Vue.component('statistics', require('./components/Statistics').default);
Vue.component('url-detail', require('./components/UrlDetail').default);

const app = new Vue({
    el: '#app',
    router
});
