@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">

        <div class="card-header py-3">
            <h6 class="m-0 font-weith-bold text-primary">Crear Codigos de Seguridad</h6>
        </div>
        <div class="card-body">
            <form action="" method="post">
                @csrf 
                <div class="row form-group">
                    <div class="col-md-12 col-12 col-sm-12 col-xl-12">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Codigo de Registro" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <div class="input-group-append">
                              <button class="btn btn-outline-secondary" type="button" id="button-addon2">Generar Codigo</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6 col-md-6 col-sm-6 col-xl-6">
                        <label for="fecha">Fecha de Vencimiento</label>
                        <input type="date" name="fecha" id="fecha" class="form-control">
                    </div>
                    <div class="col-6 col-md-6 col-sm-6 col-xl-6">
                        <label for="socio">Seleccione Socio</label>
                        <select name="socio" id="socio" class="form-control">
                            <option value="">1</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i>
                    Crear Codigo
                </button>
            </form>
        </div>

    </div>
</div>
@endsection