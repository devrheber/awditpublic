@extends('layouts.app')

@section('title','import questionnarie')

@section('css')
<style>
	#questiondetails{
		display: none
	}
</style>
@endsection

@section('content')
<div class="main_questionary_wrap">
	<div class="container">
		<div class="questionary_title">
			<h2>Questionnaire</h2>
			<p>Custom the questions to your needs</p>
			<div class="alert alert-success d-none" id="successmsg"></div>
			<div class="alert alert-danger d-none" id="errormsg"></div>
			<form action="{{ route('client.save.import')}}" method="POST">
			@csrf
			<div class="row">
				<div class="col-md-12 search_question">
					<div class="input-group">
					    <input type="text" name ="name" class="form-control" id="questionnairename"  placeholder="Questionary name" value ="{{ $questionnaire->name }}">
					 </div>
					 <div class="text-danger" id ="question_name_error"></div>
					 @error('name')
						<span class="text-danger"><strong>{{ $message}} </strong></span>
					@enderror
					<input type="hidden" name="old_qid" id ="old_qid" value="{{$questionnaire->id}}">
                    <h4>{{ __('message.filtering_questions') }}</h4>
                    <p><span>1</span> {{ __('message.question') }} ({{ __('message.observations') }})</p>
                    <p><span>2</span> {{ __('message.question') }} ({{ __('message.observations') }})</p>
                    <p><span>3</span> {{ __('message.question') }} ({{ __('message.observations') }})</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 question_collapse_set">
					<div id="accordion" class="accordion">
				        <div class="card mb-0  ">

								@php $i=1; @endphp
								<div class="showquestion">
									@foreach($qdetails as $key => $value)
								Group Name : {{ getGroupName($key)->group_name}}
								@foreach($value as $questiongroup)
									<div class="row">
										<div class="col-md-8">
										<input type="hidden" name="questions[]" value="{{$questiongroup->id}}">
											<div class="card-header collapsed questiontitle">
												<a class="card-title">
													<span> {{ $i++ }}</span>
												{{ $questiongroup->name }} ({{$questiongroup->observation }})
												</a>
											</div>

											<div class="card-body collapsed" id="questiondetails">
												<p><strong>Based on :</strong> {{ $questiongroup->based_on}}</p>
												<p><strong>objective :</strong> {{ $questiongroup->objective}}</p>
												<p><strong>Requirements :</strong> @foreach($questiongroup->questionrequirement as $qreq) {{ $qreq->requirements }} @endforeach </p>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<select class="form-control" name ="question_value" id="question_value">
												@foreach($questionvalue as $qvalue)
													<option value="{{$qvalue->id}}" @if($questiongroup->value_id == $qvalue->id) selected @endif> {{ $qvalue->value}}({{ $qvalue->description}}) </option>
												@endforeach
												</select>
											</div>
											<a href="{{ route('client.question.delete',$questiongroup->id )}}" class="btn btn-primary delet_que" id ="{{ $questiongroup->id }}" onclick="return confirm('are you sure to delete this recored..?')">Delete</a>
										</div>
									</div>
									@endforeach
								@endforeach
								</div>
				            <div class="row que_btn_set">
				            	<div class="col-md-6">
										<button type ="button" id ="newquestion" class="btn btn-primary cancel_question">Add a new question</button>
				            	</div>
				            	<div class="col-md-6 main_question_rht_btn">
				            		<a type ="button" href="{{route('client.questionnaire.close')}}" class="btn btn-primary cancel_question">Cancel</a>
				            		<button type="submit" class="btn btn-primary save_question">Save</a>
				            	</div>
				            </div>
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
$(document).ready(function(){

	$('.questiontitle').click(function(){
		$(this).siblings().slideToggle();
	});

	// open the question group  modal
	$('#question_group').on('change',function(){
        if($(this).val() =="new")
        {
				$('#question_modal').modal('hide');
            $('#question_group_modal').modal('show');
        }
    });

	$('#group_form').submit(function(e){
        e.preventDefault();
        var action = $(this).attr('action');
        var name = $('#group_name').val();
        $.ajax({
            type :"POST",
            url : action,
            data:{
                "_token":"{{ csrf_token()}}",
                "group_name":name,
            },
            success:function(data)
				{
               if(data.success ==1)
               {
                  $('#successmsg').text(data.message);
               }
               $('#question_group_modal').modal('hide');
               $('#successmsg').removeClass('d-none');
               var string = '<option value="'+ data.data.id+'">'+data.data.group_name+'</option>';
               $('#question_group').append(string);
            },
            error:function(data)
            {
                console.log(data.responseJSON);

                var error = data.responseJSON.errors.group_name[0];
                $('#group_name_error').text(error);
                $('#question_group_modal').modal('show');
            }
        });
   });

	$('.requirements_btn').on('click',function(){
	   var string = '<div class="form-group">'+
					   '<input type="text" id ="requirements" name ="requirements[]" class="form-control" placeholder="Enter the Question equirements" autocomplete="off">'+
				   '</div>';
	   $('.add_new_requirements').append(string);
   });

	$('#newquestion').click(function(e){
		e.preventDefault();
		let value = $('#questionnairename').val();
		if( value == "")
		{
			alert('Enter the  Questionnaire Name');
		}
		else{
			var qName =$('#questionnairename').val();
			var old_qid = $('#old_qid').val();
			$.ajax({
				type:"POST",
				url:"{{route('client.save.import')}}",
				data:{
					'_token':"{{csrf_token()}}",
					'name':qName,
					'old_qid':old_qid,
				},
				success:function(data){
					url='{{ url("create-question")}}'+'/'+data.id ;
					window.location.href = url;
				},
				error:function(data){
					console.log(data.responseJSON);
					var error = data.responseJSON.errors.name[0];
					$('#question_name_error').text(error);
				}
			});
		}
	});
});
</script>
@endsection
