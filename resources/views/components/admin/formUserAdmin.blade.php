@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Usuarios Administradores</h1>
    </div>

    <v-app>
        <form-user-admin :usuarios="{{ json_encode($usuarios) }}" />
    </v-app>

</div>
@endsection