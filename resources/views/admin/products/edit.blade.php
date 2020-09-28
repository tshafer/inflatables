@extends('admin.layout')

@section('title') Edit Product @stop

@section('subtitle') {{$product->name}} @stop

@section('content')
    <div class="row">
        {!!model($product, ['route' => ['admin.products.update', $product->id], 'method' => 'patch', 'id' => 'qq-form','files' => true])!!}

        @include('admin.products.form')

        {!!Form::close()!!}
    </div>
@stop
