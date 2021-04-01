require('./bootstrap');

import router from './router';
import App from './layouts/App.vue';
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'
import auth from './auth.js';
import api from './modules/api';
import 'bootstrap/dist/css/bootstrap.min.css';

window.auth = new auth();
window.api = new api();
window.Vue = require('vue').default;

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.use(Buefy);

const app = new Vue({
    router,
    el: '#app',
    render: h => h(App)
});
