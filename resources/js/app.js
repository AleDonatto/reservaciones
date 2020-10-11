require('./bootstrap');

window.Vue = require('vue');

//import Vue from 'vue';
import { ValidationProvider } from 'vee-validate';
import { ValidationObserver } from 'vee-validate';
import VueRouter from 'vue-router';
//import { TheLitsBookins } from '../components/TheBookingList.vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css'
   

Vue.use(Vuetify); 
Vue.use(VueRouter);
// Register it globally
Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);
//Vue.component('TheLitsBookins', TheLitsBookins );

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const routes = [
    { path: '/socios_mesas/:id', component: require('./components/SociosShowMesasComponent.vue').default, name: "allMesas", props: true },
    { path: '/socios_mesas', component: require('./components/SociosMesasDisponibles.vue').default, name: "mesasDisponibles", props: true },
    { path: '/socios_mesas/reservaciones', component: require('./components/SociosShowBookings.vue').default, name: "reservacionesHoy", props:true}
]

const router = new VueRouter({
    routes: routes,
    mode: 'history'
});

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
Vue.component('socios_cons_bookings', require('./components/SociosConsBookings.vue').default)
Vue.component('mesas-component', require('./components/FormMesasComponent.vue').default)
Vue.component('cons_socios', require('./components/ConsSociosComponent.vue').default)
Vue.component('cons_tables', require('./components/ConsTablesComponent.vue').default);

const app = new Vue({
    router,
    vuetify: new Vuetify(),
}).$mount('#app');
