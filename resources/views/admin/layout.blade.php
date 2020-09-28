<!DOCTYPE html>
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>
<html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <title>Space Walk | Admin</title>

    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
    <link rel="stylesheet" href="{{url('/')}}/assets/dashboard/css/styles.css"/>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('/')}}/assets/dashboard/jquery.fine-uploader/fine-uploader-gallery.min.css" />
    <link rel="stylesheet" href="{{url('/')}}/assets/dashboard/jquery.fine-uploader/fine-uploader-new.min.css" />

    @yield('styles')
    @yield('scripts-top')
</head>

<body>
    <div id="page-wrapper">

        <div id="page-container" class="sidebar-visible-lg sidebar-no-animations footer-fixed">

            @include('admin.partials.sidebar')

            <div id="main-container">

                @include('admin.partials.header')

                        <!-- Page content -->
                <div id="page-content">
                    <!-- Blank Header -->
                    <div class="content-header">
                        <div class="header-section">
                            <h1>
                                <i class="gi {{$icon or ''}}"></i>@yield('title')<br>
                                <small>@yield('subtitle')</small>
                            </h1>
                        </div>
                    </div>
                    @include('partials.flash')
                    @yield('content')

                    <div class="clearfix"></div>

                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
    <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- Bootstrap.js, Jquery plugins and Custom JS code -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>!window.jQuery && document.write(decodeURI('%3Cscript src="{{url('/')}}/assets/dashboard/js/vendor/jquery-1.11.1.min.js"%3E%3C/script%3E'));</script>

    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
    <script src="{{url('/')}}/assets/dashboard/js/plugins.js"></script>
    <script src="{{url('/')}}/assets/dashboard/js/vendor/tablesort.js"></script>
    <script src="{{url('/')}}/assets/dashboard/js/app.js"></script>
    <script src="{{url('/')}}/assets/dashboard/jquery.fine-uploader/jquery.fine-uploader.min.js"></script>
    <script src="{{url('/')}}/assets/dashboard/js/imageupload.js"></script>

    @stack('scripts')
    @yield('scripts')
</body>
</html>
