
@extends('supplier.layouts.firstlogin')

@section('title','New-password')

@section('content')


	<!-- new apssword form is start -->
	<div class="user_profile_data">
		<form action="{{ route('supplier.first.store.newpassword')}}"  method ="post">
			@csrf
			<h2>{{ __('message.New Password')}}</h2>
			
			<p>{{ __('message.Introduce a new password')}}</p>
			
			<div class="form-group">
				@error('password')
					<div class="text-danger"> <strong> {{ $message}}</strong></div>
				@enderror
				<input type="password" class="form-control" id="newpassword" name ="password" placeholder="{{__('message.Password')}}">
				<label for="newpassword">{{__('message.Password')}}</label>
			</div>
			<div class="form-group">
				<input type="password" class="form-control" id="repeatpassword" name ="password_confirmation" placeholder="{{__('message.Confirm Password')}}">
				<label for="repeatpassword">{{__('message.Confirm Password')}}</label>
			</div>
			<div class="button_snd">
				<button type="submit" class="btn btn-primary">Send</button>	
				<button class="btn btn-primary" onclick="confirm('are you  sure to cancel..? \nIf you click on ok its logout and redirect to home page'); event.preventDefault();
                                        document.getElementById('logout-form').submit();">Cancel</button>
				
			</div>
		</form>
		<form id="logout-form" action="{{ route('supplier.logout') }}" method="POST" class="d-none">
            @csrf
        </form>
	</div>
	<!-- new apssword form is end -->
@endsection
