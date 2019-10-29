/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import BootstrapVue from 'bootstrap-vue'
import VueRouter from 'vue-router'


Vue.use(BootstrapVue)
Vue.use(VueRouter)



import App from './components/AppComponent'
import Obe from './components/ObeComponent'
import Servicios from './components/ServiciosComponent'
import Sucursales from './components/SucursalesComponent'

//ORDENES
import Ordenes from './components/OrdenesComponent'
import OrdenAdd from './components/orden/AdicionarComponent'

import Resumen from './components/ResumenComponent'


//ROUTING
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'obe',
            component: Obe
        },
        {
            path: '/servicios',
            name: 'servicios',
            component: Servicios,
        },
        {
            path: '/sucursales',
            name: 'sucursales',
            component: Sucursales,
        },
        {
            path: '/ordenes',
            name: 'ordenes',
            component: Ordenes,
        },
        {
            path: '/orden-add',
            name: 'orden-add',
            component: OrdenAdd,
        },
        {
            path: '/resumen',
            name: 'resumen',
            component: Resumen,
        },
    ],
});

const API_URL = window.API_URL;


const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
