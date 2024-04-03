@extends('layouts.first_login')
@section('title','create-company')
@section('content')
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 form-column my-4">
                <form action="{{route('client.first.company.store')}}" method ="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2>{{ __('message.lets_start') }}</h2>
                            <p>{{ __('message.complete_company_data') }}</p>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success')}}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error')}}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="cname">{{ __('message.Company Name')}}</label>
                        <input type="text" class="form-control" id="cname" name="cname" placeholder="{{ __('message.Company Name')}}"  value ="{{@old('cname')}}" >
                        @error('cname')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cif">{{__('message.Common Intermediate Format')}}</label>
                        <input type="text" class="form-control" id="cif" name ="cif" placeholder="CIF"  value ="{{@old('cif')}}">
                        @error('cif')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="country">{{__('message.Country')}}:</label>
                        <select class="form-control selecttwodropdown" name="country" id ="country" >
                            @foreach($countries as $country)
                                <option value="{{ $country->id}}">{{ $country->name}}</option>
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
                        <select class="form-control @error('state') is-invalid @enderror selecttwodropdown" id ="state" name="state">
                        </select>
                        @error('state')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="city">{{ __('message.city') }}</label>
                        <select class="form-control @error('city') is-invalid @enderror selecttwodropdown" id ="city" name="city">
                        </select>
                        @error('city')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">{{ __('message.address') }}</label>
                        <input type="text" class="form-control" id="address" name ="address" placeholder="{{ __('message.address') }}"  value ="{{@old('address')}}">
                        @error('address')
                        <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="postal_code">{{ __('message.postal_code') }}</label>
                        <input type="number" class="form-control" id="postal_code" name ="postal_code" placeholder="{{ __('message.postal_code') }}"  value ="{{@old('postal_code')}}">
                        @error('postal_code')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="csector">{{ __('message.company_sector') }}</label>
                        <select class="form-control selecttwodropdown" id="csector"  name ="csector[]" multiple="multiple">
                            @foreach($sectors as $sector)
                                <option value="{{$sector->id }}">{{$sector->title}}</option>
                            @endforeach
                        </select>
                        @error('csector')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="csize">{{ __('message.company_size') }}</label>
                        <select class="form-control select-option selecttwodropdown" id="csize" name ="csize">
                            @foreach($sizes as $size)
                                <option value="{{$size->id }}" style="width:50px">{{$size->value}}({{$size->description}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="maturity">{{ __('message.maturity_level') }}</label>
                        <select class="form-control selecttwodropdown" id="maturity" name ="maturity">
                            @foreach($maturities as $maturity)
                                <option value="{{ $maturity->id }}">{{$maturity->level_name}}({{$maturity->description }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="security">{{ __('message.security_department') }}</label>
                        <select class="form-control selecttwodropdown" id="security" name ="security">
                            <option value="1">{{ __('message.Yes') }}</option>
                            <option value="0">{{ __('message.No') }}</option>
                        </select>
                    </div>
                    <div class="form-row my-4">
                        <div class="col">
                        </div>
                        <div class="col">
                            <button type="submit" class="form-button btn-block">{{ __('message.start') }}</button>
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
    url = "{{ route('client.get.state',':id')}}";
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
    url = "{{ route('client.get.city',':id')}}";
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
@endsection
