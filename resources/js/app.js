import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './router';
import Toasted from "vue-toasted";
import App from './components/AppComponent'
import {BootstrapVue} from 'bootstrap-vue';

Vue.use(VueRouter);
Vue.use(Toasted);

Vue.use(BootstrapVue);

const app = new Vue({
    el: '#app',
    components: { App },
    router: new VueRouter(routes),
});
