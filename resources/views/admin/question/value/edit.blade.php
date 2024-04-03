@extends('admin.layouts.app')   

@section('title','Edit Question Value')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{__('message.Edit Question Value')}}</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.questionvalue.list')}}">{{__('message.Question Value')}}</a></li>
                            <li class="breadcrumb-item"><a href="#">{{__('message.Edit Question Value')}}</a></li>
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
                                            <h4 class="card-title">{{ __('message.Edit Question Value') }}</h4>
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
                                            <form action="{{ route('admin.questionvalue.update',$questionvalue->id)}}" method="post">
												@csrf
												@method('PUT')
                                                <div class="col s12">
                                                    <div class="input-field col s12">
                                                        <input type="number" class="form-control" id= "value" value ="{{ $questionvalue->value}}" name="value">
                                                        <label for ="value"> {{__('message.Question Value')}} </label>
                                                        @error('value')
                                                            <span class="text-danger"> <strong> {{ $message }} </strong> </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col s12">
                                                    <div class="input-field col s12">
                                                        <input type="text" class="form-control" id= "description" value ="{{ $questionvalue->description}}" name="description">
                                                        <label for ="description"> {{__('message.Description')}} </label>
                                                        @error('description')
                                                            <span class="text-danger"> <strong> {{ $message }} </strong> </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col s12">
                                                    <div class="input-field col s12">
                                                        <label>
                                                            <input type="checkbox" class="form-control"  @if($questionvalue->status ==1)checked @endif name="status">
                                                            <span> {{__('message.Status')}} </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col s12">
                                                        <div class="input-field col s12">
                                                            <button type="submit" class="btn btn-primary "> {{ __('message.Submit') }}</button>
                                                        </div>
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
            </div>
        </div>
    </div>
</div>

@endsection