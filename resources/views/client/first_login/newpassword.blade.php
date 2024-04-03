@extends('layouts.first_login')
@section('title', __('message.New Password'))
@section('content')
    <div class="container container-new-password">
        <div class="row align-items-center h-100">
            <div class="col-12 form-column">
                <form action="{{ route('client.first.store.password')}}" method ="post">
                    @csrf

                    <div class="row">
                        <div class="col-12 text-center">
                            <h2>{{ __('message.New Password')}}</h2>
                            <p class="my-4">{{ __('message.Introduce a new password')}}</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{{ __('message.E-Mail Address') }}</label>
                        <input type="text" class="form-control" id="newpassword" value="{{ auth()->user()->email }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="newpassword">{{__('message.Password')}}</label>
                        <input type="password" class="form-control" id="newpassword" name ="password" placeholder="{{__('message.Password')}}">
                        @error('password')
                            <div class="text-danger"> <strong> {{ $message}}</strong></div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="repeatpassword">{{__('message.Confirm Password')}}</label>
                        <input type="password" class="form-control" id="repeatpassword" name ="password_confirmation" placeholder="{{__('message.Confirm Password')}}">

                    </div>

                    <button type="submit" class="form-button my-4 btn-block">{{ __('message.change_password') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
