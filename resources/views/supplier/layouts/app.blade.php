<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')</title>

    <!-- jquery file -->
    <script type="text/javascript" src="{{ asset('js/client/js/jquery.min.js ') }}"></script>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/client/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/client/css/style.php') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/client/css/header_style.css') }}">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        type="text/css">

    <!-- select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- font family css -->
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap"
        rel="stylesheet">

    <!-- data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

    @yield('css')

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

</head>

<body>

    <!--Header start -->
    @include('supplier.layouts.header')
    <!--Header end -->

    <!-- sidebar start -->
    @include('supplier.layouts.sidebar')
    <!-- sidebar end -->

    <!-- Content -->
    <div class="main">

        <!-- main content start -->
        <div>
            <div class="global_wrapper flex-grow-1">
                @yield('content')
            </div>
        </div>
        <!-- main content end -->

        <!-- footer start -->
        @include('supplier.layouts.footer')
        <!-- footer end -->
    </div>


    <!-- data table  js -->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <!-- select 2 js -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/client/js/bootstrap.min.js') }}"></script>

    <!--charts js  -->
    <script type="text/javascript" src="{{ asset('js/client/js/Chart.min.js ') }}"></script>

    <!-- page level js -->
    <script type="text/javascript" src="{{ asset('js/client/js/script.js') }}"></script>

    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

    @yield('script')

    <script>
        $(document).ready(function() {
            $('.selecttwodropdown').select2();
            var table = $('.datatable').DataTable({

                lengthChange: false
            });
            $('#new-pending-suppliers-search').keyup(function() {
                table.search($(this).val()).draw();
            });
        });
    </script>

</body>

</html>
