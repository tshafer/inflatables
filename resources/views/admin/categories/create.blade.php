@extends('admin.layout')

@section('title') Create a Category @stop

@section('content')
    <div class="row">
        {!!Form::open(['route' => 'admin.categories.store', 'id' => 'category-form', 'files' => true])!!}

        @include('admin.categories.form')

        {!!Form::close()!!}
    </div>
@stop
