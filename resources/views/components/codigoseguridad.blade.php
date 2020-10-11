@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">

        <div class="card-header py-3">
            <h6 class="m-0 font-weith-bold text-primary">Crear Codigos de Seguridad</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('codigos.store') }}" method="post">
                @csrf 
                <div class="row form-group">
                    <div class="col-md-12 col-12 col-sm-12 col-xl-12">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo de Registro" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <div class="input-group-append">
                              <button class="btn btn-outline-secondary" type="button" id="button-addon2" onClick="CodeSeg()">Generar Codigo</button>
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
                            @foreach($socios as $item)
                            <option value="{{ $item->idCompanies }}">{{ $item->RFC.'-'.$item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i>
                    Crear Codigo
                </button>
                <button type="reset" class="btn btn-light">Retablecer</button>
            </form>
        </div>

    </div>
</div>
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weith-bold text-primary">Conuslta de Codigos</h6>
        </div>
        <div class="card-body">
            <table id="usertable" class="table-striped display nowrap" style="width:100%">
                <thead>
                    <th>#</th>
                    <th>Code</th>
                    <th>Fecha Expiracion</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    @foreach($codigos as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->code_verification }}</td>
                        <td>{{ $item->date_expiration }}</td>
                        <td>
                            <button type="submit" class="btn btn-info ">Info</button>
                            <button type="submit" class="btn btn-light">Light</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('DataTables/DataTables/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('DataTables/Buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('DataTables/dataTables.min.js') }}"></script>
<script src="{{ asset('DataTables/DataTables/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('DataTables/Buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script>
    //import { datatables } from "datatables.net-bs4";
    //require('datatables.net-bs4')();
    //require('datatables.net-buttons-bs4')();
    //require('datatables.net-buttons/js/buttons.flash.js')();
    //require('datatables.net-buttons/js/buttons.html5.js')();

    function CodeSeg(){
        var num = Math.floor(Math.random() * (10000000000 - 0) +0);
        //console.log(num);
        $('#codigo').val(num)
    }

    $(document).ready(function() {
        $('#usertable').DataTable();
    });

    var table = $('#usertable').DataTable( {
        "scrollX": true,
        buttons: [
            'copy', 'excel', 'pdf'
        ]
    } );
  
    table.buttons().container()
        .appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );

    /*var table = $('#usertable').DataTable();
 
    new $.fn.dataTable.Buttons( table, {
        buttons: [
            'copy', 'excel', 'pdf'
        ]
    });*/
</script>
@endpush