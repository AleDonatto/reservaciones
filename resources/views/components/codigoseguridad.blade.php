@extends('layouts.app')

@section('content')
<div class="container">
    <v-app>
        <codigos-registro :socios="{{ json_encode($socios) }}" :codigos="{{ json_encode($codigos) }}" />
    </v-app>
</div>
<div class="container mt-5">
    <!--<div class="card shadow">
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
    </div>-->
</div>
@endsection
