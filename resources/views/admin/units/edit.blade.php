@extends('admin.layout')

@section('title') Edit Unit @stop

@section('subtitle') {{$unit->name}} @stop

@section('content')
    <div class="row">
        {!!model($unit, ['route' => ['admin.units.update', $unit->id], 'method' => 'patch', 'id' => 'unit-form','files' => true])!!}

        @include('admin.units.form')

        {!!Form::close()!!}
    </div>
@stop
