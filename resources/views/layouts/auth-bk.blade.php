<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/client/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/ibm-plex-sans.php') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/client/css/auth-custom-style.css') }}?v={{ time() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/client/css/style.php') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="new_password_wrap">
        <nav class="navbar navbar-expand-lg navbar-light" style="z-index: 999">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="mr-auto"></div>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if (session('locale') == 'en')
                                {{ __('message.English') }}
                            @elseif(session('locale') == 'es')
                                {{ __('message.Spanish') }}
                            @elseif(session('locale') == 'ca')
                                {{ __('message.Catalan') }}
                            @else
                                {{ __('message.Language') }}
                            @endif
                            <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ url('lang/en') }}"> {{ __('message.English') }}</a>
                            <a class="dropdown-item" href="{{ url('lang/es') }}"> {{ __('message.Spanish') }}</a>
                            <a class="dropdown-item" href="{{ url('lang/ca') }}"> {{ __('message.Catalan') }}</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- main content start -->
        @yield('content')
        <!-- main content end -->
        <x-footer></x-footer>
    </div>

    <script type="text/javascript" src="{{ asset('js/client/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/client/js/bootstrap.min.js') }}"></script>

</body>
</html>
