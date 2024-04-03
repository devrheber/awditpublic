@extends('admin.layouts.app')

@section('title','Edit Profile')

@section('content')
<div class="pt-3 pb-1" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
        <div class="row">
            <div class="col s12 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{ __('message.Profile Details') }}</span></h5>
            </div>
            <div class="col s12 m6 l6 right-align-md">
                <ol class="breadcrumbs mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">{{__('message.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{ __('message.Profile Details') }}</li>
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
                                    <h4 class="card-title  float-left" >{{ __('message.Profile Details') }}</h4>
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
                        <form action="{{ route('admin.profile.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col s6">
                                    <input type="file" name ="image" id="input-file-now" class="dropify" data-default-file="{{ asset('images/admin/profile').'/'.$admin->image }}">
                                </div>
                                <div class="col s6">
                                    <div class="col s12">
                                        <div class="input-field col s12">
                                            <input id ="first_name" type="text" class="form-control" required name ="first_name" value ="{{ $admin->first_name }}">
                                            <label for="first_name">{{__('message.First Name')}}</label>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <div class="input-field col s12">
                                            <input id ="lastname" type="text" class="form-control"  required name ="last_name" value ="{{ $admin->first_name }}">
                                            <label for="lastname">{{__('message.Last Name')}}</label>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <div class="input-field col s12">
                                            <input id ="job_title" type="text" class="form-control" required name ="job_title" value ="{{ $admin->first_name }}">
                                            <label for="job_title">{{__('message.Job Title')}}</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-peimary">{{ __('message.Submit')}}</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
