@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Usuarios de Unidad de Negocios</h1>
    </div>

    <v-app>
        <admin-user-units :unidades="{{ json_encode($unidades) }}"></admin-user-units>
    </v-app>
</div>
@endsection