<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/client/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/ibm-plex-sans.php') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/client/css/auth-custom-style.css') }}?v={{ time() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/client/css/style.php') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
</head>
<body>
    @yield('content')
{{--    <x-footer></x-footer>--}}

    <script type="text/javascript" src="{{ asset('js/client/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/client/js/bootstrap.min.js') }}"></script>
</body>
</html>
