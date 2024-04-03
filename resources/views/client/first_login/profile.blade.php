@extends('layouts.first_login')
@section('title','Profile')
@section('content')
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 form-column my-4">
                <form action="{{ route('client.first.store.profile') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-12 text-center">
                            <h2>{{ __('message.almost_ready') }}</h2>
                            <p>{{ __('message.please_complete_your_profile') }}</p>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success')}}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('success')}}
                        </div>
                    @endif

                    <div class="row justify-content-center">
                        <div class="col-12 row justify-content-center mb-4">
                            <div class="col-12 d-flex justify-content-center mb-4">
                                <img id="showimage" src="{{ asset('images/client/profile/profile_pic.png')}}" class="rounded-circle" alt="Cinque Terre" width="200" height="200">
                                <p id="filename"></p>
                            </div>
                            <div class="col-12">
                                <div class="custom-input-file text-center">
                                    <input type="file" id="fileInput" name="image" onchange="showPreviewOne(event)"/>
                                    <label for="fileInput" id="fileLabel">{{ __('message.choose_a_photo') }}</label><br>
                                    @error('image') <span class="text-danger"><strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="form-group">
                                <label for="first_name">{{__('message.First Name')}} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name ="first_name" id="first_name" value="{{@old('first_name')}}" placeholder="{{__('message.First Name')}}">
                                @error('first_name') <span class="text-danger"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="last_name">{{__('message.Last Name')}} <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" name ="last_name" id="last_name" value="{{@old('last_name')}}" placeholder="{{__('message.Last Name')}}">
                                @error('last_name') <span class="text-danger"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="job_title">{{__('message.Job Title')}} <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control"  name ="job_title" id="job_title" value="{{@old('job_title')}}" placeholder="{{__('message.Job Title')}}">
                                @error('job_title') <span class="text-danger"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                            <div class="form-row my-4">
                                <div class="col">
                                </div>
                                <div class="col">
                                    <button type="submit" class="form-button btn-block">{{ __('message.Submit') }}</button>
                                </div>
                            </div>
                        </div>
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
