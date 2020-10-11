@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Consulta Unidades de Negocio</h1>
    </div>

    <div class="contenedor">
        @foreach($negocios as $item)
        <div class="card" style="width: 16rem;">
            <img src="{{ asset('images/break.jpg') }}" class="card-img-top" alt="">
            <div class="card-body">
                <h5 class="card-title">{{ $item->nameUnit }}</h5>
                <p class="card-text text-justify text-truncate">
                    {{ $item->RFC }} <br> 
                    TEl: {{ $item->phone1.','.$item->phone2 }} <br>
                    E-mail: {{ $item->address }} <br>
                    Web: {{$item->webSite }} <br>
                    Contacto: {{ $item->nameContact }} <br>
                    Cancelacion: {{ $item->cancelation_time_limit }} (horas) 
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
    </div>

</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/listNegocios.css') }}">
@endpush
