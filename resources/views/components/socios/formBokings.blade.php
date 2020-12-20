@extends('layouts.app')

@section('content')
<div class="container">
    <!--<socios_cons_bookings :unidades="{{ json_encode($unidades) }}"></socios_cons_bookings>-->

    <socios_form_reservacion :unidades="{{ json_encode($unidades) }}" ></socios_form_reservacion>
</div>
@endsection