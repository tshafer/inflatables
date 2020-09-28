@extends('layout')

@section('title') Sign in to Space Walk Online @stop

@section('content')
    <div class="container">
        @include('partials.flash')
        <h1 class="center">Sign into Space Walk Online</h1>
        <br/>
        {!! Form::open(['route' => 'login', 'method' => 'post']) !!}
        <div class="form-group">
            {!! Form::label('email') !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Password') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! link_to_route('password.request', 'Forgot Password?') !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Login', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>

@stop
