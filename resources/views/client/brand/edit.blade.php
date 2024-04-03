@extends('layouts.app')

@section('title','Edit Branding')

@section('content')
<div class="container">
   <h2 class="text-center">Add your Branding</h2>
   <h5 class="text-center">Do you want customize the platform apparence?</h5>
   <br>
   {{status()}}
   <form action="{{ route('client.update.brand',)}}" method="post" enctype="multipart/form-data">
      @csrf
   <div class="row">
      <div class="offset-md-3 col-md-3">
         <div class="profile_img">
            <img id ="showimage" src="{{ asset('images/client/brand'.'/'.$brand->brand_logo)}}" class="rounded-circle" alt="Cinque Terre" width="200" height="200">
         </div>
      </div>
      <div class="col-md-3">
         <div class="mt-5">
            <p class="text-center">Do you want add the company logo?</p>
            <p id ="filename"></p>
            <div class="col-xs-3">
                {{-- <div id="fileButton" onchange="showPreviewOne(event)" type="file" class="btn btn-generate-report btn-summary w-50"
            style="margin-top: .8rem; margin-bottom: 4rem" name="image" onchange="showPreviewOne(event)" > --}}
            <input class="file-brand-input" type="file" name="image" onchange="showPreviewOne(event)"/>
            {{-- </div> --}}

            </div>
            @error('image') <span class="text-danger"><strong>{{ $message }}</strong></span> @enderror
         </div>
      </div>
   </div>
   <br><br>
   <div class="row">
      <div class="col-md-4">
         <div class="p-3 mb-2 text-white" id="spcolor" style="background:{{$brand->primary_color}}"> primary color</div>
         <div class="p-3 mb-2 text-white" id ="sscolor"style="background:{{$brand->secondary_color}}">secondary color</div>
      </div>
      <div class="col-md-4">
         <p class="text-center">Primary color</p>
         {{-- <div class="row">
           <div class="p-3 m-2 col-md-2 bg-primary"></div>
           <div class="p-3 m-2 col-md-2 bg-info"></div>
           <div class="p-3 m-2 col-md-2 bg-danger"></div>
           <div class="p-3 m-2 col-md-2 bg-dark"></div>
         </div>
         <div class="row">
            <div class="p-3 m-2 col-md-2 bg-primary"></div>
            <div class="p-3 m-2 col-md-2 bg-info"></div>
            <div class="p-3 m-2 col-md-2 bg-danger"></div>
            <div class="p-3 m-2 col-md-2 bg-dark"></div>
          </div>  --}}
          <div class="row">
          <input type="color" id="pcolor"  name="pcolor" class="form-control offset-md-2 col-md-6" value="{{$brand->primary_color}}">
          </div>
      </div>
      <div class="col-md-4">
         <p class="text-center">secondary color</p>
         {{-- <div class="row">
           <div class="p-3 m-2 col-md-2 bg-primary"></div>
           <div class="p-3 m-2 col-md-2 bg-info"></div>
           <div class="p-3 m-2 col-md-2 bg-danger"></div>
           <div class="p-3 m-2 col-md-2 bg-dark"></div>
         </div>
         <div class="row">
            <div class="p-3 m-2 col-md-2 bg-primary"></div>
            <div class="p-3 m-2 col-md-2 bg-info"></div>
            <div class="p-3 m-2 col-md-2 bg-danger"></div>
            <div class="p-3 m-2 col-md-2 bg-dark"></div>
          </div>  --}}
          <div class="row">
            <input type="color" id ="scolor" name ="scolor" class="form-control offset-md-2 col-md-6 " value="{{$brand->secondary_color}}">
         </div>
      </div>
   </div>
   <br><br>
   <div class="row">
      <div class="offset-md-10 edit-brand">
         <button type="submit" class="btn btn-primary">{{ __('Save')}}</button>
      </div>
   </div>
   </form>
   <br><br>
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
$(document).ready(function(){
   $('#pcolor').on('change',function(){
      var pcolor = $(this).val();
      $('#spcolor').css('background',pcolor);
   })
   $('#scolor').on('change',function(){
      var scolor = $(this).val();
      $('#sscolor').css('background',scolor);
   })
});
</script>

@endsection
 {{-- @extends('layouts.app')

@section('title','Edit Branding')

@section('content')
<div class="container">
   {{status()}}
<form action="{{ route('client.update.brand',)}}" method="post" enctype="multipart/form-data">
                @csrf
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('message.Brand Details')}}
                </div>
                <div class="card-body">
                    @if(session('success')) <div class="alert alert-success"> {{ session('success')}}</div> @endif
                    @if(session('error')) <div class="alert alert-success"> {{ session('error')}}</div> @endif
                    <div class="form-group">
                        <label> {{ __('message.Primary Color')}} </label>
                        <input type="color" class="form-control" name ="pcolor" value ={{$brand->primary_color}}>
                    </div>
                    <div class="form-group">
                        <label> {{ __('message.Secondry Color')}} </label>
                        <input type="color" class="form-control" name ="scolor" value ={{$brand->secondary_color}}>
                    </div>
                    <div class="form-group">
                        <label> {{ __('message.Choose file')}}</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"  name ="image" id="customFile">
                            <label class="custom-file-label" for="customFile">{{ __('message.Choose file') }}</label>
                            @error('image')
                                <div class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
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
@endsection  --}}
