@extends('layout')

@section('title') Rest your password @stop

@section('content')

    @include('partials.flash')

    <div class="container">
        <h1 class="center">{{ __('Reset Password') }}</h1>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        {!! Form::open(['route' => 'password.email', 'method' => 'post']) !!}

            <div class="form-group">
                {!! Form::label('E-Mail Address') !!}
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Send Password Reset Link', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection
