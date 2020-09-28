@extends('layout')

@section('title', 'Contact')

@section('content')

    <div class="container main-container">
        <div class="row">
            @include('partials.flash')
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="no-padding">
                    <span class="title">OUR LOCATION</span>
                </div>
                Space Walk Sales<br/>
                450 31st St.<br/>
                Kenner, LA 70065<br/>
                Phone:<br/>
                Email: <a href="mailto:sales@herecomesfun.com">sales@herecomesfun.com</a><br/>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12">

                <div class="visible-xs visible-sm mobile-spacing"></div>

                <span class="title">CONTACT US</span>
                <p>Have any questions for our team? Contact us using the form below for any pricing inquiries, package
                    deals, or product specifications you need! Interested in learning more about the inflatable
                    industry? We have over 55 years of experience helping inflatable renters and operators around the
                    country find success.</p>
                {{ Form::open(['route' => 'contact.post']) }}

                <div class="row form-group">
                    <div class="col-md-12">
                        {{ Form::label('name', 'Your Name') }}
                        {{ Form::input('text','name', old('name'), ['class' => 'form-control', 'required']) }}
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        {{ Form::label('email', 'Email') }}
                        {{ Form::input('email','email', old('email'), ['class' => 'form-control', 'required']) }}
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        {{ Form::label('message', 'Message')}}
                        {{ Form::textarea('message', old('message'), ['class' => 'form-control', 'rows' => 10, 'required']) }}
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <div class="btn-group btns-cart">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
