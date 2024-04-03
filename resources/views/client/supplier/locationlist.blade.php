@extends('layouts.app')

@section('title','List suppliers') 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card"><div class="card-header">{{ __('message.Supplier Location') }} | {{__('message.Applied Filter')}} 
					<span id="loc_name"></span>
					<span id="loc_country"></span>
					<span id="loc_state"></span>
					<span id="loc_city"></span>
					<span id="loc_sector"></span>
					<span id="loc_size"></span>
					<span id="loc_maturity"></span>
					<span id="loc_security"></span>
					<button class="btn btn-danger float-right" onclick="window.location.reload();"><i class ="fa fa-trash"></i></button>
					<br>
					<div class="col-md-6">
						<label for="locationname"> Location name: </label>
						<select name="locationname" class ="applyselect2" id="locationname">
							<option value="">select</option>
							@foreach($locations as $location)
								<option value="{{ $location->location_name }}"> {{ $location->location_name }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-6">
						<label for="sector"> Category: </label>
						<select name="sector" class ="applyselect2" id="sector" >
							<option value="">select</option>
							@foreach($categories as $category)
								<option value="{{ $category->id }}"> {{ $category->title }}</option>
							@endforeach 
						</select>
					</div>
					<div class="col-md-6">
						<label for="size"> size: </label>
						<select name="size" class ="applyselect2" id="size" >
							<option value="">select</option>
							@foreach($sizese as $size)
								<option value="{{ $size->id }}"> {{ $size->value }}</option>
							@endforeach 
						</select>
					</div>
					<div class="col-md-6">
						<label for="locationname"> maturity: </label>
						<select name="maturity" class ="applyselect2" id="maturity">
							<option value="">select</option>
							@foreach($maturities as $maturity)
								<option value="{{ $maturity->id }}"> {{ $maturity->level_name }}</option>
							@endforeach 
						</select>
					</div>
					<div class="col-md-6">
						<label for="security"> security: </label>	
						<select name="security" class ="applyselect2" id="security">
							<option value="">select</option>
							<option value="1"> Yes </option>
							<option value="0"> NO </option>
						</select>	
					</div>
					<div class="col-md-6">
						<label for="country"> Country : </label>
						<select name="country" class ="applyselect2" id="country">
							<option value="">select</option>
							@foreach($Counties as $country)
								<option value="{{ $country->id }}"> {{ $country->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-6">
						<label for="state"> State: </label>
						<select name="state" class ="applyselect2" id="state" style ="width:80%">
							
						</select>
					</div>
					<div class="col-md-6">
						<label for="city"> City: </label>
						<select name="city" class ="applyselect2" id="city" style ="width:80%">
							
						</select>
					</div>
				</div>
					
					
                <div class ="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                    
                            </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered" id ="example"> 
                        <thead>
                            <tr>
								<th> {{ __('message.Serial Number')}}</th>
                                <th> {{ __('message.Location Name')}} </th>
                                <th> {{ __('message.Location Address')}}</th>
                                <th> {{ __('message.Location Category')}}</th>
                                <th> {{ __('message.Location Size')}} </th>
                                <th> {{ __('message.Location Maturity')}} </th>
                                <th> {{ __('message.Location Security')}} </th>
                            </tr>
                        </thead>
                        <tbody id ="tabledata"> 
                            @php 
                                $i =1 ;
                            @endphp
							@foreach($locations as $location)
							<tr>
								<td>{{ $i++ }}</td>
								<td>{{ $location->location_name}}</td>
								<td>{{ $location->getFullAddress()}}</td>
								<td>{{ $location->category->title}}</td>
								<td>{{ $location->size->value}}</td>
								<td>{{ $location->locationmaturity->level_name}}</td>
								<td>@if($location->security == 1) Yes @else No @endif</td>

							</tr>
							@endforeach
	
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function(){
	
	// apply seelct2  class
	$('.applyselect2').select2();

	// apply the datatable 
	$('#example').dataTable();
	
	// show a state of the selected country
    $('#country').change(function(){
	var counrty = $('#counrty').val();
	var countryID = $(this).val();
    url = "{{ route('client.get.state',':id')}}";
	url = url.replace(':id',countryID);
	// $.ajax({
	// 	type:"post",
	// 	url:"{{ route('supplier.location.filter')}}",
	// 	data :{
	// 		"_token":"{{ csrf_token() }}",
	// 		counrty:counrty,
	// 	},
	// 	success:function(data){	
	// 		console.log(data);
	// 	}
	// });
    if(countryID){
        $.ajax({
           type:"GET",
           url:url,
           success:function(res){     
			   console.log(res);          
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
	
   //  show a city of the selectd states
   	$('#state').on('change',function(){
		var counrty = $('#counrty').val();
    	var stateID = $(this).val();
    	url = "{{ route('client.get.city',':id')}}";
   		url = url.replace(':id',stateID);
    	if(stateID){
			$.ajax({
			type:"GET",
			url:url,
			success:function(res){      
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

  
	$('#locationname, #counrty, #state, #city, #sector, #size, #maturity, #security',).on('change', function(){
		
		var locationname = $('#locationname').val();
		var counrty = $('#counrty').val();
		var state = $('#state').val();
		var city = $('#city').val();
		var sector = $('#sector').val();
		var size = $('#size').val();
		var maturity = $('#maturity').val();
		var security = $('#security').val();
		 
		var url = "{{ route('supplier.location.filter')}}";

		
		$.ajax({
			type:"post",
			url:url,
			data :{
				"_token":"{{ csrf_token() }}",
				locationname:locationname,
				counrty:counrty,
				state:state,
				city:state,
				sector:sector,
				size:size,
				maturity:maturity,
				security:security,
			},
			success:function(data)
			{

				if(data!=null)
				{	
					var string="";
					for(var i = 0;i< data.length;i++)
					{
						if(data[i].security ==1){
							sec = '{{ __("message.Yes")}}';
						}else if(data[i].security ==0){
							sec = '{{ __("message.No")}}';
						}
						var string =string + '<tr>'+
							'<td>'+ (i+1)+'</td>'+
							'<td>'+ data[i].location_name+'</td>'+
							'<td>'+ data[i].address+'</td>'+
							'<td>'+ data[i].category.title+'</td>'+
							'<td>'+ data[i].size.value+'</td>'+
							'<td>'+ data[i].locationmaturity.level_name+'</td>'+
							'<td>'+ sec +'</td>'+
						'</tr>';
					}
					$('#tabledata').html(string);
				}

				if(locationname!=""){ $('#loc_name').text(">> {{__('message.Location Name')}}"); }
				if(counrty!=""){$('#loc_country').text(">> {{__('message.Country')}}");}
				if(state!=""){$('#loc_state').text(">> {{__('message.State')}}");}
				if(city!=""){$('#loc_city').text(">> {{__('message.City')}}");}
				if(sector!=""){$('#loc_sector').text(">> {{__('message.Category')}}");}
				if(size!=""){$('#loc_size').text(">> {{__('message.Size')}}");}
				if(maturity!=""){$('#loc_maturity').text(">> {{__('message.Maturity')}}");}
				if(security!=""){$('#loc_security').text(">> {{__('message.Security')}}");}

			}
		});
		
	});
});
</script>
@endsection