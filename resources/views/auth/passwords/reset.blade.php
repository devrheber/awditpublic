@extends('layouts.auth')
@section('title','Client Reset Password')
@section('content')
    <div class="container main-container">
        <div class="row justify-content-center align-items-center row-form">
            <div class="col-12 col-md-7 form-column">
                <div class="row">
                    <div class="col-12">
                        <x-logo-awdit />
                    </div>
                    <div class="col-12 my-4">
                        <h2 class="auth-title">{{ __('message.Reset Password') }}</h2>
                        <h5 class="auth-subtitle">{{ __('message.Introduce a new password') }}</h5>
                    </div>
                </div>
				<form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="email"> {{ __('message.E-Mail Address') }}</label>
                        <input type="text" name ="email" readonly class="form-control @error('email') is-invalid @enderror" id="email" value="{{ $email ?? old('email') }}">
                        @error('email')
                            <div class="text-danger"><strong> {{ $message }} </strong> </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('message.Password') }}</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="{{ __('message.enter_your_password') }}">
                        @error('password')
                        <div class="text-danger"><strong> {{ $message }} </strong> </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">{{ __('message.Confirm Password') }}</label>
                        <input type="password" name="password_confirmation"   class="form-control" id="confirm_password" placeholder="{{ __('message.enter_your_password') }}">
                    </div>
                    <button type="login" class="form-button my-4 w-100">{{ __('message.Reset Password') }}</button>
                </form>
            </div>
        </div>
        <div class="row row-language">
            <div class="col-12 col-md-4 text-center">
                <a href="{{ url('lang/en') }}" class="{{ session('locale') == 'en' ? 'current' : '' }}">{{ __('message.English') }}</a>
            </div>
            <div class="col-12 col-md-4 text-center">
                <a href="{{ url('lang/es') }}" class="{{ session('locale') == 'es' ? 'current' : '' }}">{{ __('message.Spanish') }}</a>
            </div>
            <div class="col-12 col-md-4 text-center">
                <a href="{{ url('lang/ca') }}" class="{{ session('locale') == 'ca' ? 'current' : '' }}">{{ __('message.Catalan') }}</a>
            </div>
        </div>
    </div>
@endsection
