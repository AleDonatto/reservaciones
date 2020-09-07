require('./bootstrap');

window.Vue = require('vue');

//import Vue from 'vue';
import { ValidationProvider } from 'vee-validate';
import { ValidationObserver } from 'vee-validate';
//import { TheLitsBookins } from '../components/TheBookingList.vue';

// Register it globally
Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);
//Vue.component('TheLitsBookins', TheLitsBookins );

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
Vue.component('clientesReservaciones',require('./components/ClientesReservacionComponent.vue').default)
Vue.component('clientes_formreservacion',require('./components/ClientesFormReservacionComponent.vue').default)
Vue.component('clientes_all_bookings', require('./components/ClientesConsultaReservacionesComponent.vue').default)

const app = new Vue({
    el: '#app'
});
