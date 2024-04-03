@extends('admin.layouts.auth')

@section('title','Admin Login')

@section('content')
<div class="row">
        <div class="col s12">
            <div class="container">
                <div id="login-page" class="row">
                    <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf

                            <div class="row">
                                <div class="input-field col s12">
                                    <h5 class="ml-4">{{ __('message.Admin Login') }}</h5>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">person_outline</i>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" >
                                    <label for="email" class="center-align">{{ __('message.E-Mail Address') }}</label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">lock_outline</i>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="current-password">
                                    <label for="password">{{ __('message.Password') }}</label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12 ml-2 mt-1">
                                    <p>
                                        <label>
                                            <input type="checkbox"  name="remember" id="remember"  {{ old('remember') ? 'checked' : '' }}>
                                            <span>Remember Me</span>
                                        </label>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('message.Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="input-field col s6 m6 l6">
                                <p class="margin right-align medium-small">
                                    <a href="{{ route('admin.forgot.form') }}">{{ __('message.Forgot Your Password?')}}</a>
                                </p>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection
