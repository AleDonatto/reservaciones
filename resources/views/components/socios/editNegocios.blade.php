@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Editar datos de negocio</h1>
    </div>

    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Editar datos del negocio</h6>
        </div>
        <div class="card-body">
            <socios_updateunits :unidades="{{ json_encode($unidades) }}" :urlimagen="{{ json_encode(Storage::url($unidades->imagen))  }}" />
        </div>
    </div>
</div>
@endsection