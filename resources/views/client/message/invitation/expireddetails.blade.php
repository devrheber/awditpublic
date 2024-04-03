@extends('layouts.app')

@section('title','expired invitaion details')

@section('content')
<div class="new_invite_wrapper">
	<div class="row">

		@include('client.message.messagesidebar')

		<div class="col-md-10">
			<div class="read_invite_set">
				<a href="{{route('client.questionnaire.reminber')}}"><i class="fa fa-chevron-left"></i>Back</a>
				<div class="row read_invite_set_row">
					<div class="col-md-6">
						<div class="read_invite_profile">
							<div class="read_invite_profile_img">
								<img src="http://chessmafia.com/php/SEAT/images/client/profile/new_profile.png">
							</div>
							<div class="read_invite_content">
								<h3><b> Client </b>- Location</h3>
								<p>To: {{ $supplier->email}} </p>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="read_invite_right">
							<div class="read_invite_date">
								<h3> {{ date('d/m/Y',strtotime($supplier->send_date))}}</h3>
							</div>
							<div class="read_invite_date">
								<a href="#" class="btn btn-primary">In Avg.</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row read_invite_set_row1">
				<div class="col-md-12">
					<h2>Subject</h2>
						<form>
							<textarea rows="6">{{ $supplier->description}}</textarea>
						</form>
				</div>
			</div>

			<!-- 2nd invitation details  start -->
			@if($supplier->invitation_time == 2 || $supplier->invitation_time == 3 )
			<div class="re-send-invite-set">
				<div class="row">
					<div class="col-md-12">
						<div class="re_send_invite_profile">
							<div class="re_send_invite_profile_img">
								<img src="http://chessmafia.com/php/SEAT/images/client/profile/new_profile.png">
							</div>
							<div class="re_send_invite_content">
								<h3><b> Supplier </b>- Location <span class ="text-right">{{ date('d/m/Y',strtotime($supplier->second_send_date))}}</span> </h3>
								<p>To: {{ $supplier->email}} </p>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<form>
							<textarea placeholder="Default text for invitation" rows="6"></textarea>
						</form>
					</div>
				</div>
			</div>
			@endif
			<!--2nd invitation details end -->

			<!-- 3rd invitation details start -->
			@if($supplier->invitation_time == 3)
			<div class="re-send-invite-set">
				<div class="row">
					<div class="col-md-12">
						<div class="re_send_invite_profile">
							<div class="re_send_invite_profile_img">
								<img src="http://chessmafia.com/php/SEAT/images/client/profile/new_profile.png">
							</div>
							<div class="re_send_invite_content">
								<h3><b> Supplier </b>- Location <span class ="text-right">{{ date('d/m/Y',strtotime($supplier->second_send_date))}}</span></h3>
								<p>To: {{ $supplier->email}} </p>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<form>
							<textarea placeholder="Default text for invitation" rows="6"></textarea>
						</form>
					</div>
				</div>
			</div>
			@endif
			<!-- 3rd invitation details end -->
			<a href="{{ route('client.reinvitation',$supplier->id) }}" class="btn btn-primary">Resend</a>
		</div>
	</div>
</div>
@endsection
