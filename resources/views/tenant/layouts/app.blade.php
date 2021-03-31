<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="fixed no-mobile-device custom-scroll
        {{$vc_compact_sidebar->compact_sidebar == true ? 'sidebar-left-collapsed' : ''}}
        {{$visual->header == 'dark' ? 'header-dark' : ''}}
        {{$visual->sidebars == 'dark' ? '' : 'sidebar-light'}}
        {{$visual->bg == 'dark' ? 'dark' : ''}}
        ">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--    <title>{{ config('app.name', 'Facturación Electrónica') }}</title>--}}
    <title>Facturación Electrónica</title>

    <!-- Scripts -->

    <!-- Fonts -->
    {{--<link rel="dns-prefetch" href="https://fonts.gstatic.com">--}}
    {{--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">--}}

    <link async href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('vito-bootstrapp/images/favicon.ico') }}" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{ asset('vito-bootstrapp/css/bootstrap.min.css') }}">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="{{ asset('vito-bootstrapp/css/typography.css') }}">
      <!-- Style CSS -->
      <link rel="stylesheet" href="{{ asset('vito-bootstrapp/css/style.css') }}">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="{{ asset('vito-bootstrapp/css/responsive.css') }}">
       <!-- Full calendar -->
       <link rel="stylesheet" href="{{ asset('vito-bootstrapp/fullcalendar/core/main.css') }}">
       <link rel="stylesheet" href="{{ asset('vito-bootstrapp/fullcalendar/daygrid/main.css') }}">
       <link rel="stylesheet" href="{{ asset('vito-bootstrapp/fullcalendar/timegrid/main.css') }}">
       <link rel="stylesheet" href="{{ asset('vito-bootstrapp/fullcalendar/list/main.css') }}">

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


    {{-- @if (file_exists(public_path('theme/custom_styles_ecommerce.css')))
        <link rel="stylesheet" href="{{ asset('theme/custom_styles_ecommerce.css') }}" />
    @endif --}}


    @stack('styles')


    <script src="{{ asset('porto-light/vendor/modernizr/modernizr.js') }}"></script>

    <style>
        .descarga {
            color:black;
            padding:5px;
        }
        .header .logo {
            height: 100%;
            margin-top: 5px;
        }

        .header .logo img {
            height: 45px;
        }

        html.sidebar-light:not(.dark) ul.nav-main > li.nav-active > a {
            color: #0088CC;
        }

        ul.nav-main > li.nav-active > a {
            box-shadow: 2px 0 0 #0088CC inset;
        }
        .el-checkbox__label {
            font-size: 13px;
        }
        .center-el-checkbox {
            display: flex;
            align-items: center;
        }
        .center-el-checkbox .el-checkbox {
            margin-bottom: 0
        }

    </style>

    <script defer src="{{ asset('js/app.js') }}"></script>

</head>
<body class="pr-0">

    <section class="body">
        <!-- start: header -->
        @include('tenant.layouts.partials.header')
        <!-- end: header -->
        <div class="inner-wrapper">
            <!-- start: sidebar -->
            @include('tenant.layouts.partials.sidebar')
            <!-- end: sidebar -->
            <section role="main" class="content-body" id="main-wrapper">
              @yield('content')
              {{-- @include('tenant.layouts.partials.sidebar_styles') --}}
              {{-- @include('tenant.layouts.partials.sidebar_styles') --}}
            </section>
            
            @yield('package-contents')
        </div>
    </section>
    @if($show_ws)
        @if(strlen($phone_whatsapp) > 0)
        <a class='ws-flotante' href='https://wa.me/{{$phone_whatsapp}}' target="BLANK" style="background-image: url('{{asset('logo/ws.png')}}'); background-size: 70px; background-repeat: no-repeat;" ></a>
        @endif
    @endif


    <!-- Vendor -->
    <script src="{{ asset('vito-bootstrapp/js/jquery.min.js') }}"></script>
    <script src="{{ asset('vito-bootstrapp/js/popper.min.js') }}"></script>
    <script src="{{ asset('vito-bootstrapp/js/bootstrap.min.js') }}"></script>
    <!-- Appear JavaScript -->
    <script src="{{ asset('vito-bootstrapp/js/jquery.appear.js') }}"></script>
    <!-- Countdown JavaScript -->
    <script src="{{ asset('vito-bootstrapp/js/countdown.min.js') }}"></script>
    <!-- Counterup JavaScript -->
    <script src="{{ asset('vito-bootstrapp/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('vito-bootstrapp/js/jquery.counterup.min.js') }}"></script>
    <!-- Wow JavaScript -->
    <script src="{{ asset('vito-bootstrapp/js/wow.min.js') }}"></script>
    <!-- Apexcharts JavaScript -->
    <script src="{{ asset('vito-bootstrapp/js/apexcharts.js') }}"></script>
    <!-- Slick JavaScript -->
    <script src="{{ asset('vito-bootstrapp/js/slick.min.js') }}"></script>
    <!-- Select2 JavaScript -->
    <script src="{{ asset('vito-bootstrapp/js/select2.min.js') }}"></script>
    <!-- Owl Carousel JavaScript -->
    <script src="{{ asset('vito-bootstrapp/js/owl.carousel.min.js') }}"></script>
    <!-- Magnific Popup JavaScript -->
    <script src="{{ asset('vito-bootstrapp/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Smooth Scrollbar JavaScript -->
    <script src="{{ asset('vito-bootstrapp/js/smooth-scrollbar.js') }}"></script>
    <!-- lottie JavaScript -->
    <script src="{{ asset('vito-bootstrapp/js/lottie.js') }}"></script>
    <!-- am core JavaScript -->
    <script src="{{ asset('vito-bootstrapp/js/core.js') }}"></script>
    <!-- am charts JavaScript -->
    <script src="{{ asset('vito-bootstrapp/js/charts.js') }}"></script>
    <!-- am animated JavaScript -->
    <script src="{{ asset('vito-bootstrapp/js/animated.js') }}"></script>
    <!-- am kelly JavaScript -->
    <script src="{{ asset('vito-bootstrapp/js/kelly.js') }}"></script>
    <!-- Flatpicker Js -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('vito-bootstrapp/js/chart-custom.js') }}"></script>
    <!-- Custom JavaScript -->
    <script src="{{ asset('vito-bootstrapp/js/custom.js') }}"></script>
    @stack('scripts')

    <script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
   
    <script>

        function parseXMLToJSON(source)
        {
            let transform = $.xml2json(source);
            return transform
        }

    </script>
    <!-- <script src="//code.tidio.co/1vliqewz9v7tfosw5wxiktpkgblrws5w.js"></script> -->


</body>
</html>
