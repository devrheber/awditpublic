    <!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">

<!-- BEGIN: Head-->
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">

    <title> @yield('title') </title>

    <link rel="apple-touch-icon" href="{{ asset('images/favicon/apple-touch-icon-152x152.png') }} ">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon/favicon-32x32.png') }} ">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/sweetalert/sweetalert.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/flag-icon/css/flag-icon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/dropify/css/dropify.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/data-tables/css/select.dataTables.min.css')}}">

    <!-- END: VENDOR CSS-->

    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/themes/vertical-gradient-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/themes/vertical-gradient-menu-template/style.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/dashboard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/form-wizard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/data-tables.css')}}">
    <!-- END: Page Level CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom/custom.css') }}">
    <!-- END: Custom CSS-->

    <!-- BEGIN:specific page css -->
        @yield('css')
    <!-- END:specific page css -->

</head>
<!-- END: Head-->

<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-gradient-menu preload-transitions 2-columns   " data-open="click" data-menu="vertical-gradient-menu" data-col="2-columns">

        <!-- BEGIN: Header-->
        @include('admin.layouts.header')
        <!-- END: Header-->

        <!-- BEGIN: SideNav-->
        @include('admin.layouts.sidebar')
        <!-- END: SideNav-->

        <!-- BEGIN: Page Main-->
        <div id="main">
            <div class="row">
                @yield('content')
            </div>
        </div>
        <!-- END: Page Main-->

        <!-- BEGIN: Footer-->
        @include('admin.layouts.footer')
        <!-- END: Footer-->





    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('js/vendors.min.js')}}"></script>
    <!-- BEGIN VENDOR JS-->

    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('vendors/chartjs/chart.min.js')}}"></script>
    <script src="{{ asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{ asset('vendors/dropify/js/dropify.min.js')}}"></script>
    <script src="{{ asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('vendors/data-tables/js/dataTables.select.min.js')}}"></script>
    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN THEME  JS-->
    <script src="{{ asset('js/plugins.js')}}"></script>
    <script src="{{ asset('js/search.js')}}"></script>
    <script src="{{ asset('js/custom/custom-script.js')}}"></script>
    <!-- END THEME  JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('js/scripts/dashboard-ecommerce.js')}}"></script>
    <script src="{{ asset('js/scripts/extra-components-sweetalert.js')}}"></script>
    <script src="{{ asset('js/scripts/ui-alerts.js')}}"></script>
    <script src="{{ asset('js/scripts/form-file-uploads.js')}}"></script>
    <script src="{{ asset('js/scripts/form-wizard.js')}}"></script>
    <script src="{{ asset('js/scripts/data-tables.js')}}"></script>

    <!-- END PAGE LEVEL JS-->

    <!-- BEGIN:specific page js -->
    @yield('script')
    <!-- END:specific page js -->

    <!--BEGIN :Extra need of js -->
    <script>

    </script>
    <!--END :Extra need of js -->
</body>

</html>
