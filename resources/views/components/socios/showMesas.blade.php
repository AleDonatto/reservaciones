@extends('layouts.app')

@section('content')
<div class="container">
    <socios_show_mesas v-bind:mesas="{{ json_encode($mesas) }}"></socios_show_mesas>
</div>
@endsection