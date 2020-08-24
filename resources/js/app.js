/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


/*import Vue from 'vue';*/
import { ValidationProvider } from 'vee-validate';
import { ValidationObserver } from 'vee-validate';
//import { TheLitsBookins } from '../components/TheBookingList.vue';

// Register it globally
Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);
//Vue.component('TheLitsBookins', TheLitsBookins );

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('formsocios-componet', require('./components/FormSociosComponent.vue').default);

Vue.component('formbussines-component', require('./components/FormBusinessComponent.vue').default);

Vue.component('bussinesunist_socios', require('./components/FormUnitsSociosComponent.vue').default);

Vue.component('socios-mesas-component', require('./components/SociosMesasComponent.vue').default);

Vue.component('socios_show_mesas', require('./components/SociosShowMesasComponent.vue').default)

Vue.component('TheLitsBookins', require('./components/TheBookingList.vue').default)

Vue.component('socios_formReservacion', require('./components/SociosFormReservacion.vue').default)

Vue.component('socios_show_booking', require('./components/SociosShowBookings.vue').default)

Vue.component('clientes_show_negocios', require('./components/ClientesShowUnitsComponent.vue').default)

Vue.component('clientes_reservaciones', require('./components/ClientesListReservasComponent.vue').default)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
*/

const app = new Vue({
    el: '#app',
});
