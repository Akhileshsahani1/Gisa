<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title> @yield('title')</title>
    <meta name="description" content="@yield('meta_description')">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

    <!-- App css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('assets/css/customer.css') }}" rel="stylesheet" type="text/css" />
    @yield('head')
</head>

<body class="loading"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": false}'>
    <div id="preloader">
        <div id="status">
            <div class="spinner-border avatar-md text-dark" role="status"></div>
        </div>
    </div>
    <div class="wrapper">

        <!-- ========== Content Section Start ======= -->
        @include('frontend.includes.navbar')
        <div class="top_bar_fixedx">

            @if ($errors->any())
                @foreach ($errors->all() as $e)
                    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show"
                        role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong><i class="dripicons-wrong me-2"></i> </strong>{{ $e }}
                    </div>
                @endforeach
            @endif

            @yield('content')
        </div>
        @include('frontend.includes.footer')
        <!-- ========== Content Section End ========= -->

    </div>
    @include('customer.includes.script')
    <script>
        $(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 200) {
                    $('#scroll-to-top').fadeIn();
                } else {
                    $('#scroll-to-top').fadeOut();
                }
            });
            $('#scroll-to-top').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 200);
            });
        });
    </script>
</body>

</html>
