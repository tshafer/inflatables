@extends('admin.layout')

@section('title') Edit Special @stop

@section('subtitle') {{$special->name}} @stop

@section('content')
    <div class="row">
        {!!model($special, ['route' => ['admin.specials.update', $special->id], 'method' => 'patch', 'id' => 'slider-form','files' => true])!!}

        @include('admin.specials.form')

        {!!Form::close()!!}
    </div>
@stop
