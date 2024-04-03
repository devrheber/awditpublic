
@extends('supplier.layouts.firstlogin')

@section('title','New-password')

@section('content')

<!--main content  -->
<div class="user_profile_data">

	<h2>Almost ready!</h2>
	<p>Please complete your profile</p>

	{{ status() }}

	<div class="row">

			<div class="col-md-4">
				<div class="profile_img">
				<form action="{{ route('supplier.first.store.profile') }}" method="post" enctype="multipart/form-data">
					@csrf
					<img id ="showimage" src="{{ asset('images/client/profile/profile_pic.png')}}" class="rounded-circle" alt="Cinque Terre" width="200" height="200">
					<p id ="filename"></p>
					<div class="col-xs-3">
				      	<input type="file" name="image" onchange="showPreviewOne(event)"/>
				    </div>
					@error('image') <span class="text-danger"><strong>{{ $message }}</strong></span> @enderror
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					@error('first_name') <span class="text-danger"><strong>{{ $message }}</strong></span> @enderror
					<input type="text" class="form-control" name ="first_name" id="first_name" value="{{@old('first_name')}}" placeholder="{{__('message.First Name')}}">
					<label for="first_name">{{__('message.First Name')}}</label>
				</div>
				<div class="form-group">
					@error('last_name') <span class="text-danger"><strong>{{ $message }}</strong></span> @enderror
					<input type="text" class="form-control" name ="last_name" id="last_name" value="{{@old('last_name')}}" placeholder="{{__('message.Last Name')}}">
					<label for="last_name">{{__('message.Last Name')}}</label>
				</div>
				<div class="form-group">
					@error('job_title') <span class="text-danger"><strong>{{ $message }}</strong></span> @enderror
					<input type="text" class="form-control"  name ="job_title" id="job_title" value="{{@old('job_title')}}" placeholder="{{__('message.Job Title')}}">
					<label for="job_title">{{__('message.Job Title')}}</label>
				</div>
				<div class="button_snd">
					<button type="submit" class="btn btn-primary">{{__('message.Submit')}}</button>
				</div>
				</form>
			</div>

	</div>
</div>

@endsection

@section('script')
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
