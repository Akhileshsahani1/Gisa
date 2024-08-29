<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Protect what matters most with GISA. Our comprehensive insurance solutions offer peace of mind for your home, car, health, and more. Get personalized coverage and competitive rates today." name="description" />
        <meta name="keywords" content="Insurance, Home Insurance, Car Insurance, Health Insurance, Life Insurance, Coverage, Protection, Security, GISA">
        <meta  name="author"  content="N2R Technologies"/>

        <!-- App css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css"/>
    </head>

    <body class="loading" data-layout-config='{"darkMode":false}'>
        @include('frontend.includes.navbar')
        @yield('content')
        @include('frontend.includes.footer')
        @include('frontend.includes.script')
    </body>
</html>
