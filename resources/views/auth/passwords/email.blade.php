@extends('layouts.auth')
@section('title', 'Client Recover Password')
@section('content')
    <div class="container main-container">
        <div class="row justify-content-center align-items-center row-form">
            <div class="col-12 d-flex justify-content-center align-items-center middle-height">
                <img style="height:242px; display: block" src="{{ asset('images/client/images/forgot_password.png') }}" alt="">
            </div>
            <div class="col-12 col-md-7 form-column middle-height">
                <div class="new_password_left text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email">{{ __('message.E-Mail Address') }}</label>

                            <input type="email" id="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror" aria-describedby="emailHelp"
                                   placeholder="{{ __('message.Enter email address') }}">
                            @error('email')
                                <x-login-input-error message="{{ $message }}"></x-login-input-error>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <a href="{{ route('login') }}" class="form-button-secondary my-4 w-100">{{ __('message.go_to_back') }}</a>
                            </div>
                            <div class="col">
                                <button type="submit" class="form-button my-4 w-100">{{ __('message.reset_password') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
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

{{--@extends('layouts.auth')--}}
{{--@section('title', 'Client Recover Password')--}}
{{--@section('content')--}}
{{--    <div class="">--}}
{{--        @if (session('status'))--}}
{{--            <div class="alert alert-success" role="alert">--}}
{{--                {{ session('status') }}--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-9 mx-auto text-center">--}}
{{--                    <form method="POST" action="{{ route('password.email') }}" class="form-custom">--}}
{{--                        @csrf--}}
{{--                        <img style="height:241.72px; margin-top:196.32px; margin-bottom:23px" src="{{ asset('images/client/images/forgot_password.png') }}" alt="">--}}

{{--                        <div style="max-width:478px;" class="ml-auto mr-auto">--}}
{{--                            <h5 class="forgot-password-text text-center">{{ __('message.Introduce your email to recover your password') }}</h5>--}}
{{--                            <div class="form-group">--}}
{{--                                <input type="email" name="email" class="form-custom-control" id="email"--}}
{{--                                       aria-describedby="emailHelp" placeholder="Enter username or email address">--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <button type="login" class="btn-custom-primary w-100">Reset password</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <label class="forgot-password-back"> <a href="{{ route('login') }}">Go to Back</a></label>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
