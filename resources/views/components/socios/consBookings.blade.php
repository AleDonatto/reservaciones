@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Consulta de Reservaciones</h1>
    </div>
    <v-app>
        <socios_cons_bookings :unidades="{{ json_encode($unidades) }}"></socios_cons_bookings>
    </v-app>
</div>
@endsection
