<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')</title>

    <!-- jquery file -->
    <script type="text/javascript" src="{{ asset('js/client/js/jquery.min.js ') }}"></script>

    {{--   datepicker cdn js and css --}}
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

    <!-- Styles -->
    <?php

    $data = getBrandcolor();
    if ($data) {
        session_start();
        $_SESSION['primary_color'] = $data->primary_color;
        $_SESSION['secondary_color'] = $data->secondary_color;
    }

    ?>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/client/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/client/css/style.php') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/ibm-plex-sans.php') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/cryptofont.php') }}">


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

    <!--  -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css">

    {{-- fullcalendar css --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/client/css/fullcalendar.css')}}"> --}}

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
    @include('layouts.header')
    <!--Header end -->

    <!-- sidebar start -->
    @include('layouts.sidebar')
    <!-- sidebar end -->

    <!-- Content -->
    <div class="main">

        <!-- main content start -->
        @yield('content')
        <!-- main content end -->

        <!-- footer start -->
        <x-footer></x-footer>
        <!-- footer end -->
    </div>



    <!-- data table  js -->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <!-- select 2 js -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>



    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/client/js/bootstrap.min.js') }}"></script>


    {{-- amcharts js file --}}
    {{-- <script src="{{asset('js/client/js/core.js')}}"></script> --}}
    {{-- <script src="{{asset('js/client/js/charts.js')}}"></script> --}}
    {{-- <script src="{{asset('js/client/js/animated.js')}}"></script>  --}}

    {{--  charts js --}}
    <script type="text/javascript" src="{{ asset('js/client/js/Chart.min.js ') }}"></script>

    <!-- page level js -->
    <script type="text/javascript" src="{{ asset('js/client/js/script.js') }}"></script>

    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js">
    </script>

    <!-- DATE PAICKER JS FILE -->
    <script type="text/javascript" src="{{ asset('js/client/js/datepicker.js') }}"></script>

    <!-- full calendar js -->
    {{-- <script src="{{asset('js/client/js/fullcalendar.js')}}"></script> --}}



    @yield('script')

    {{-- <script>
        $(document).ready(function() {
            $('.selecttwodropdown').select2();
            var table = $('.datatable').DataTable({

                lengthChange: false
            });
            $('#new-pending-suppliers-search').keyup(function() {
                table.search($(this).val()).draw();
            });
        });
    </script> --}}
    <script>
        /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            var oldcountry = 0;
            var oldstate = 0;

            $('#country, #state ,#city, #category, #size, #maturity, #security, #datefilter, #MoSMif_drp1, #with_search_drp')
                .change(function() {

                    // get the value which are selected
                    var countryID = $('#country').val();
                    var MoSMif = $('#MoSMif_drp1').val();

                    var stateID = $('#state').val();

                    var cityid = $('#city').val();
                    var category = $("#category").val();
                    var size = $("#size").val();
                    var maturity = $("#maturity").val();
                    var security = $("#security").val();
                    var date = $('#datefilter').val();
                    var with_search_drp = $('#with_search_drp').val();


                    // called  this section if the country is selected
                    if (countryID) {
                        if (oldcountry != countryID) {
                            oldcountry = countryID;
                            url = "{{ route('client.get.state', ':id') }}";
                            url = url.replace(':id', countryID);
                            $.ajax({
                                type: "GET",
                                url: url,
                                success: function(res) {
                                    if (res) {
                                        $('#state').empty();
                                        $("#state").append('<option value="">State</option>');
                                        $("#state").append('<option value="all">All</option>');
                                        $.each(res, function(key, value) {
                                            $("#state").append('<option value="' + value
                                                .id + '">' + value.name + '</option>');
                                        });
                                    }
                                }
                            });
                        }
                    }
                    // called this section if the state is selected
                    if (stateID) {
                        if (oldstate != stateID) {
                            oldstate = stateID;
                            url = "{{ route('client.get.city', ':id') }}";
                            url = url.replace(':id', stateID);
                            $.ajax({
                                type: "GET",
                                url: url,
                                success: function(res) {
                                    if (res) {
                                        $('#city').empty();
                                        $("#city").append('<option value="">City</option>');
                                        $("#city").append('<option value="all">All</option>');
                                        $.each(res, function(key, value) {
                                            $("#city").append('<option value="' + value.id +
                                                '">' + value.name + '</option>');
                                        });
                                    }
                                }
                            });
                        }
                    }
                    //  caaled if filter is clicked
                    url = "{{ route('client.supplier.location.filter') }}";
                    $.ajax({
                        type: "post",
                        url: url,
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'country_id': countryID,
                            'state_id': stateID,
                            'city_id': cityid,
                            'sector': category,
                            'size': size,
                            'maturity': maturity,
                            'security': security,
                            'date': date,
                            'MoSMif': MoSMif,
                            'with_search_drp': with_search_drp,
                        },
                        success: function(res) {
                            if (res) {
                                $('#locationbody').empty();
                                $('#location').show();
                                $.each(res, function(key, value) {
                                    if (value.security == 1) {
                                        var sec = "Yes";
                                    } else {
                                        var sec = "No";
                                    }
                                    var id = value.supplier_id;
                                    var url =
                                        "{{ route('client.supplier.details', ':id') }}";
                                    url = url.replace(':id', id);
                                    $("#locationbody").append('<tr>' +
                                        '<td>' + value.first_name + ' ' + value
                                        .last_name + '</td>' +
                                        '<td>' + value.location_name + '</td>' +
                                        '<td>' + value.country.name + '</td>' +
                                        '<td>' + value.state.name + '</td>' +
                                        '<td>' + value.city.name + '</td>' +
                                        '<td>' + value.category.title + '</td>' +
                                        '<td>' + value.size.value + '</td>' +
                                        '<td>' + value.locationmaturity.level_name +
                                        '</td>' +
                                        '<td>' + sec + '</td>' +
                                        '<td>' + '<a href="' + url +
                                        '" class="btn btn-info"><i class="fa fa-eye"></i></a>' +
                                        '</td>' +
                                        '</tr>');
                                });
                            } else {}
                        }
                    });
                });


        });



        @if (isset($errors->messages()['current_password']) ||
                isset($errors->messages()['new_password']) ||
                isset($errors->messages()['confirm_password']))
            $("#change-password").modal("show");
        @endif
    </script>

</body>

</html>
