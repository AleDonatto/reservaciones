import ClientsReservar from './components/ClientesReservacionComponent.vue'
//import Profile from './components/admin/ProfileComponent.vue'
//import User from './components/admin/UserComponent.vue'

export const routes = [
    {
        path: '/allMesas',
        component: TodasMesas,
        name: "allMesas"
    },
    {
        path: '/disponibles',
        component: MesasDisponibles,
        name: "MesasDisponibles"
    },
    {
        path: '/reservaciones_now',
        component: ReservacionesHoy,
        name: "ReservacionesHoy"
    }
];