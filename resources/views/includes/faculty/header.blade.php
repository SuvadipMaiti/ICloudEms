<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
        ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('facultypanel/img/favicon.ico')}}">
    <!-- Google Fonts
        ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('facultypanel/css/bootstrap.min.css')}}">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('facultypanel/css/font-awesome.min.css')}}">
    <!-- owl.carousel CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('facultypanel/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('facultypanel/css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{asset('facultypanel/css/owl.transitions.css')}}">
    <!-- animate CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('facultypanel/css/animate.css')}}">
    <!-- normalize CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('facultypanel/css/normalize.css')}}">
    <!-- meanmenu icon CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('facultypanel/css/meanmenu.min.css')}}">
    <!-- main CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('facultypanel/css/main.css')}}">
    <!-- educate icon CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('facultypanel/css/educate-custon-icon.css')}}">
    <!-- morrisjs CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('facultypanel/css/morrisjs/morris.css')}}">
    <!-- mCustomScrollbar CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('facultypanel/css/scrollbar/jquery.mCustomScrollbar.min.css')}}">
    <!-- metisMenu CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('facultypanel/css/metisMenu/metisMenu.min.css')}}">
    <link rel="stylesheet" href="{{asset('facultypanel/css/metisMenu/metisMenu-vertical.css')}}">
    <!-- calendar CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('facultypanel/css/calendar/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{asset('facultypanel/css/calendar/fullcalendar.print.min.css')}}">
    <!-- style CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('facultypanel/style.css')}}">
    <!-- responsive CSS
        ============================================ -->
    <link rel="stylesheet" href="{{asset('facultypanel/css/responsive.css')}}">
    <!-- modernizr JS
        ============================================ -->
    <script src="{{asset('facultypanel/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    @yield('style')
</head>

<body>