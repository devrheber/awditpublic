@extends('layouts.first_login')

@section('title','create questionnarie')

@section('css')
<style>
	#questiondetails{
		display: none
	}
</style>
@endsection

@section('content')<div class="main_questionary_wrap">

	<div class="container">
		<div class="questionary_title">
			<h2>Questionnaire</h2>
			<p>Custom the questions to your needs</p>
			{{status()}}
			<form action="{{ route('client.questionnarie.store')}}" method="POST">
			@csrf
			<input type="hidden" name="temp_code" value="{{ $tempcode }}">
			<div class="row">
				<div class="col-md-12 search_question">
					<div class="input-group">
					    <input type="text" name ="name" class="form-control" id="questionnairename" placeholder="Questionary name" value="@if(Request::hasCookie('questionary_name')) {{Cookie::get('questionary_name') }} @endif">
					</div>
					<div class="text-danger" id ="question_name_error"></div>
					@error('name')
						<span class="text-danger"><strong>{{ $message}} </strong></span>
					@enderror
					 <h4>Filtering Questions</h4>
					 <p><span>1</span> Question (observations)</p>
					 <p><span>2</span> Question (observations)</p>
					 <p><span>3</span> Question (observations)</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 question_collapse_set">
					<div id="accordion" class="accordion">
				        <div class="card mb-0  ">
							@if($questions->count()>0)
								@php $i=1; @endphp
								<div class="showquestion">
								@foreach($questions as $question)
									<div class="row">
										<div class="col-md-8">
										<input type="hidden" name="questions[]" value="{{$question->question->id}}">
											<div class="card-header collapsed questiontitle">
												<a class="card-title">
															<span> {{ $i++ }}</span>
												{{ $question->question->name }} ({{$question->question->observation }})
												</a>
											</div>

											<div class="card-body collapsed" id="questiondetails">
												<p><strong>Based on :</strong> {{ $question->question->based_on}}</p>
												<p><strong>objective :</strong> {{ $question->question->objective}}</p>
												<p><strong>Requirements :</strong> @foreach($question->question->questionrequirement as $qreq) <p> {{ $qreq->requirements }} </p> @endforeach </p>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<select class="form-control selecttwodropdown" name ="question_value" id="question_value">
												@foreach($questionvalue as $qvalue)
													<option value="{{$qvalue->id}}" @if($question->question->value_id == $qvalue->id) selected @endif> {{ $qvalue->value}}({{$qvalue->description}}) </option>
												@endforeach
												</select>
											</div>
											<a href="{{ route('client.question.delete',$question->question->id )}}" class="btn btn-primary delet_que" id ="{{ $question->question->id }}" onclick="confirm('are you sure to delete this recored..?')">Delete</a>
											question_name_error	</div>
									</div>
								@endforeach
								</div>
							@endif

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
			// alert('rahul');
			$(this).siblings().slideToggle();
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
				$.ajax({
					type:"POST",
					url:"{{route('client.questionnarie.store')}}",
					data:{
						'_token':"{{csrf_token()}}",
						'name':qName,
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
