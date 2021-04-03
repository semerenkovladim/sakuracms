require('./bootstrap');

import router from './router';
import App from './layouts/App.vue';
import Buefy from 'buefy'
import VueI18n from 'vue-i18n';
import 'buefy/dist/buefy.css'
import auth from './auth.js';
import api from './modules/api';
import 'bootstrap/dist/css/bootstrap.min.css';
import localizations from "./modules/localizations";

window.auth = new auth();
window.api = new api();
window.Vue = require('vue').default;

const locale = window.localStorage.getItem('locale');

const i18n = new VueI18n({
    locale: (locale === null) ? 'en' : locale,
    messages: localizations,
});
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.use(Buefy);

const app = new Vue({
    router,
    i18n,
    el: '#app',
    render: h => h(App)
});
