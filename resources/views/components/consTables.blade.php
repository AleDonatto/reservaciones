@extends('layouts.app')

@section('content')
<div class="container">
   <cons_tables :socios="{{ json_encode($socios) }}"></cons_tables>
</div>
@endsection