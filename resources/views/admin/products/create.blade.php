@extends('admin.layout')

@section('title') Create a Product @stop

@section('content')
    <div class="row">
        {!!Form::open(['route' => 'admin.products.store', 'id' => 'product-form', 'files' => true])!!}

        @include('admin.products.form')

        {!!Form::close()!!}
    </div>
@stop
