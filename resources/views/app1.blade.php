<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('head_title', getcong('site_name'))</title>
        <meta name="description" content="@yield('head_description')" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="@yield('head_title',  getcong('site_name'))" />
        <meta property="og:description" content="@yield('head_description', getcong('site_description'))" />
        <meta property="og:keywords" content="@yield('head_keywords', getcong('site_description'))" />
        <meta property="og:image" content="@yield('head_image', url('/upload/logo.png'))" />
        <meta property="og:url" content="@yield('head_url', url('/'))" />
        <!-- Web fonts -->
        <link rel="shortcut icon" href="{{ URL::asset('upload/'.getcong('site_favicon')) }}">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet"> 
        <link href="{{ URL::asset('profile_assets/site_assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('profile_assets/site_assets/css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('profile_assets/site_assets/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('profile_assets/site_assets/css/daterangepicker.css') }}" rel="stylesheet" type="text/css" media="all">
        <link href="{{ URL::asset('profile_assets/site_assets/css/style.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('profile_assets/site_assets/css/flat-css/flaticon.css') }}" rel="stylesheet"> 		
        <link href="{{ URL::asset('profile_assets/site_assets/css/ionicons.min.css') }}" rel="stylesheet"> 
        <link href="{{ URL::asset('profile_assets/site_assets/css/select2.min.css') }}" rel="stylesheet"> 
        <link href="{{ URL::asset('profile_assets/site_assets/css/style_chat.css') }}" rel="stylesheet"> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <style>
        #myProgress {
            width: 100%;
            background-color: #ddd;
        }

        #myBar {
            width: 0%;
            height: 30px;
            background-color: #4CAF50;
        }
    </style>
    <body>
        <?php ini_set('display_errors', '1'); ?>      
        @include("includes.header1")
        @yield("content")
        @include("includes.footer1")
        <!-------- Scripts ---------->
        <script src="{{ URL::asset('profile_assets/site_assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('profile_assets/site_assets/js/moment.js') }}" type="text/javascript" charset="utf-8"></script>
        <script src="{{ URL::asset('profile_assets/site_assets/js/daterangepicker.js') }}"></script>
        <script src="{{ URL::asset('profile_assets/site_assets/js/jquery-simple-mobilemenu.min.js') }}"></script>
        <script src="{{ URL::asset('profile_assets/site_assets/js/select2.min.js') }}"></script>
        <script src="{{ URL::asset('profile_assets/site_assets/js/jquery.cropit.js') }}"></script>
        <script src="{{ URL::asset('profile_assets/site_assets/js/custom.js') }}"></script>
        @yield('extra-js')
    </body>
</html>