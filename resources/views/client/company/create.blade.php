@extends('layouts.app')

@section('title','Create Company')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('message.Create Company') }}</div>

                <div class="card-body">
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
                    <form action="{{ route('client.company.store')}}" method ="POST">
                        @csrf
                        <div class="form-group">
                            <label>{{ __('message.Company Name')}}:</label>
                            <input type="text" id ="cname" name ="cname" class="form-control @error('cname') is-invalid @enderror" value ="{{@old('cname')}}" placeholder="Enter the Company name">
                            @error('cname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{__('message.Common Intermediate Format')}}:</label>
                            <input type="number" id ="cif" name ="cif" class="form-control @error('cif') is-invalid @enderror" value ="{{@old('cif')}}" placeholder="Enter the CIF number">
                            @error('cif')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>mnamen>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label> {{__('message.State')}}:</label>
                            <select class="form-control @error('state') is-invalid @enderror" id ="state" name="state">     
                            </select>
                            @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label> {{__('message.City')}}:</label>
                            <select class="form-control @error('city') is-invalid @enderror" id ="city" name="city">     
                            </select>
                            @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label> {{__('message.Address')}} </label>
                            <input type="text" id ="address" class="form-control @error('address') is-invalid @enderror" name ="address" value ="{{@old('address')}}" placeholder="Enter the comapny address">
                            @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label> {{__('message.Postal Code')}} </label>
                            <input type="number"  id="postal_code" class="form-control @error('postal_code') is-invalid @enderror" name ="postal_code" value ="{{@old('postal_code')}}" placeholder="Enter the postal code">
                            @error('postal_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{__('message.Company Sector')}}:</label>
                            <select id ="csector" class="form-control @error('csector') is-invalid @enderror" name ="csector[]" multiple="multiple"> 
                                @foreach($sectors as $sector)
                                    <option value="{{$sector->id }}">{{$sector->title}}</option>
                                @endforeach
                            </select>
                            @error('csector')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{__('message.Company Size')}}:</label>
                            <select class="form-control" name ="csize">
                                @foreach($sizes as $size)
                                    <option value="{{$size->id }}">{{$size->value}}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="form-group">
                            <label> {{__('message.Maturity Level')}}:</label>
                            <select class="form-control" name="maturity">
                                @foreach($maturities as $maturity)
                                    <option value="{{ $maturity->id }}">{{$maturity->level_name}}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="form-group">
                            <label> {{__('message.Security Department')}}:</label>
                            <select class="form-control" name ="security">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block"> {{ __('message.Submit')}} </button>
                    </form>
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function()
{
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
