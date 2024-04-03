@extends('layouts.app')

@section('title','Questionnaire reminer	')

@section('content')
<div class="new_invite_wrapper">
	<div class="row">
		@include('client.message.messagesidebar')
		<div class="col-md-10">
			<div class="read_invite_set">
				<a href="{{route('client.questionnaire.reminder')}}"><i class="fa fa-chevron-left"></i>Back</a>
				{{ status()}}
				<div class="row read_invite_set_row">
					<div class="col-md-6">
						<div class="read_invite_profile">
							<div class="read_invite_profile_img">
								<img src="{{ asset('images/client/profile').'/'.$user->image}}" alt="" width="50px" height="50px">
							</div>
							<div class="read_invite_content">
								<h3><b> {{$supplier->receiver->first_name}} </b> -	{{ $supplier->location->location_name}}</h3>
								<p>To: {{ $supplier->receiver->email}} </p>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="read_invite_right">
							<div class="read_invite_date">
								<h3> {{ date('d/m/Y',strtotime($supplier->created_at))}}</h3>
							</div>
							<div class="read_invite_date">
								<a href="#" class="btn btn-primary">Resend</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row read_invite_set_row1">
				<div class="col-md-12">
					<h2>Subject</h2>
					<div class="resend-subject">
						<p>Hello {{$supplier->receiver->first_name}}.</p>
						<p>We want to remind you that you have not yet completed the questionnaire {{$supplier->questionnaire->name}}</p>
						<p>Do not hesitate to contact us if you need support or help.</p>
						<p>Sincerely, ({{$user->first_name}}), ({{$user->job_title}})</p>
						<p>From({{$user->company->name}}),
					</div>
					<form action="{{ route('client.send.reminder')}}" method="post">
						@csrf
						<input type="hidden" name="supplier_id" value="{{$supplier->supplier_id}}">
						<input type="hidden" name="client_id" value="{{$supplier->client_id}}">
						<input type="hidden" name="location_id" value="{{$supplier->location_id}}">
						<input type="hidden" name="questionnaire_id" value="{{$supplier->questionnaire_id}}">
						<input type="hidden" name="q_status" value="{{$supplier->answer_status}}">
						<button type="submit" class="btn btn-primary">Resend</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
