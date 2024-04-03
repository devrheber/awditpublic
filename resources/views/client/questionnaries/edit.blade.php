@extends('layouts.app')

@section('title','Edit questionnarie')
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
			<h2>{{ __('message.questionnaire') }}</h2>
			<p>{{ __('message.questionnaire_custom') }}</p>
			{{status()}}
			<form action="{{ route('client.questionnarie.update',$questionnaire->id)}}" method="POST">
			@csrf
			@method('PUT')
			<div class="row">
				<div class="col-md-12 search_question">
					<div class="input-group">
					    <input type="text" name ="name" class="form-control" placeholder="{{ __('message.Questionnaire Name') }}" value ="{{ $questionnaire->name }}">
					 </div>
					 @error('name')
						<span class="text-danger"><strong>{{ $message}} </strong></span>
					@enderror
					 <h4>{{ __('message.filtering_questions') }}</h4>
					 <p><span>1</span> {{ __('message.question') }} ({{ __('message.observations') }})</p>
					 <p><span>2</span> {{ __('message.question') }} ({{ __('message.observations') }})</p>
					 <p><span>3</span> {{ __('message.question') }} ({{ __('message.observations') }})</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 question_collapse_set">
					<div id="accordion" class="accordion">
				        <div class="card mb-0">
								@php $i=4; @endphp
								<div class="showquestion">
									@foreach($qdetails as $key => $value)
									{{ __('message.Group Name') }} : {{ getGroupName($key)->group_name}}
									@foreach($value as $questiongroup)

									<div class="row ">
										<div class="col-md-8">
										<input type="hidden" name="questions[]" value="{{$questiongroup->id}}">
											<div class="card-header pl-2 collapsed questiontitle">
												<a class="card-title">
													<span> {{ $i++ }}</span>
												{{ $questiongroup->name }} ({{$questiongroup->observation }})
												</a>
											</div>

											<div class="card-body collapsed" id="questiondetails">
												<p><strong>{{ __('message.question_based_on') }} :</strong> {{ $questiongroup->based_on}}</p>
												<p><strong>{{ __('message.objective') }}:</strong> {{ $questiongroup->objective}}</p>
												<p><strong>{{ __('message.requirement') }}:</strong> @foreach($questiongroup->questionrequirement as $qreq) {{ $qreq->requirements }} @endforeach </p>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<select class="form-control" name ="question_value[]" id="question_value">
												@foreach($questionvalue as $qvalue)
													<option value="{{$qvalue->id}}" @if($questiongroup->value_id == $qvalue->id) selected @endif> {{ $qvalue->value}}({{$qvalue->description}})</option>
												@endforeach
												</select>
											</div>
											<a href="{{ route('client.question.delete',$questiongroup->id )}}" class="btn btn-primary delet_que" id ="{{ $questiongroup->id }}" onclick="return confirm('are you sure to delete this recored..?')">{{ __('message.delete') }}</a>
										</div>
									</div>
									@endforeach
								@endforeach
								</div>
				            <div class="row que_btn_set">
				            	<div class="col-12 mb-4">
				            		<a href ="{{route('client.question.create',$questionnaire->id)}}" class="btn btn-block btn-primary add_new_question" >
										<i class="fa fa-plus"></i> {{ __('message.add_new_question') }}
									</a>
				            	</div>
				            	<div class="col-12 main_question_rht_btn">
				            		<a type ="button" href="{{route('client.questionnaire.close')}}" class="btn btn-primary cancel_question">{{ __('message.Cancel') }}</a>
				            		<button type="submit" class="btn btn-primary save_question">{{ __('message.save') }}</button>
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
		// alert('rahul');
		$(this).siblings().slideToggle();
	});
// 	$('#questionform').submit(function(){
// 		// let formdata =$(this).serialize();
// 		let name = $('#question').val();
// 		let observation = $('#observation').val();
// 		let based_on = $('#based_on').val();
// 		let objective = $('#objective').val();
// 		let requirements =$('#requirements').val();
// 		url = "{{ route('client.question.store')}}";
// 		alert(url);
// 		$.ajax({
// 			method:"post",
// 			url:url,
// 			data:{
// 				'_token':"{{ csrf_token() }}",
// 				'name':name,
// 				'observation':observation,
// 				'based_on': based_on,
// 				'objective':objective,
// 				'requirements':  requirements,
// 			},
// 			success:function(){
// 				console.log("success");
// 			},
// 		});
// 	});
// 	$('.requirements_btn').on('click',function(){

// 	   var string = '<div class="input_pp">'+
// 					   '<input type="text" id ="requirements" name ="requirements[]" class="form-control" placeholder="Enter the Question equirements" autocomplete="off">'+
// 				   '</div>';
// 	   $('.add_new_requirements').append(string);

//    });
});
</script>
@endsection
