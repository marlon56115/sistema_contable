require('./bootstrap');
window.Vue = require('vue');

//support vuex
import Vuex from 'vuex'
import storeData from "./store/index"
Vue.use(Vuex)
const store = new Vuex.Store(
    storeData
)
//support vue-router
import VueRouter from 'vue-router';
Vue.use(VueRouter);
const routes = [{
        path: '/home',
        component: require('./views/LibroDiarioView.vue').default,
    },
    {
        path: '/home/empresa',
        component: require('./views/EmpresaView.vue').default,
    }
]

const router = new VueRouter({
    routes: routes,
    mode: 'history'
})

//support bootstrao-vue e icons
import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)

//import vuetify
import vuetify from './vuetify'

//declaracion de componentes
Vue.component('librodiarioview', require('./views/LibroDiarioView.vue').default);
Vue.component('empresaview', require('./views/EmpresaView.vue').default);
Vue.component('vfooter', require('../js/components/Vfooter.vue').default);



//se monta app en #app
const app = new Vue({
    vuetify,
    el: '#app',
    store, //vuex
    router //router

});
