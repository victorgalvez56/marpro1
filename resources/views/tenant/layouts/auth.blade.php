<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--    <title>{{ config('app.name', 'Facturación Electrónica') }}</title>--}}
    <title>Facturación Electrónica</title>


    <link rel="shortcut icon" href="images/favicon.ico" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{ asset('vito-bootstrapp/css/bootstrap.min.css') }}">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="{{ asset('vito-bootstrapp/css/typography.css') }}">
      <!-- Style CSS -->
      <link rel="stylesheet" href="{{ asset('vito-bootstrapp/css/style.css') }}">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="{{ asset('vito-bootstrapp/css/responsive.css') }}">


</head>

<body>

    <div class="app">
        @yield('content')
    </div>

    @stack('scripts')
    <!-- <script src="//code.tidio.co/1vliqewz9v7tfosw5wxiktpkgblrws5w.js"></script> -->
</body>

</html>
