@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Consulta de Reservaciones</h1>
    </div>
    <v-app>
        <cons-reservaciones-userunit :unidades="{{ json_encode($unidad) }}" />
    </v-app>
</div>
@endsection