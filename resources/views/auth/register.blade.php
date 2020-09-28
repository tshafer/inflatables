@extends('layout')

@section('title') Register @stop

@section('content')

        <div class="container">
            @include('partials.flash')
            <h1 class="center">Register with Us.</h1>
            <br/>
            {!! Form::open(['route' => 'auth.register']) !!}
            <div class="form-group">
                {!! Form::label('Name') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Email') !!}
                {!! email('email', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Password') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Password Confirmation') !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            </div>

            {!! Form::submit('Join',['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
@endsection
