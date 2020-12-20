@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Crear Usuarios de Unidad</h4>
    <v-app>
        
        <form-users-units :unidades="{{ json_encode($unidades) }}" />
    </v-app>
</div>
@endsection