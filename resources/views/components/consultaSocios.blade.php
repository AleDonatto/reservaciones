@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header py-3">
            <h4 class="m-0 font-weith-bold text-primary">Consulta de Socios</h4>
        </div>
        <div class="card-body">
            <v-app>
                <cons_socios :list_socios="{{ json_encode($socios) }}"></cons_socios>
            </v-app>
        </div>
    </div>
</div>
@endsection
