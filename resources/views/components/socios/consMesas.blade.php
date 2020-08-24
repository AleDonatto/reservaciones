@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Consulta de Mesas</h1>
    </div>

    <div class="card shadow">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Todas las mesas</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered" id="">
                <thead>
                    <th>#</th>
                    <th>Negocio</th>
                    <th>N. mesa</th>
                    <th>N. silla</th>
                    <th>Estatus</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    @foreach($mesas as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nameUnit }}</td>
                        <td>{{ $item->num_mesa }}</td>
                        <td>{{ $item->number_chairs }}</td>
                        @if($item->status == 0)
                        <td>Disponible</td>
                        @endif  
                        <td>
                            <button type="button" class="btn btn-info">
                                <i class="far fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection