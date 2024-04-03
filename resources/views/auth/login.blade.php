@extends('layouts.auth')
@section('title', 'Client Login')
@section('content')
    <div class="container main-container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="mr-auto"></div>

                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('message.Language')}} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('lang/en') }}"> {{ __('message.English')}}</a>
                                    <a class="dropdown-item" href="{{ url('lang/es') }}"> {{ __('message.Spanish')}}</a>
                                    <a class="dropdown-item" href="{{ url('lang/ca') }}"> {{ __('message.Catalan')}}</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row justify-content-center align-items-center row-form">
            <div class="col-md-5">
                <img style="width: 100%; height: auto;" src="{{ asset('images/client/images/login_bg.png') }}" alt="">
            </div>
            <div class="col-md-7 form-column">
                <div class="row">
                    <div class="col-12">
                        <x-logo-awdit />
                    </div>
                    <div class="col-12 my-4">
                        <h2 class="auth-title">{{ __('message.Login') }}</h2>
                        <h5 class="auth-subtitle">{{ __('message.welcome_title') }}</h5>
                    </div>
                    <div class="col-12">
                        {{ status() }}
                    </div>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="email">{{ __('message.E-Mail Address') }}</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" aria-describedby="emailHelp"
                            placeholder="{{ __('message.Enter email address') }}">
                        @error('email')
                            <x-login-input-error message="{{ $message }}"></x-login-input-error>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="d-flex justify-content-between" for="password">{{ __('message.Password') }}</label>
                        <input type="password" id="password" name="password"
                            class="form-control @error('Password') is-invalid @enderror"
                            placeholder="{{ __('message.Enter password') }}">
                        @error('password')
                            <x-login-input-error message="{{ $message }}"></x-login-input-error>
                        @enderror
                    </div>

                    <button type="submit" class="form-button my-4 w-100">{{ __('message.Login') }}</button>

                    <div class="form-group text-center">
                        <a href="{{ route('password.request') }}">{{ __('message.Forgot Your Password?') }}</a>
                    </div>
                    <a href="{{ route('register') }}" class="form-button my-4 w-100">{{ __('message.create_account') }}</a>
{{--                        <p>{{ __('message.Don’t you have an account?') }} <a ></a></p>--}}
                </form>
            </div>
        </div>
{{--        <div class="row row-language">--}}
{{--            <div class="col-12 col-md-4 text-center">--}}
{{--                <a href="{{ url('lang/en') }}" class="{{ session('locale') == 'en' ? 'current' : '' }}">{{ __('message.English') }}</a>--}}
{{--            </div>--}}
{{--            <div class="col-12 col-md-4 text-center">--}}
{{--                <a href="{{ url('lang/es') }}" class="{{ session('locale') == 'es' ? 'current' : '' }}">{{ __('message.Spanish') }}</a>--}}
{{--            </div>--}}
{{--            <div class="col-12 col-md-4 text-center">--}}
{{--                <a href="{{ url('lang/ca') }}" class="{{ session('locale') == 'ca' ? 'current' : '' }}">{{ __('message.Catalan') }}</a>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
@endsection
