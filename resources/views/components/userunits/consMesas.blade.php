@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Consulta Mesas de Unidad</h1>
    </div>

    <v-app>
        <consmesas-userunits :listmesas="{{ json_encode($mesas) }}" />
    </v-app>

</div>
@endsection