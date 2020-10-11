@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Consulta de Reservaciones</h1>
    </div>
    <socios_cons_bookings :unidades="{{ json_encode($unidades) }}"></socios_cons_bookings>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('DataTables/DataTables/css/jquery.dataTables.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('DataTables/DataTables/js/jquery.dataTables.min.js') }}"></script>
<script>
</script>
@endpush