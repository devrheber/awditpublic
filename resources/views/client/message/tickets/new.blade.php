@extends('layouts.app')

@section('title','Send New Ticket')

@section('content')
<div class="invite_sent_wrapper">
  <div class="row">
    @include('client.message.messagesidebar')
		<div class="message-right-container p-4">
			<div class="new_invite_right">
				{{ status() }}
				<div class="row">
					<div class="col-md-3">
						<div class="inner_left_nw_invite_img">
							<img src="{{ asset('images/client/profile').'/'.$user->image }}" alt ="">
						</div>
					</div>
					<div class="col-md-9">
						<form action="{{route('client.ticket.new.store')}}"  method="POST" enctype= multipart/form-data>
							@csrf
							<div class="form-group">
								<select name="email" id="email" class ="selecttwodropdown form-control" >
                                    <option value="">{{ __('message.select_a_provider') }}</option>
									@foreach($suppliers as $supplier)
										<option value="{{ $supplier->id}}" {{ old("email") == $supplier->id ? "selected":"" }} >{{ $supplier->email}}</option>
									@endforeach
								</select>
								@error('email') <span class="text-danger"> <strong> {{ $message }} </strong></span>@enderror
							</div>

							<div class="form-group">
								<select name="location" id="location" class="selecttwodropdown form-control">
                                    <option value="">{{ __('message.select_a_location') }}</option>
								</select>
								@error('location') <span class="text-danger"> <strong> {{ $message }} </strong></span>@enderror
							</div>

							<div class="form-group">
								<select name="ticket_type" id="ticket_type" class ="form-control" >
									<option value="1" {{ old("ticket_type") ==1 ? "selected":"" }} >{{ __('message.support') }}</option>
									<option value="2" {{ old("ticket_type") == 2 ? "selected":"" }} >{{ __('message.questionnaire') }}</option>
									<option value="3" {{ old("emticket_typeail") == 3 ? "selected":"" }} >{{ __('message.verification') }}</option>
								</select>
								@error('ticket_type') <span class="text-danger"> <strong> {{ $message }} </strong></span>@enderror
							</div>

							<div class="form-group questionnaire d-none">
								<select name="questionnaire[]" id="questionnaire" class="selecttwodropdown form-control" multiple="multiple">
									@foreach($questionnaires as $questionnaire)
										<option value="{{ $questionnaire->id}}" >{{ $questionnaire->name	}}</option>
									@endforeach
								</select>
								@error('questionnaire') <span class="text-danger"> <strong> {{ $message }} </strong></span>@enderror
							</div>
							<div class="form-group">
							    <input type="text" class="form-control" name ="name" id="ticket_name" aria-describedby="nameHelp" value="{{ @old('name')}}" placeholder="Ticket Title">
								@error('name') <span class="text-danger"> <strong> {{ $message }} </strong></span>@enderror
							</div>

							<div class="form-group">
							    <textarea class="form-control summernote" name="description" rows="6" id="discription" placeholder="Supplier Discription">{{@old('description')}}@isset($observation) {{ $observation }}@endisset</textarea>
								@error('description') <span class="text-danger"> <strong> {{ $message }} </strong></span>@enderror
							</div>
							<div class="form-group">
								<input type="file" name="attach_doc" id="attach_doc">
								<br>
								@error('attach_doc') <span class="text-danger"> <strong> {{ $message }} </strong></span>@enderror
							</div>
							<a href="{{ route('client.ticket.inbox')}}" class="btn btn-primary cancel_btn_invite">Cancel</a>
							<button type="submit" class="btn btn-primary send_btn_invite">Send</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function(){
	$( window ).load(function(){
		var id = $('#email').val();
		url = "{{ route('client.ticket.get.location',':id')}}";
		url = url.replace(':id',id);
		if(id){
			$.ajax({
				type:"GET",
				url:url,
				success:function(res){
					console.log(res);
					if(res.success == 1){
						$("#location").empty();
						$("#location").append('<option>Selete</option>');
						$.each(res.data,function(key,value){
							$("#location").append('<option value="'+value.id+'"  {{ (@old("location") == '+value.id+' ? "selected":"") }} >'+value.location_name+'</option>');
						});
						var oldvalue = "{{@old('location')}}";
						$.each(res.data,function(key,value){
							$('#location option[value="'+ oldvalue +'"]').attr('selected','selected');
						});
					}else{
						$("#location").empty();
//						alert('Supplier has no any location avilable. And With Location You can\'t Send the Ticket');
//						 $('#location').remove($('span'));
//						 $("#location").after('<span class="text-danger"> <strong> Supplier has no any location is avilable</strong></span>');
					}
				}
			});
		}

		if($('#ticket_type').val() == 2)
		{
			$('.questionnaire').removeClass('d-none');
		}

	});
	$('#email').on('change',function(){
		var supplier = $(this).val();
		url = "{{ route('client.ticket.get.location',':id')}}";
		url = url.replace(':id',supplier);
		if(supplier){
			$.ajax({
				type:"GET",
				url:url,
				success:function(res){
					console.log(res);
					if(res.success == 1){
						$("#location").empty();
						$("#location").append('<option>{{ __('message.select_a_location') }}</option>');
						$.each(res.data,function(key,value){
							$("#location").append('<option value="'+value.id+'"  {{ (@old("location") == '+value.id+' ? "selected":"") }} >'+value.location_name+'</option>');
						});
						var oldvalue = "{{@old('location')}}";
						$.each(res.data,function(key,value){
							$('#location option[value="'+ oldvalue +'"]').attr('selected','selected');
						});
					}else{
						$("#location").empty();
						alert('{{ __('message.message_supplier_has_not_location') }}');
					}
				}
			});
		}else{
			$("#location").empty();
		}
   });
   $('#ticket_type').on('change',function(){
	if($(this).val() == 2)
	{
		$('.questionnaire').removeClass('d-none');
	}else{
		$('.questionnaire').addClass('d-none');
	}
   });
});
</script>
@endsection
