@extends('admin.layout')

@section('title') Create a Unit @stop

@section('content')
    <div class="row">
        {!!Form::open(['route' => 'admin.units.store', 'id' => 'unit-form', 'files' => true])!!}

        @include('admin.units.form')

        {!!Form::close()!!}
    </div>
@stop
