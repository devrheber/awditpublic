<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')</title>

    <!-- Styles -->
   <link rel="stylesheet" type="text/css" href="{{ asset('css/client/css/bootstrap.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{ asset('css/client/css/style.php')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/client/css/header_style.css')}}">

	<!-- select 2 -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    @yield('css')
</head>

<body>


	<!-- header  part  start -->
	<div class="new_header_wrap">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
				@if(request()->is('branding'))
					<a href="{{ route('client.first.create.questionnarie')}}">{{__('message.Skip')}}</a>
				@elseif(request()->is('questionnaire'))
					<a href="{{ url('/home')}}">{{__('message.Skip')}}</a>
				@endif
				</div>
				<div class="col-md-6">
					<div class="lang_head_new">
						<a  href="{{ url('lang/en') }}">{{__('message.English')}}</a>
						<a  href="{{ url('lang/es') }}">{{__('message.Spanish')}}</a>
						<a  href="{{ url('lang/ca') }}">{{__('message.Catalan')}}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- header part end -->


	<!-- main content start -->
		@yield('content')
    <!-- main content end -->

	<script type="text/javascript" src="{{asset('js/client/js/jquery.min.js ')}}"></script>
	<script type="text/javascript" src="{{asset('js/client/js/bootstrap.min.js')}}"></script>
	 <!-- select 2 js -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    @yield('script')
	 <script>
		$(document).ready(function() {
			$('.selecttwodropdown').select2();
		});
		</script>
</body>
</html>
