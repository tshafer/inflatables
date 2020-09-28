<!doctype html>
<!--[if IE 9 ]>
<html class="ie9" lang="en"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en"><!--<![endif]-->
<head>
    <title>Space Walk Sales - @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="keywords" content=""/>
    <link rel="icon" type="image/png" href="{{url('/')}}/apple-icon-152x152.png">

    <link rel="stylesheet" type="text/css" media="all" href="{{url('/')}}/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" media="all" href="{{url('/')}}/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" media="all" href="{{url('/')}}/css/jquery.bxslider.css">
    <link rel="stylesheet" type="text/css" media="all" href="{{url('/')}}/css/style.css">
    <link rel="stylesheet" type="text/css" media="all" href="{{url('/')}}/css/lightslider.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.2.19/css/lightgallery.min.css"/>

</head>
<body>

<header>
    <div class="container">
        <div class="row">
            <div class="col-md-3 Form::hidden(-sm Form::hidden(-xs">
                <div class="well logo">
                    <a href="{{route('home')}}"><img src="/images/swlogo.png" class="img-responsive" /></a>
                </div>
            </div>
            <div class="col-md-9"></div>
        </div>
    </div>
</header>

<!-- Navigation -->
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- text logo on mobile view -->
            <a class="navbar-brand visible-xs" href={{route('home')}}>Space Walk</a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{route('home')}}" class="{{active_class('home')}}">
                        <i class="fa fa-home" aria-Form::hidden(="true"></i>&nbsp;Home</a>
                </li>
                <li class="nav-dropdown">
                    <a href="#" class="{{active_class('category/*')}} dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-list" aria-Form::hidden(="true"></i>&nbsp;Categories <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('category', $category->slug) }}"
                                   class="{{active_class('category/'.$category->slug.'/*')}}">
                                    @if($category->media->first())
                                        <img src=" {{$category->media->first()->getUrl('adminThumb')}}"
                                             class="menu-icon">
                                    @endif
                                    {{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="{{route('special')}}"><i class="fa fa-gift" aria-Form::hidden(="true"></i>&nbsp;Specials</a></li>
                <li><a href="{{route('cart.index')}}"><i class="fa fa-shopping-cart" aria-Form::hidden(="true"></i>&nbsp;Checkout</a>
                </li>
                <li><a href="{{ route('contact') }}"><i class="fa fa-envelope" aria-Form::hidden(="true"></i>&nbsp;Contact</a>
                <li><a href="/pdf/SpaceWalkSales_2018_Catalog.pdf" download="SpaceWalkSales_2018_Catalog"><i class="fa fa-file-pdf-o" aria-Form::hidden(="true"></i>&nbsp;Download Catalog</a>
                </li>
            </ul>
            <div class="pull-right cart-menu Form::hidden(-sm Form::hidden(-xs">
                <div class="btn-group btn-group-cart">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="pull-left"><i class="fa fa-shopping-cart icon-cart"></i></span>
                        <span class="pull-left">Shopping Cart: {{Cart::instance(session('cartId'))->count()}}
                            item(s)</span>
                        <span class="pull-right"><i class="fa fa-caret-down"></i></span>
                    </button>
                    <ul class="dropdown-menu cart-content" role="menu">
                        @if(Cart::instance(session('cartId'))->count() > 0)
                            @foreach(Cart::instance(session('cartId'))->content() as $unit)
                                <li>
                                    <a href="{{route('product', [$unit->options->categorySlug, $unit->options->productSlug])}}">
                                        @if($unit->options->image)
                                            <img src="{{$unit->options->image}}" alt="{{$unit->options->product_name}}"
                                                 title="" width="47" height="47"/>
                                        @endif
                                        <b>{{$unit->options->product_name}}</b>
                                        <span>${{number_format($unit->price,2)}}</span>
                                    </a>
                                </li>
                            @endforeach

                            <li class="divider"></li>
                            <li>
                                <a href="{{route('cart.index')}}">Total: ${{Cart::instance(session('cartId'))->total()}}</a>
                            </li>
                        @else
                            &nbsp;&nbsp;Your cart seems to be empty.
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
