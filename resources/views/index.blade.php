@extends('layout')

@section('title') Welcome @stop

@section('content')
    <div class="container main-container">
        @if($sliders->count() > 0)
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="slider">
                        <ul class="bxslider">

                            @foreach($sliders as $slider)
                                @if($slider->getMedia('sliders')->count() > 0)
                                    <li>
                                        <a href="{{$slider->url}}">
                                            <img src="{{url('/')}}{{$slider->media->first()->getUrl('extralarge')}}"
                                                 alt="{{ $slider->title }}" class="img-responsive"/>
                                        </a>
                                    </li>
                                @endif
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="well">
                    {{Form::open(['route' => 'search'])}}
                    <div class="input-group">

                        {{ Form::input('text', 'q', null, ['class' => 'form-control input-search', 'placeholder' => 'Enter Something to Search']) }}
                        <span class="input-group-btn">
                            <button class="btn btn-default no-border-left" type="submit"><i class="fa fa-search"></i>
                            </button>
                        </span>

                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>

        @if($products->count() > 0)
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <span class="title">FEATURED PRODUCTS</span>

                    @foreach($products->chunk(3) as $chunkedProducts)
                        <div class="row">
                            @foreach($chunkedProducts as $product)
                                <div class="col-lg-4 col-sm-4 hero-feature text-center">
                                    <div class="thumbnail">
                                        <a href="{{route('product', [$product->categories->slug, $product->slug])}}">
                                            {!! defaultProductImage($product) !!}
                                        </a>

                                        <div class="caption prod-caption">
                                            <h4>
                                                <a href="{{route('product', [$product->categories->slug, $product->slug])}}"
                                                   class="color_dark">
                                                    {{ $product->name }}
                                                </a>
                                            </h4>
                                            <div class="btn-group">
                                                <a href="{{route('product', [$product->categories->slug, $product->slug])}}"
                                                   class="btn btn-primary">View</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@stop
