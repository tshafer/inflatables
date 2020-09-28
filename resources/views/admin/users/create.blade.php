@extends('admin.layout')

@section('title') Edit User @stop

@section('content')

  <div class="col-md-8 col-md-offset-2">
    <div class="block">
      <div class="block-title">
        <h2>User Details</h2>
      </div>

      {!! Form::open(['route' => 'admin.users.store']) !!}

        @include('admin.users.form')

      {!! Form::close() !!}
    </div>
  </div>

@stop
