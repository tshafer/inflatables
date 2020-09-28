@extends('admin.layout')

@section('title') Edit User @stop

@section('subtitle') {{$user->name}} @stop

@section('content')

  <div class="col-md-8 col-md-offset-2">
    <div class="block">
      <div class="block-title">
        <div class="block-options pull-right">
          {!! toolbar_link(['admin.users.show', $user->id], 'fa-times', 'Cancel') !!}
        </div>
        <h2>User Details</h2>
      </div>

      {!! model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'patch']) !!}
        @include('admin.users.form')
      {!! Form::close() !!}
    </div>
  </div>

@stop
