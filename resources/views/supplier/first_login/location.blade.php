@extends('supplier.layouts.firstlogin')

@section('title','New-Location')

@section('content')

    <div class="main_cmp_data">
        <div class="center_cmp_data">
            <form action="{{route('supplier.first.store.location')}}" method ="post" enctype="multipart/form-data">
                    @csrf
                    <h2>Let’s start!</h2>
                    <p>Enter the company data</p>

                    {{ status()}}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="profile_img">
                                <img id ="showimage" src="{{ asset('images/client/profile/profile_pic.png')}}" class="rounded-circle" alt="Cinque Terre" width="200" height="200">
                                <p id ="filename"></p>
                                <div class="col-xs-3">
                                        <input type="file" name="image" onchange="showPreviewOne(event)"/>
                                </div>
                                @error('image') <span class="text-danger"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 style= "padding-top:10%" > Supplier Comapny Name :- {{ $supplier->suppliercreator->company->name }} </h5>
                            <h6 style= "padding-top:5%" > Comapny CIF ID:- {{ $supplier->suppliercreator->company->cif }} </h6>
                        </div>
                    </div>

                    <div class="form-group">
                        @error('lname')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Company Name"  value ="{{@old('lname')}}">
                        <label for="lname">{{ __('message.Location Name')}}</label>
                    </div>

                    <div class="form-group">
                        @error('country')
                            <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <select class="form-control selecttwodropdown" name="country" id ="country" >
                            @foreach($countries as $country)
                                    <option value="{{ $country->id}}" {{ (@old("country") == $country->id ? "selected":"") }} >{{ $country->name}}</option>
                            @endforeach
                        </select>
                        <label for="country">{{__('message.Country')}}:</label>
                    </div>

                    <div class="form-group">
                            @error('state')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <select class="form-control @error('state') is-invalid @enderror selecttwodropdown" id ="state" name="state">
                            </select>
                            <label for="state">State</label>
                    </div>

                    <div class="form-group">
                            @error('city')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        <select class="form-control @error('city') is-invalid @enderror selecttwodropdown" id ="city" name="city">
                        </select>
                        <label for="city">City</label>
                    </div>
                    <div class="form-group">
                        @error('address')
                            <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="text" class="form-control" id="address" name ="address" placeholder="Address"  value ="{{@old('address')}}">
                        <label for="address">Address</label>
                    </div>
                    <div class="form-group">
                        @error('postal_code')
                            <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="number" class="form-control" id="postal_code" name ="postal_code" placeholder="Postal Code"  value ="{{@old('postal_code')}}">
                        <label for="postal_code">Postal Code</label>
                    </div>
                    <div class="form-group">
                        @error('category')
                            <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <select class="form-control selecttwodropdown" id="category" name ="category" >
                            @foreach($sectors as $sector)
                                <option value="{{$sector->id }}"  {{ (@old("category") == $sector->id ? "selected":"") }}>{{$sector->title}}</option>
                            @endforeach
                        </select>
                        <label for="category">Company Category</label>
                    </div>
                    <div class="form-group">

                        <select class="form-control selecttwodropdown" id="lsize" name ="lsize">
                            @foreach($sizes as $size)
                                <option value="{{$size->id }}"  {{ (@old("lsize") == $size->id ? "selected":"") }}>{{$size->value}}</option>
                            @endforeach
                        </select>
                         <label for="csize">Company Size</label>

                    </div>
                    <div class="form-group">
                        <select class="form-control selecttwodropdown" id="maturity" name ="maturity">
                            @foreach($maturities as $maturity)
                                <option value="{{ $maturity->id }}"  {{ (@old("maturity") == $maturity->id ? "selected":"") }}>{{$maturity->level_name}}</option>
                            @endforeach
                        </select>
                        <label for="maturity">Madurity lavel</label>
                    </div>
                    <div class="form-group">
                        <select class="form-control selecttwodropdown" id="security" name ="security">
                            <option value="1" {{ (@old('security') == 1)?"selected":""}}>Yes</option>
                            <option value="0" {{ (@old('security') == 0)?"selected":""}}>No</option>
                        </select>
                        <label for="security">Security Department</label>
                    </div>
                    <div class="button_snd">
                        <button type="login" class="btn btn-primary">submit</button>
                        <!--<a href="{{ route('supplier.home')}}" class="btn btn-primary">cancel</a>-->
                    </div>
            </form>
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
