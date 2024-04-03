@extends('supplier.layouts.app')

@section('title','User Profile')

@section('content')
<div class="container">
    <div class="row view_profile_table_user">
        <div class="col-md-12">
            <x-view-profile-edit-card title="{{ __('message.my_profile') }}" dataTarget="" :showBorderBottom="false" class="no-padding mb-4" noIconOrButton="true">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('message.photo') }}</th>
                                    <th scope="col">{{ __("message.name") }}</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">{{ __("message.Job Title") }}</th>
                                    <th scope="col">{{ __("message.Action") }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr id ="show_details">
                                    <td><img src=" {{ asset('images/supplier/profile').'/'.$supplier->image }}"></td>
                                    <td>{{ $supplier->getSupplierFullName()}}</td>
                                    <td>{{ $supplier->email}}</td>
                                    <td>{{ $supplier->job_title}}</td>
                                    <td>
                                        <a href="{{ route('supplier.change.password')}}" class="btn btn-primary">{{__('message.Change Password')}}</a>
                                        <a id="show" href="#"><i class="fa fa-pencil"></i></a>
                                    </td>
                                </tr>
                                <form action="{{ route('supplier.profile.update')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <tr id="edit_cl_prf" class="upload_image">
                                        <td>
                                            <img id ="showimage" src=" {{ asset('images/supplier/profile').'/'.$supplier->image }}">
                                            <input type="file" onchange="showPreviewOne(event)" name="image" id="image">
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <label> {{ __('message.First Name')}} </label>
                                                <input type="text" class="form-control" name ="first_name" value ="{{ $supplier->first_name }}" >
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <label> {{ __('message.Last Name')}} </label>
                                                <input type="text" class="form-control" name ="last_name" value ="{{ $supplier->last_name }}" >
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <label> {{ __('message.Job Title')}}</label>
                                                <input type="text" class="form-control" name ="job_title" value ="{{ $supplier->job_title }}" >
                                            </div>
                                        </td>
                                        <td><button type="submit" class="btn btn-primary">{{ __('message.save') }}</button>
                                            <a href="#" id="hide"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </x-view-profile-edit-card>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <x-view-profile-edit-card title="{{ __('message.locations') }}" dataTarget="" :showBorderBottom="false" class="no-padding mb-4" noIconOrButton="true">
                <div class="col-12">
                    <div class="row mb-4">
                        <div class="col-12">
                            <a href="{{ route('supplier.location.create')}}" class="btn btn-modal-update float-right">{{ __('message.new_location') }}</a>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($locations as $location)
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src=" {{ asset('images/supplier/location').'/'.$location->location_image }}" classs="rounded-circle">
                                    </div>
                                    <div class="col-md-3">
                                        <h2> {{$location->location_name}}</h2>
                                        @if($location->status == 0)<p>Pending to varification</p>@endif
                                        <h4> {{$supplier->suppliercreator->company->name}}</h4>
                                        <h6> {{$supplier->suppliercreator->company->cif }}</h6>
                                        <a href="{{route('supplier.location.edit',$location->id)}}" class="btn btn-block btn-modal-update">{{ __('message.edit') }}</a>
                                    </div>
                                    <div class="col-md-6">
                                        <table>
                                            <tr>
                                                <td><strong>{{ __('message.Country') }}</strong></td>
                                                <td>{{ $location->country->name}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ __('message.address') }}</strong></td>
                                                <td>{{ $location->address}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ __('message.company_sector') }}</strong></td>
                                                <td>{{ $location->category->title}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ __('message.company_size') }}</strong></td>
                                                <td>{{ $location->size->value}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ __('message.maturity_level') }}</strong></td>
                                                <td>{{ $location->locationmaturity->level_name}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ __('message.security_department') }}</strong></td>
                                                <td>{{ $location->security == 1 ? __('message.yes') : __('message.no') }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-12 col-md-4">

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </x-view-profile-edit-card>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>



<script>
$(document).ready(function(){
  $("#role_hide").click(function(){
    $("#add_row_roles").hide();
  });
  $("#role_show").click(function(){
    $("#add_row_roles").show();
  });
});
</script>
<script>
$(document).ready(function(){
  $("#hide").click(function(){
    $("#edit_cl_prf").hide();
    $('#show_details').show();
  });
  $("#show").click(function(){
    $("#edit_cl_prf").show();
    $('#show_details').hide();
  });
});
</script>
<script>
	function showPreviewOne(event){
		if(event.target.files.length > 0){
			let src = URL.createObjectURL(event.target.files[0]);
			let preview = document.getElementById("showimage");
			preview.src = src;
			preview.style.display = "block";
		}
	}
</script>

@endsection














<!-- @section('content')
<div class="container">
    {{ status()}}
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    {{__('Profile Image')}}

                </div>
                <div class="card-body">
                    <img src=" {{ asset('images/supplier/profile').'/'.$supplier->image }}" alt="" srcset="" width="100%" height="250userspx">
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Profile Details')}}
                    <a href="{{ route('supplier.profile.edit')}}" class="btn btn-primary float-right" data-toggle="tooltip" data-placement="bottom" title="Edit Profile"><i class ="fa fa-edit"></i></a>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label> First Name </label>
                        <input type="text" class="form-control" readonly name ="first_name" value ="{{ $supplier->first_name }}" >
                    </div>
                    <div class="form-group">
                        <label> Last Name </label>
                        <input type="text" class="form-control" readonly name ="last_name" value ="{{ $supplier->last_name }}" >
                    </div>
                    <div class="form-group">
                        <label> Job Title</label>
                        <input type="text" class="form-control" readonly name ="job_title" value ="{{ $supplier->job_title }}" >
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- @endsection

@section('script')
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
@endsection -->
