@extends('admin.layout')

@section('title') Edit Category @stop

@section('subtitle') {{$category->name}} @stop

@section('content')
    <div class="row">
        {!!model($category, ['route' => ['admin.categories.update', $category->id], 'method' => 'patch', 'id' => 'category-form','files' => true])!!}

        @include('admin.categories.form')

        {!!Form::close()!!}
    </div>
@stop
