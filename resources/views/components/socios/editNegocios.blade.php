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
            <form action="{{ route('socios_negocios.update','id') }}" method="post">
                @csrf
                @method('PUT')
                <div class="row form-group">
                    <div class="col-6 col-md-6 col-sm-12">
                        <label for="rfc">RFC</label>
                        <input type="text" name="rfc" id="rfc" class="form-control @error('rfc') is-invalid @enderror " value="{{ $unidades->RFC }}">
                        <input type="hidden" name="idunidad" value="{{ $unidades->idUnits }}">
                        <input type="hidden" name="compania" value="{{ $unidades->idcompany }}">

                        @error('rfc')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-6 col-md-6 col-sm-12">
                        <label for="unidad">Nombre Unidad</label>
                        <input type="text" name="unidad" id="unidad" class="form-control @error('unidad') is-invalid @enderror" value="{{ $unidades->nameUnit }}">

                        @error('unidad')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6 col-md-6 col-sm-12">
                        <label for="telefono1">Telefono 1</label>
                        <input type="text" name="telefono1" id="telefono1" class="form-control @error('telefono1') is-invalid @enderror" value="{{ $unidades->phone1 }}">

                        @error('telefono1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-6 col-md-6 col-sm-12">
                        <label for="telefono2">Telefono 2</label>
                        <input type="text" name="telefono2" id="telefono2" class="form-control @error('telefono2') is-invalid @enderror" value="{{ $unidades->phone2 }}">

                        @error('telefono2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6 col-md-6 col-sm-12">
                        <label for="correo">Correo</label>
                        <input type="email" name="correo" id="correo" class="form-control @error('correo') is-invalid @enderror" value="{{ $unidades->address }}">

                        @error('correo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-6 col-md-6 col-sm-12">
                        <label for="sitioweb">Sitio Web</label>
                        <input type="text" name="sitioweb" id="sitioweb" class="form-control @error('sitioweb') is-invalid @enderror" value="{{ $unidades->webSite }}">

                        @error('sitioweb')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6 col-md-6 col-sm-12">
                        <label for="namecontact">Nombre del Contacto</label>
                        <input type="text" name="namecontact" id="namecontact" class="form-control @error('namecontact') is-invalid @enderror" value="{{ $unidades->nameContact }}">

                        @error('namecontact')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-6 col-md-6 col-sm-12">
                        <label for="tiempoCancelacion">Tiempo de Cancelacion</label>
                        <input type="number" min="0" max="24" step="1" name="hora" id="hora" class="form-control @error('tiempoCancelacion') is-invalid @enderror" 
                        value="{{ $unidades->cancelation_time_limit }}">

                        @error('tiempoCancelacion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Datos</button>
            </form>
        </div>
    </div>
</div>
@endsection