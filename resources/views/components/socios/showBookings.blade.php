@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Reservaciones </h1>
    </div>

    <socios_show_booking v-bind:bookings="{{ json_encode($booking) }}"></socios_show_booking>
</div>
@endsection