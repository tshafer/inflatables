@extends('layout')

@section('title', 'Checkout')

@section('content')

    <div class="container main-container">
        {{Form::open(['route' => 'checkout.store'])}}
        <div class="row">
            @include('partials.flash')
            <div class="col-md-12">
                <span class="title">CHECKOUT</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 hero-feature">

                <div class="row form-group">
                    <div class="col-md-6">
                        {{ Form::label('first_name')}} <span class="red">*</span>
                        {{ Form::input('first_name','first_name', old('first_name'), ['class' => 'form-control', 'required']) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('last_name')}} <span class="red">*</span>
                        {{ Form::input('last_name','last_name', old('company_website'), ['class' => 'form-control','required']) }}
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        {{ Form::label('company_name')}}
                        {{ Form::input('company_name','company_name', old('company_name'), ['class' => 'form-control']) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('company_website')}}
                        {{ Form::input('company_website','company_website', old('company_website'), ['class' => 'form-control']) }}
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        {{ Form::label('email') }} <span class="red">*</span>
                        {{ Form::input('email','email', old('email'), ['class' => 'form-control', 'required']) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('Phone')}} <span class="red">*</span>
                        {{ Form::input('phone','phone', old('telephone'), ['class' => 'form-control']) }}
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        {{ Form::label('message') }}
                        {{ Form::textarea('message', old('message'), ['class' => 'form-control', 'rows' => 5, 'max-length' => 1000]) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered cart tbl-cart table-hover table-condensed">
                    <thead>
                    <tr>
                        <td>Product</td>
                        <td>Price</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(Cart::instance(session('cartId'))->content() as $unit)
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-md-4 col-sm-12 col-xs-12 text-center">
                                        @if($unit->options->image)
                                            <a href="{{route('product', [$unit->options->categorySlug, $unit->options->productSlug])}}">
                                                <img src="{{$unit->options->image}}"
                                                     alt="{{$unit->options->product_name}}"
                                                     title="{{$unit->options->product_name}}" width="100%"/>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                        <div class="cart-info">
                                            <a href="{{route('product', [$unit->options->categorySlug, $unit->options->productSlug])}}">{{$unit->options->product_name}}</a>
                                            <div>
                                                - ({{$unit->options->width}} x {{$unit->options->length}}
                                                x {{$unit->options->height}}) - ({{$unit->options->weight}} LBS)
                                                -(#{{$unit->options->model}})
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>

                            <td class="text-center">
                                ${{number_format($unit->price,2)}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="Form::hidden(-xs"></td>
                        <td class="total text-center">Total <b>${{Cart::instance(session('cartId'))->subtotal()}}</b>
                    </tr>
                    </tfoot>
                </table>
                <div class="row form-group">
                    <div class="col-md-12">
                        <div class="btn-group btns-cart pull-right">
                            <button type="submit" class="btn btn-primary">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{Form::close()}}
    </div>
@stop
