@extends('supplier.layouts.app')

@section('title','User Profile')

@section('content')
<div class="container">
<form action="{{ route('supplier.profile.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
    <div class="row justify-content-center">

        <div class="col-md-4">

            <div class="card">

                <div class="card-header">
                    {{__('Profile Image')}}
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <img  id ="showimage" src="{{ asset('images/supplier/profile').'/'.$supplier->image }}" alt="" srcset="" width="100%" height="250userspx">
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" onchange="showPreviewOne(event)" class="custom-file-input" name ="image" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Profile Details')}}

                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label> First Name </label>
                        <input type="text" class="form-control" required name ="first_name" value ="{{ $supplier->first_name }}" >
                    </div>
                    <div class="form-group">
                        <label> Last Name </label>
                        <input type="text" class="form-control" required  name ="last_name" value ="{{ $supplier->last_name }}" >
                    </div>
                    <div class="form-group">
                        <label> Job Title</label>
                        <input type="text" class="form-control" required name ="job_title" value ="{{ $supplier->job_title }}" >
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
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
