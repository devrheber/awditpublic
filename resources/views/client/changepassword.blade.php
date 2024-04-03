@extends('layouts.first_login')

@section('title', 'Chnage-Password')

@section('content')
    <!-- new apssword form is start -->
    <div class="user_profile_data">

        <form action="{{ route('client.store.change.password') }}" method="post">
            @csrf
            <h2>{{ __('message.Change Password') }}</h2>
            <p>{{ __('message.Introduce a new password') }}</p>
            @if (session('success'))
                <div class=" alert alert-success"> {{ session('success') }} </div>
            @endif
            @if (session('error'))
                <div class=" alert alert-danger"> {{ session('error') }} </div>
            @endif
            <div class="form-group">
                @error('current_password')
                    <div class="text-danger"> <strong> {{ $message }}</strong></div>
                @enderror
                <input type="password" class="form-control" id="newpassword" name="current_password"
                    placeholder="{{ __('message.Current Password') }}">
                <label for="newpassword">{{ __('message.Current Password') }}</label>
            </div>
            <div class="form-group">
                @error('new_password')
                    <div class="text-danger"> <strong> {{ $message }}</strong></div>
                @enderror
                <input type="password" class="form-control" id="newpassword" name="new_password"
                    placeholder="{{ __('message.Password') }}">
                <label for="newpassword">{{ __('message.Password') }}</label>
            </div>
            <div class="form-group">
                @error('confirm_password')
                    <div class="text-danger"> <strong> {{ $message }}</strong></div>
                @enderror
                <input type="password" class="form-control" id="repeatpassword" name="confirm_password"
                    placeholder="{{ __('message.Confirm Password') }}">
                <label for="repeatpassword">{{ __('message.Confirm Password') }}</label>
            </div>
            <div class="button_snd">
                <a href="{{ route('client.profile.view') }}" class="btn btn-primary">{{ __('message.Back') }}</a>
                <button type="submit" class="btn btn-primary">{{ __('message.Change Password') }}</button>
            </div>
        </form>
    </div>

    <!-- new apssword form is end -->
@endsection
