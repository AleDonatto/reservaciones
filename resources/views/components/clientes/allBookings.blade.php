@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Reservaciones</h1>
    </div>
    <clientes_all_bookings :lista="{{ json_encode($listBookings) }}" ></clientes_all_bookings>
</div>
@endsection