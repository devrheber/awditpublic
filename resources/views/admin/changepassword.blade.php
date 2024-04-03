@extends('admin.layouts.app')

@section('content')
<div class="pt-3 pb-1" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
        <div class="row">
            <div class="col s12 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{ __('message.Change Password') }}</span></h5>
            </div>
            <div class="col s12 m6 l6 right-align-md">
                <ol class="breadcrumbs mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">{{__('message.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{ __('message.Change Password') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="col s12">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div id="input-fields" class="card card-tabs">
                    <div class="card-content">
                        <div class="card-title">
                            <div class="row">
                                <div class="col s12 m6 l10">
                                    <h4 class="card-title">{{ __('message.Change Password') }}</h4>
                                </div>
                            </div>
                        </div>
                        @if (session('success'))
                        <div class="card-alert card gradient-45deg-green-teal">
                            <div class="card-content white-text">
                                <p>
                                    <i class="material-icons">check</i> 
                                    SUCCESS : {{ session('success')}}.
                                </p>
                            </div>
                            <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        @endif
                        @if (session('error'))
                        <div class="card-alert card gradient-45deg-red-pink">
                            <div class="card-content white-text">
                                <p>
                                    <i class="material-icons">error</i> 
                                    DANGER : {{ session('error')}}
                                </p>
                            </div>
                            <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        @endif
                        <div id="view-input-fields">
                            <div class="row">
                                <div class="col s12">
                                    <form action="{{ route('admin.store.change.password')}}" method="post">
                                        @csrf
                                        <div class="col s12">
                                            <div class="input-field col s12">
                                            <input type="password" class="form-control" name="current_password">
                                                <label for="password">{{__('message.Current Password')}}</label>
                                            </div>
                                        </div>
                                        <div class="col s12">
                                            <div class="input-field col s12">
                                            <input type="password" class="form-control" name ="new_password">
                                                <label for="password">{{__('message.New Password')}}</label>
                                            </div>
                                        </div>
                                        <div class="col s12">
                                            <div class="input-field col s12">
                                            <input type="password" class="form-control" name ="confirm_password">
                                                <label for="password">{{__('message.Confirm Password')}}</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary "> {{ __('message.Change Password') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
