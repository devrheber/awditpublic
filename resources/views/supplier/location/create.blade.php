@extends('supplier.layouts.app')

@section('title','New-password')

@section('content')
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-4">
                <div class="profile_img">
                    <img id ="showimage" src="{{ asset('images/client/profile/profile_pic.png') }}" class="rounded-circle" alt="Cinque Terre" width="200" height="200">
                    <p id ="filename"></p>
                    <div class="col-xs-3">
                        <input type="file" name="image" onchange="showPreviewOne(event)"/>
                    </div>
                    @error('image') <span class="text-danger"><strong>{{ $message }}</strong></span> @enderror
                </div>
                <h5 style= "padding-top:10%" >Supplier Comapny Name <br> {{ $supplier->suppliercreator->company->name }} </h5>
                <h6 style= "padding-top:5%" > Comapny CIF ID: {{ $supplier->suppliercreator->company->cif }} </h6>
            </div>
            <div class="col-12 col-md-8 form-column my-4">
                <form action="{{route('supplier.location.store')}}" method ="post" enctype="multipart/form-data">
                    @csrf

                    {{ status() }}

                    <div class="form-group">
                        <label for="lname">{{ __('message.Location Name')}}</label>
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Company Name"  value ="{{@old('lname')}}">
                        @error('lname')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="country">{{__('message.Country')}}:</label>
                        <select class="form-control" name="country" id ="country" >
                            @foreach($countries as $country)
                                <option value="{{ $country->id}}" @if(old('country')== $country->id) Selected @endif"  >{{ $country->name}}</option>
                            @endforeach
                        </select>
                        @error('country')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="state">{{ __('message.state') }}</label>
                        <select class="form-control @error('state') is-invalid @enderror" id ="state" name="state">
                        </select>
                        @error('state')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="city">{{ __('message.city') }}</label>
                        <select class="form-control @error('city') is-invalid @enderror" id ="city" name="city">
                        </select>
                        @error('city')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">{{ __('message.address') }}</label>
                        <input type="text" class="form-control" id="address" name ="address" placeholder="Address"  value ="{{@old('address')}}">
                        @error('address')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="postal_code">{{ __('message.postal_code') }}</label>
                        <input type="number" class="form-control" id="postal_code" name ="postal_code" placeholder="Postal Code"  value ="{{@old('postal_code')}}">
                        @error('postal_code')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category">{{ __('message.company_sector') }}</label>
                        <select class="form-control" id="category" name ="category" >
                            @foreach($sectors as $sector)
                                <option value="{{$sector->id }}"  {{ (@old("category") == $sector->id ? "selected":"") }} >{{$sector->title}}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="csize">{{ __('message.company_size') }}</label>
                        <select class="form-control" id="lsize" name ="lsize">
                            @foreach($sizes as $size)
                                <option value="{{$size->id }}"  {{ (@old("lsize") == $size->id ? "selected":"") }}>{{$size->value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="maturity">{{ __('message.maturity_level') }}</label>
                        <select class="form-control" id="maturity" name ="maturity">
                            @foreach($maturities as $maturity)
                                <option value="{{ $maturity->id }}"  {{ (@old("maturity") == $maturity->id ? "selected":"") }} >{{$maturity->level_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="security">{{ __('message.security_department') }}</label>
                        <select class="form-control" id="security" name ="security">
                            <option value="1" {{ (@old("security") == 1? "selected":"") }}>{{ __('message.yes') }}</option>
                            <option value="0" {{ (@old("security") == 0 ? "selected":"") }}>{{ __('message.no') }}</option>
                        </select>
                    </div>
                    <div class="form-row my-4">
                        <div class="col">
                            <a href="{{ route('supplier.home')}}" class="form-button-secondary">{{ __('message.Cancel') }}</a>
                        </div>
                        <div class="col">
                            <button type="submit" class="form-button btn-block">{{ __('message.save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
$(document).ready(function()
{
	$( window ).load(function(){

		var countryID = $('#country').val();
		url = "{{ route('supplier.get.state',':id')}}";
		url = url.replace(':id',countryID);
		if(countryID){
			$.ajax({
				type:"GET",
				url:url,
				success:function(res){
					if(res){
						$("#state").empty();
						$("#state").append('<option>Select</option>');
						$.each(res,function(key,value){
							$("#state").append('<option value="'+value.id+'">'+value.name+'</option>');
						});
						var statevalue = "{{@old('state')}}";
						$.each(res,function(key,value){
							$('#state option[value="'+ statevalue +'"]').attr('selected','selected');
						});

					}else{
						$("#state").empty();
					}
				}
			});
		}else{
			$("#state").empty();
		}
		var statevalue = "{{@old('state')}}";
		url = "{{ route('supplier.get.city',':id')}}";
		url = url.replace(':id',statevalue);
		if(statevalue){
			$.ajax({
				type:"GET",
				url:url,
				success:function(res){
					console.log(res.length);
					if(res){
						$("#city").empty();
						$.each(res,function(key,value){
							$("#city").append('<option value="'+value.id+'">'+value.name+'</option>');
						});
						var cityvalue = "{{@old('city')}}";
						$.each(res,function(key,value){
							$('#city option[value="'+ cityvalue +'"]').attr('selected','selected');
						});

					}else{
						$("#city").empty();
					}
				}
			});
		}else{
			$("#city").empty();
		}
	});
    $('#country').change(function(){
    var countryID = $(this).val();
    url = "{{ route('supplier.get.state',':id')}}";
    url = url.replace(':id',countryID);
    if(countryID){
        $.ajax({
           type:"GET",
           url:url,
           success:function(res){
            if(res){
                $("#state").empty();
                $("#state").append('<option>Select</option>');
                $.each(res,function(key,value){
                    $("#state").append('<option value="'+value.id+'">'+value.name+'</option>');
                });

            }else{
               $("#state").empty();
            }
           }
        });
    }else{
        $("#state").empty();
        $("#city").empty();
    }
   });

   $('#state').on('change',function(){
    var stateID = $(this).val();
    url = "{{ route('supplier.get.city',':id')}}";
    url = url.replace(':id',stateID);
    if(stateID){
        $.ajax({
           type:"GET",
           url:url,
           success:function(res){
            console.log(res.length);
            if(res){
                $("#city").empty();
                $.each(res,function(key,value){
                    $("#city").append('<option value="'+value.id+'">'+value.name+'</option>');
                });

            }else{
               $("#city").empty();
            }
           }
        });
    }else{
        $("#city").empty();
    }

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
