@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Unidades de Negocio</h1>
    </div>

    <!--<div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weith-bold text-primary">Unidades de Negocio</h6>
        </div>
        <div class="card-body">
            <form action="" method="post">
                @csrf

                @if(Auth::user()->rol == 1)
                <div class="row form-group">
                    <div class="col-12 col-md-12 col-xl-12">
                        <label for="company">Seleccione Compañia</label>
                        <select name="company" id="company" class="form-control">
                            @foreach($socios as $item)
                            <option value="{{ $item->idCompanies }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif

                <div class="row form-group">
                    <div class="col-3 col-md-6 col-xl-6">
                        <label for="RFC">RFC <sup class="text-danger"> <strong>*</strong> </sup> </label>
                        <input type="text" name="RFC" id="RFC" class="form-control @error('RFC') is-invalid @enderror">

                        @error('RFC')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-3 col-md-6 col-xl-6">
                        <label for="nombreunit">Nombre de la Unidad <sup class="text-danger"> <strong>*</strong> </sup> </label>
                        <input type="text" name="nombreunit" id="nombreunit" class="form-control @error('nombreunit') is-invalid @enderror">

                        @error('nombreunit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6 col-md-6 col-xl-6">
                        <label for="phone1">Telefono 1 <sup class="text-danger"> <strong>*</strong> </sup> </label>
                        <input type="tel" name="phone1" id="phone1" class="form-control @error('phone1') is-invalid @enderror" 
                        pattern="{6,10}">

                        @error('phone1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-6 col-md-6 col-xl-6">
                        <label for="phone2">Telefono 2</label>
                        <input type="text" name="phone2" id="phone2" class="form-control @error('phone2') is-invalid @enderror">

                        @error('phone2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6 col-md-6 col-xl-6">
                        <label for="correo">Correo <sup class="text-danger"> <strong>*</strong> </sup> </label>
                        <input type="email" name="correo" id="correo" class="form-control @error('correo') is-invalid @enderror">

                        @error('correo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-6 col-md-6 col-xl-6">
                        <label for="sitioweb">Sitio Web</label>
                        <input type="url" name="sitioweb" id="sitioweb" class="form-control @error('sitioweb') is-invalid @enderror">

                        @error('sitioweb')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6 col-md-6 col-xl-6">
                        <label for="namecontact">Nombre de Contacto <sup class="text-danger"> <strong>*</strong> </sup> </label>
                        <input type="text" name="namecontact" id="namecontact" class="form-control @error('namecontact') is-invalid @enderror">

                        @error('namecontact')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-6 col-md-6 col-xl-6">
                        <label for="timecancelation">Tiempo de Cancelacion</label>
                        <input type="text" name="timecancelation" id="timecancelation" class="form-control @error('timecancelation') is-invalid @enderror"
                        placeholder="00:00:00" size="6" maxlength="8">
                        

                        @error('timecancelation')
                        <span class="invalid-feddback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i>
                    Agregar Unidad
                </button>

                <button type="reset" class="btn btn-light">Retablecer</button>

            </form>
        </div>
    </div>-->
    
    <formbussines-component></formbussines-component>
</div>
@endsection

<script>
    /*$('#timecancelation').on('blur',function(e){
        $( 'ul.errors' ).each(function( index ) {
            var message = $( this ).text()
            if( message.includes("La hora ingresada no es valida") )   
            $( this ).hide()
        });
        
        var time =  $( this ).val()
        var re = /^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$/;
        if( time.length == 0 || time === '' ) return
        if ( !re.test( time ) ){
            $( '[name="time"]' ).addClass( 'invalid' )
            $( '[name="time"]' ).prop( 'aria-invalid', true )
            $('#errorsTop').append('<ul class="errors" role="alert"><li data-field-id="stationNumber">La hora ingresada no es valida</li></ul>')
            $("html, body").stop().animate({scrollTop:$( '#form' ).offset().top - 30}, 500, 'swing');
            return
  		}
  	})	*/
</script>