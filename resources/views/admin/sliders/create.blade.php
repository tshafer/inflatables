@extends('admin.layout')

@section('title') Create a Slider @stop

@section('content')
    <div class="row">
        {!!Form::open(['route' => 'admin.sliders.store', 'id' => 'slider-form', 'files' => true])!!}

        @include('admin.sliders.form')

        {!!Form::close()!!}
    </div>
@stop
