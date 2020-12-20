@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Socios</h1>
    </div>

    <!--<div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Agregar Nuevo Socio</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('socios.store') }}" method="post" id="form">
                @csrf
    
                <div class="row form-group">
                    <div class="col-6 col-md-6 col-sm-12">
                        <label for="razonsocial">Razon Social <sup class="text-danger"> <strong>*</strong> </sup> </label>
                        <input type="text" name="razonsocial" id="razonsocial" class="form-control @error('razonsocial') is-invalid @enderror" 
                        placeholder="Razon Social">
    
                        @error('razonsocial')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-6 col-md-6 col-sm-12">
                        <label for="RFC">RFC <sup class="text-danger"> <strong>*</strong> </sup> </label>
                        <input type="text" name="RFC" id="RFC" class="form-control @error('RFC') is-invalid @enderror" placeholder="RFC">
    
                        @error('RFC')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
    
                <div class="row form-group">
                    <div class="col-6 col-md-6 col-sm-12">
                        <label for="telefono1">Telefono 1 <sup class="text-danger"> <strong>*</strong> </sup> </label>
                        <input type="tel" name="telefono1" id="telefono1" class="form-control @error('telefono1') is-invalid @enderror" 
                        placeholder="Telefono 1">
    
                        @error('telefono1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-6 col-md-6 col-sm-12">
                        <label for="telefono2">Telefono 2</label>
                        <input type="tel" name="telefono2" id="telefono2" class="form-control @error('telefono2') is-invalid @enderror" placeholder="Telefono 2">
    
                        @error('telefono2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
    
                <div class="row form-group">
                    <div class="col-4 col-md-4 col-sm-12">
                        <label for="email">Correo <sup class="text-danger"> <strong>*</strong> </sup> </label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@example.com">
    
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-4 col-md-4 col-sm-12">
                        <label for="sitioweb">Sitio Web</label>
                        <input type="text" name="sitioweb" id="sitioweb" class="form-control @error('sitioweb') ins-invalid @enderror"
                        placeholder="Sitio Web">
    
                        @error('sitioweb')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
    
                    </div>
                    <div class="col-4 col-md-4 col-sm-12">
                        <label for="nombresocio">Nombre Socio <sup class="text-danger"> <strong>*</strong> </sup> </label>
                        <input type="text" name="nombresocio" id="nombresocio" class="form-control @error('nombresocio') is-invalid @enderror"
                        placeholder="Nombre Socio">
    
                        @error('nombresocio')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Agregar Nuevo Socio
                </button>
                <button type="reset" class="btn btn-light">Retablecer</button>
    
            </form>
        </div>
    </div>-->
    <v-app>
        <formsocios-componet></formsocios-componet>
    </v-app>
    <!--<div class="justify-content-center col-md-12 col-xl-12 col-sm-12">
        <form action="{{ route('socios.store') }}" method="post">
            @csrf

            <div class="row form-group">
                <div class="col-6 col-md-6 col-sm-12">
                    <label for="razon-social">Razon Social</label>
                    <input type="text" name="razon-social" id="razon-social" class="form-control @error('razon-social') is-invalid @enderror" 
                    placeholder="Razon Social">

                    @error('razon-social')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-6 col-md-6 col-sm-12">
                    <label for="RFC">RFC</label>
                    <input type="text" name="RFC" id="RFC" class="form-control @error('RFC') is-invalid @enderror" placeholder="RFC">

                    @error('RFC')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row form-group">
                <div class="col-6 col-md-6 col-sm-12">
                    <label for="telefono1">Telefono 1</label>
                    <input type="tel" name="telefono1" id="telefono1" class="form-control @error('telefono1') is-invalid @enderror" 
                    placeholder="Telefono 1">

                    @error('telefono1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-6 col-md-6 col-sm-12">
                    <label for="telefono2">Telefono 2</label>
                    <input type="tel" name="telefono2" id="telefono2" class="form-control @error('telefono2') is-invalid @enderror" placeholder="Telefono 2">

                    @error('telefono2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row form-group">
                <div class="col-4 col-md-4 col-sm-12">
                    <label for="email">Correo</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@example.com">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-4 col-md-4 col-sm-12">
                    <label for="sitioweb">Sitio Web</label>
                    <input type="text" name="sitioweb" id="sitioweb" class="form-control @error('sitioweb') ins-invalid @enderror"
                    placeholder="Sitio Web">

                    @error('sitioweb')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
                <div class="col-4 col-md-4 col-sm-12">
                    <label for="nombresocio">Nombre Socio</label>
                    <input type="text" name="nombresocio" id="nombresocio" class="form-control @error('nombresocio') is-invalid @enderror"
                    placeholder="Nombre Socio">

                    @error('nombresocio')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-plus"></i> Agregar Nuevo Socio
            </button>

        </form>
    </div>-->
</div>
@endsection
