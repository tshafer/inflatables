@extends('admin.layout')

@section('title') Edit Slider @stop

@section('subtitle') {{$slider->name}} @stop

@section('content')
    <div class="row">
        {!!model($slider, ['route' => ['admin.sliders.update', $slider->id], 'method' => 'patch', 'id' => 'slider-form','files' => true])!!}

        @include('admin.sliders.form')

        {!!Form::close()!!}
    </div>
@stop
