@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Consulta Unidades de Negocio</h1>
    </div>

    <div class="contenedor">
        @if(count($negocios) == 0)
        <h4 class="">No hay Unidades agregadas</h4>
        @else
            @foreach($negocios as $item)
            <div class="card" style="width: 16rem;">
                @if($item->imagen == '' )
                <img src="{{ asset('images/break.jpg') }}" class="card-img-top" alt="imagen restaurant">
                @else
                @php
                  $url = Storage::url($item->imagen);
                @endphp
                <img src="{{ $url }}" class="card-img-top" alt="imagen restaurant">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $item->nameUnit }}</h5>
                    <p class="card-text text-justify text-truncate"> 
                    </p>
                    <a href="{{ route('socios_negocios.edit',$item->idUnits ) }}" class="btn btn-light">
                        <i class="far fa-edit"></i>
                    </a>
                    <a href="{{ route('socios_mesas.show', $item->idUnits ) }}" class="btn btn-light">
                        <i class="fas fa-chair"></i>
                    </a>
                </div>
            </div>
            @endforeach 
        @endif
    </div>

</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/listNegocios.css') }}">
@endpush
