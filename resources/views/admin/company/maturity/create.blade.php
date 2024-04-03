@extends('admin.layouts.app')   

@section('title','Create Company Maturity')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{__('message.Create Company Maturity')}}</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.maturity.list')}}">{{__('message.Company Maturity')}}</a></li>
                            <li class="breadcrumb-item"><a href="#">{{__('message.Create Company Maturity')}}</a></li>
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
                                            <h4 class="card-title">{{ __('message.Create Company Maturity') }}</h4>
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
                                            <form action="{{ route('admin.maturity.store')}}" method="post">
                                                @csrf
                                                <div class="col s12">
                                                    <div class="input-field col s12">
                                                        <input type="text" class="form-control" required name="level_name">
                                                        <label> {{__('message.Company Maturity Name')}} </label>
                                                    </div>
                                                </div>
                                                <div class="col s12">
                                                    <div class="input-field col s12">
                                                        <input type="text" class="form-control" required name="description">
                                                        <label> {{__('message.Company Maturity Name')}} </label>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary "> {{ __('message.Submit') }}</button>
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
    </div>
</div>

@endsection
