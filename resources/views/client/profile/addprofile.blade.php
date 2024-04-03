@extends('layouts.app')

@section('title','User Profile')

@section('content')
<div class="container">
<form action="{{ route('client.profile.store')}}" method="post" enctype="multipart/form-data">
                @csrf
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> 
                    {{ __('message.Profile Details')}} 
                    <a href="{{ route('client.brand.add')}}" class="btn float-right">{{ __('message.Skip')}}</a>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label> {{ __('message.First Name')}} </label>
                        <input type="text" id="first_name" class="form-control @error('first_name') is-invalid @enderror"  name ="first_name">
                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> {{ __('message.Last Name')}} </label>
                        <input type="text" id ="last_name" class="form-control @error('last_name') is-invalid @enderror"   name ="last_name">
                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> {{ __('message.Job Title')}}</label>
                        <input type="text" id="job_title" class="form-control @error('job_title') is-invalid @enderror"  name ="job_title">
                        @error('job_title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> {{ __('message.Choose file')}}</label>
                        <div class="custom-file">
                            <input type="file" id ="image" class="custom-file-input @error('image') is-invalid @enderror" name ="image" id="customFile">
                            <label class="custom-file-label" for="customFile">{{ __('message.Choose file') }}</label>
                        </div>
                        @error('image')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('message.Add')}}</button>
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
@endsection