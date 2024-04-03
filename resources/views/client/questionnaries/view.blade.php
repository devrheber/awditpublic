@extends('layouts.app')

@section('title','view questionnarie')

@section('css')
<style>
#questiondetails
{
	display:none;
}
</style>
@endsection

@section('content')
<div class="main_questionary_wrap">
	<div class="container">
		<div class="questionary_title">
			<h2>{{ $questionnary->name }}
				@can('update questionnaire')
					<a href="{{ route('client.questionnarie.edit',$questionnary->id)}}" class ="btn btn-info">Edit</a>
				@endcan
			</h2>

				{{status()}}
			<div class="row">
				<div class="col-md-12 search_question">
                    <h4>{{ __('message.filtering_questions') }}</h4>
                    <p><span>1</span> {{ __('message.question') }} ({{ __('message.observations') }})</p>
                    <p><span>2</span> {{ __('message.question') }} ({{ __('message.observations') }})</p>
                    <p><span>3</span> {{ __('message.question') }} ({{ __('message.observations') }})</p>
				</div>
			</div>
			@php
				$i=1;
			@endphp
			<div class="row">
				<div class="col-md-12 question_collapse_set">
					<div id="accordion" class="accordion">
				      <div class="card mb-0">
							@foreach($qdetails as $key => $value)
								Group Name : {{ getGroupName($key)->group_name}}
								@foreach($value as $questiongroup)
								<div class="row">
									<div class="col-md-12">
										<div class="card-header collapsed questiontitle">
											<div class ="row">
												<div class="col-md-9">
													<a class="card-title" >
														<span> {{ $i++}} </span>
														{{ $questiongroup->name }}({{ $questiongroup->observation}})
													</a>
												</div>
												<div class="col-md-2 	">
													<b>{{$questiongroup->questionvalue->value }} ({{$questiongroup->questionvalue->description}})</b>
												</div>
												<div class="col-md-1" >
													<strong></strong>
												</div>
											</div>
										</div>
										<div class="card-body collapsed" id="questiondetails">
											<p><strong>Based on : </strong>{{ $questiongroup->based_on}}</p>
											<p><strong>objective :</strong>  {{ $questiongroup->objective }}</p>
											<p><strong>Requirements : </strong> @foreach($questiongroup->questionrequirement as $qreq) {{ $qreq->requirements }} @endforeach </p>
										</div>
									</div>
								</div>
								@endforeach
							@endforeach
						</div>
						<div class="row que_btn_set">
				        	<div class="col-md-6 main_question_rht_btn">
								@can('delete questionnaire')
				         		<a href="{{ route('client.questionnarie.delete',$questionnary->id)}}" onclick="return confirm('are you sure to delete this questionnaire...??')" class="btn btn-primary cancel_question">Delete</a>
								@endcan
				            @can('enable questionnaire')
									<a href="{{ route('client.questionnarie.status',$questionnary->id)}}" class="btn btn-primary save_question">@if($questionnary->status == 0) Active @else Disabled  @endif</a>
								@endcan
							</div>
				      </div>
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
	$('.questiontitle').click(function(){
		$(this).siblings().slideToggle();
	});
});
</script>
@endsection
