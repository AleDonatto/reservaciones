@extends('layouts.app')

@section('content')
<div class="container">
    
    <ul class="list-group list-group-horizontal text-center">
        <router-link class="list-group-item list-group-item-action" to="/socios_mesas/{{$idUnidad}}">Todas las Mesas</router-link>
        <router-link class="list-group-item list-group-item-action" :to="{ name: 'mesasDisponibles'}">Mesas Disponibles</router-link>
        <router-link class="list-group-item list-group-item-action" :to="{ name: 'reservacionesHoy'}">Reservaciones</router-link>
    </ul>

    <div class="mt-3">
        <router-view :mesas="{{ json_encode($mesas) }}" :mesasdisponibles="{{ json_encode($mesas) }}" :bookings="{{ json_encode($bookings) }}" ></router-view>
    </div>
    <!--<socios_show_mesas v-bind:mesas="{{ json_encode($mesas) }}"></socios_show_mesas>-->
</div>
@endsection