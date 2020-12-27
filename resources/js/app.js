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
    { path: '/socios_mesas/:id', component: require('./components/socios/SociosShowMesasComponent.vue').default, name: "allMesas", props: true },
    { path: '/socios_mesas', component: require('./components/socios/SociosMesasDisponibles.vue').default, name: "mesasDisponibles", props: true },
    { path: '/socios_mesas/reservaciones', component: require('./components/socios/SociosShowBookings.vue').default, name: "reservacionesHoy", props:true}
]

const router = new VueRouter({
    routes: routes,
    mode: 'history'
});

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('formsocios-componet', require('./components/FormSociosComponent.vue').default);
Vue.component('formbussines-component', require('./components/FormBusinessComponent.vue').default);
Vue.component('bussinesunist_socios', require('./components/FormUnitsSociosComponent.vue').default);
Vue.component('socios-mesas-component', require('./components/socios/SociosMesasComponent.vue').default);
Vue.component('socios_show_mesas', require('./components/socios/SociosShowMesasComponent.vue').default)
Vue.component('TheLitsBookins', require('./components/socios/TheBookingList.vue').default)
Vue.component('socios_form_reservacion', require('./components/socios/SociosFormReservacion.vue').default)
Vue.component('socios_show_booking', require('./components/socios/SociosShowBookings.vue').default)
Vue.component('clientes_show_negocios', require('./components/clientes/ClientesShowUnitsComponent.vue').default)
Vue.component('clientes_reservaciones', require('./components/clientes/ClientesListReservasComponent.vue').default)
Vue.component('clientesReservaciones',require('./components/clientes/ClientesReservacionComponent.vue').default)
Vue.component('clientes_formreservacion',require('./components/clientes/ClientesFormReservacionComponent.vue').default)
Vue.component('clientes_all_bookings', require('./components/clientes/ClientesConsultaReservacionesComponent.vue').default)

Vue.component('socios_cons_bookings', require('./components/socios/SociosConsBookings.vue').default)
Vue.component('socios_updateunits', require('./components/socios/EditNegocios.vue').default)
Vue.component('socios-consulta-mesas', require('./components/socios/SociosConsultaMesas.vue').default)
Vue.component('socios_misreservaciones', require('./components/socios/MisReservaciones.vue').default)

Vue.component('form-users-units', require('./components/socios/FormUsersUnits.vue').default)
Vue.component('mesas-component', require('./components/FormMesasComponent.vue').default)
Vue.component('cons_socios', require('./components/ConsSociosComponent.vue').default)
Vue.component('cons_tables', require('./components/ConsTablesComponent.vue').default);
Vue.component('perfil_user', require('./components/PerfilUser.vue').default);
Vue.component('password_user', require('./components/CambioPassword.vue').default);

Vue.component('admin-user-units', require('./components/admin/AdminUsuarioUnidad.vue').default);
Vue.component('codigos-registro', require('./components/admin/CodigoRegistro.vue').default);
Vue.component('admin-reservaciones', require('./components/admin/FormBookingsAdmin.vue').default);
Vue.component('admin_misreservaciones', require('./components/admin/MisReservacionesAdmin.vue').default);
Vue.component('admin_allreservaciones', require('./components/admin/AllReservacionesAdmin').default);
Vue.component('form-user-admin', require('./components/admin/FormUserAdmin.vue').default);

Vue.component('form-mesas-userunits', require('./components/userunits/FormMesasUserUnits.vue').default);
Vue.component('consmesas-userunits', require('./components/userunits/ConsMesasUserUnit.vue').default );
Vue.component('form-reservaciones-userunit', require('./components/userunits/FormReservacionesUserUnit.vue').default);
Vue.component('cons-reservaciones-userunit', require('./components/userunits/ConsReservacionesUserUnit.vue').default);

const app = new Vue({
    router,
    vuetify: new Vuetify(),
}).$mount('#app');
