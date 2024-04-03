@extends('admin.layouts.app')   

@section('title','create roles')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{__('Create Role')}}</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin-roles.index')}}">{{__('Roles')}}</a></li>
                            <li class="breadcrumb-item"><a href="#">{{__('Create Roles')}}</a></li>
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
                                            <h4 class="card-title">{{ __('Create Role') }}</h4>
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
                                            <form action="{{ route('admin-roles.store')}}" method="post">
                                                @csrf
                                                <div class="col s12">
                                                    <div class="input-field col s12">
                                                        <input type="text" step="0.01" class="form-control" id="name" name="name">
                                                        <label for ="name"> {{__('Role Name')}} </label>
                                                        @error('name')
                                                            <span class="text-danger"> <strong> {{ $message }} </strong> </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col s12">
                                                    <div class="input-field col s12">
                                                        <label>
                                                            <input type="checkbox" class="form-control"  name="status">
                                                            <span> {{__('message.Status')}} </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th> Permission Name</th>
                                                            <th> <label>
                                                                <input type="checkbox" class="form-control"  id="all">
                                                                <span> All</span>
                                                            </label></th>
                                                        </tr>

                                                    </thead>
                                                   @foreach($permissions as $permission)
                                                    <tr>
                                                        <th>{{$permission->name}}</th>
                                                        <th> 
                                                            <label>
                                                                <input type="checkbox" class="form-control permission" value="{{$permission->id}}" name="permission[]">
                                                                <span> </span>
                                                            </label>
                                                        </th>
                                                    </tr>
                                                   @endforeach
                                                </table>
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

@section('script')
<script>
$(document).ready(function(){
  $("#all").change(function() {
		  $(".permission").prop( "checked", $(this).prop('checked'));
  });
});
</script>
@endsection
