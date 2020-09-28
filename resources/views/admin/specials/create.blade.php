@extends('admin.layout')

@section('title') Create a Special @stop

@section('content')
    <div class="row">
        {!!Form::open(['route' => 'admin.specials.store', 'id' => 'special-form', 'files' => true])!!}

        @include('admin.specials.form')

        {!!Form::close()!!}
    </div>
@stop
