require('./bootstrap');

import router from './router';
import App from './layouts/App.vue';
import Vuelidate from 'vuelidate'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'
import auth from './auth.js';
import api from './modules/api';

window.auth = new auth();
window.api = new api();
window.Vue = require('vue').default;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.use(Vuelidate);
Vue.use(Buefy);

const app = new Vue({
    router,
    el: '#app',
    render: h => h(App)
});
