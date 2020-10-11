@extends('layouts.app')

@section('content')
<div class="container">
    <!--<div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weith-bold text-primary">Mesas de Negocio</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('mesas.store') }}" method="post">
                @csrf
                <div class="row form-group">
                    <div class="col-12 col-md-12 col-xl-12">
                        <label for="negocio">Seleccione Unidad de Negocio</label>
                        <select name="negocio" id="negocio" class="form-control">
                            @foreach($unidades as $item)
                            <option value="{{ $item->idUnits }}">{{ $item->nameUnit }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6 col-md-6 col-xl-6">
                        <label for="numerosillas">Numero Mesa</label>
                        <input type="text" name="numMesa" id="numMesa" class="form-control">
                    </div>
                    <div class="col-6 col-md-6 col-xl-6">
                        <label for="numerosillas">Numero de Asientos</label>
                        <input type="number" name="numerosillas" id="numerosillas" class="form-control" min="1" step="1" value="1">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary text-white">
                    <i class="fas fa-check"></i>
                    Agregar Mesa
                </button>
                <button type="reset" class="btn btn-light">Retablecer</button>
            </form>
        </div>
    </div>-->

    <mesas-component :list_companies="{{ $companies }}" :listaunidades="{{ json_encode($unidades) }}"></mesas-component>

</div>
@endsection