<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/client/css/bootstrap.min.css')}}">

    <!-- Styles -->
    <?php
    $data = getBrandcolor();

//    dd($data);
        if($data){
            session_start();
            $_SESSION["primary_color"] = $data->primary_color;
            $_SESSION["secondary_color"] = $data->secondary_color;
        }
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,400;1,700&display=swap" rel="stylesheet">
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/client/css/style.php')}}">--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/client/css/style.css')}}?v={{ time() }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/client/css/header_style.css')}}?v={{ time() }}">
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/client/css/header_style.php')}}">--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome.php') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    @yield('css')
</head>
<body>
	<div class="new_header_wrap">
		<div class="container h-100">
			<div class="row align-items-center h-100">
				<div class="col-md-6 h-100 d-flex justify-content-start align-items-center">
                    @if(request()->is('branding'))
                        @if(auth()->user()->can('create questionnaire'))
                            <a href="{{ route('client.first.create.questionnaire')}}">{{__('message.Skip')}}</a>
                        @else
                            <a href="{{ url('/home')}}">{{__('message.Skip')}}</a>
                        @endif
                    @elseif(request()->is('questionnaire/create'))
                        <a href="{{ url('/home')}}">{{__('message.Skip')}}</a>
                    @endif
				</div>
				<div class="col-md-6 d-flex justify-content-end align-items-center h-100">
                    <a href="{{ url('lang/en') }}" class="ml-3">{{__('message.English')}}</a>
                    <a href="{{ url('lang/es') }}" class="ml-3">{{__('message.Spanish')}}</a>
                    <a href="{{ url('lang/ca') }}" class="ml-3">{{__('message.Catalan')}}</a>
				</div>
			</div>
		</div>
	</div>

    @yield('content')


	<script type="text/javascript" src="{{asset('js/client/js/jquery.min.js ')}}"></script>
	<script type="text/javascript" src="{{asset('js/client/js/bootstrap.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
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
