<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="57x57" href="/images/icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/icon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/images/icon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/icon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/icon/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/images/icon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body style="height:120%;">
    <div id="app">

        @include('layouts.partials.navigation') <!-- always -->
         <div class="container">
             @include('flash::message')

             @yield('content') <!-- depends on which route was called -->
         </div>

    </div>


    @yield('script')

</body>
</html>