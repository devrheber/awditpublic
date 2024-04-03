@extends('layouts.first_login')
@section('title','Create Brand')
@section('content')
    <div class="container container-new-password">
        <div class="row align-items-center h-100">
            <div class="col-12 form-column my-4">
                <form action="{{ route('client.first.brand.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-12 text-center">
                            <h2>{{ __('message.Brand Details')}}</h2>
                            <p>{{ __('message.do_you_want_to_customize_the_platforms_appearance') }}</p>
                        </div>
                    </div>
                    @if(session('success')) <div class="alert alert-success"> {{ session('success')}}</div> @endif
                    @if(session('error')) <div class="alert alert-success"> {{ session('error')}}</div> @endif

                    <div class="row align-items-center mb-4">
                        <div class="col-12 col-md-6 d-flex justify-content-end">
                            <img id="showimage" src="{{ asset('images/client/profile/profile_pic.png')}}" alt="Cinque Terre" width="200" height="200">
                            <p id="filename"></p>
                        </div>
                        <div class="col-12 col-md-6 d-flex justify-content-start">
                            <div class="custom-input-file text-center">
                                <h5>¿Quieres agregar el logo de la empresa?</h5>
                                <input type="file" id="fileInput" name="image" onchange="showPreviewOne(event)"/>
                                <label for="fileInput" id="fileLabel">{{ __('message.choose_a_photo') }}</label><br>
                                @error('image') <span class="text-danger"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label> {{ __('message.primary_color')}} </label>
                                <input type="color" class="form-control" name ="pcolor">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label> {{ __('message.secondary_color')}} </label>
                                <input type="color" class="form-control" name ="scolor">
                            </div>
                        </div>
                    </div>

                    <div class="form-row my-4">
                        <div class="col">
                        </div>
                        <div class="col">
                            <button type="submit" class="form-button btn-block">{{ __('message.Submit') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
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
