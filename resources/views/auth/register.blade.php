@extends('layouts.auth')
@section('title', 'Client Registration')
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
        <div class="row d-flex justify-content-center align-items-center row-form">
            <div class="col-md-6 form-column">
                <div class="row">
                    <div class="col-12">
                        <x-logo-awdit />
                    </div>
                    <div class="col-12 my-4">
                        <h2 class="auth-title">{{ __('message.create_new_account') }}</h2>
                        <h5 class="auth-subtitle">{{ __('message.register_title') }}</h5>
                    </div>
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('warning'))
                            <div class="alert alert-danger">
                                {{ session('warning') }}
                            </div>
                        @endif
                    </div>
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="username">{{ __('message.UserName') }}</label>

                        <input id="username" type="text"
                               class="form-control @error('username') is-invalid @enderror" name="username"
                               value="{{ old('username') }}" autocomplete="username" autofocus
                               placeholder="{{ __('message.UserName') }}">
                        @error('username')
                        <div class="text-danger"><strong> {{ $message }} </strong> </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">{{ __('message.E-Mail Address') }}</label>
                        <input type="email" id="email" name="email"
                               class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                               aria-describedby="emailHelp" placeholder="yourname@youremail.com">
                        @error('email')
                        <div class="text-danger"><strong> {{ $message }} </strong> </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('message.Password') }}</label>

                        <input id="password" type="password"
                               class=" form-control @error('password') is-invalid @enderror" name="password"
                               autocomplete="new-password" placeholder="{{ __('message.enter_your_password') }}">
                        @error('password')
                        <div class="text-danger"><strong> {{ $message }} </strong> </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">{{ __('message.Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" autocomplete="new-password"
                               placeholder="{{ __('message.enter_your_password') }}">
                    </div>

                    <div class="form-check" style="margin: 17.44px 0 0 0">
                        <input class="form-check-input" type="checkbox" value="" id="termsCheck" required>
                        <label class="form-check-label" style="margin: 0" for="termsCheck">
                            {{ __('message.i_accept_the') }}
                            <a href="#">{{ __('message.terms_and_conditions') }}</a>
                            {{ __('message.and') }}
                            <a href="#">{{ __('message.privacy_policies') }}<a>.
                        </label>
                    </div>

                    <div class="form-group row my-4">
                        <button type="submit" class="form-button w-100">
                            {{ __('message.Register') }}
                        </button>
                    </div>
                </form>
                <div style="text-align: center">
                    <label class="form-check-label">
                        <p> {{ __('message.you_have_an_account') }} <a href="{{ route('login') }}">{{ __('message.Sign In') }}</a>
                        </p>
                    </label>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <img style="height: 500px;" src="{{ 'images/client/images/signup.png' }}" alt="">
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
