@extends('layout')

@section('title', $product->name)

@section('content')

    <div class="container main-container">
        <div class="row">
            <div class="col-md-12">
                <span class="title">{{$product->name}}</span>
            </div>
        </div>
        <div class="row hero-feature">

            <div class="col-md-8 col-sm-12 col-xs-12">
                <ul id="imageGallery" class="cS-Form::hidden(">
                    @foreach ($product->getMedia('products') as $photo)
                        <li data-thumb="{{$photo->getUrl('thumb') }}" data-src="{{$photo->getUrl('full') }}">
                            <img src="{{$photo->getUrl('medium') }}" class="img-responsive"/>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-4 col-sm-12 col-xs-12">

                <div class="visible-xs visible-sm mobile-spacing"></div>

                <span class="title">{{$product->name}}</span>
                <p>{{$product->description}} </p>
                @if($product->units->count())
                    <div class="well product-short-detail">
                        <div class="row">
                            <div class="the-list">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>W x L x H</th>
                                        <th>UNIT LB</th>
                                        <th>PRICE</th>
                                        <th>BUY</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($product->units as $unit)
                                        <tr>
                                            <td>{{$unit->width}} x {{$unit->length}}
                                                x {{$unit->height}}</td>
                                            <td>{{$unit->weight}}</td>
                                            <td>${{number_format($unit->price,2)}}</td>
                                            <td>
                                                {{Form::open(['route' => 'cart.store'])}}
                                                {{ Form::hidden('unit', $unit->id) }}
                                                <button type="submit" class="btn btn-primary btn-xs pull-left">
                                                    <i class="fa fa-shopping-cart"></i> Add to Cart
                                                </button>
                                                {{Form::close()}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            @if($product->getMedia('accessories')->count() > 0)
                <div class="col-md-12" style="margin-top:50px;">
                    <span class="title">Accessories</span>
                    <ul class="imageGallery" style="list-style-type: none">
                        @foreach ($product->getMedia('accessories') as $photo)
                            <li><img src="{{$photo->getUrl('accessories') }}" class="img-responsive"/></li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@stop
