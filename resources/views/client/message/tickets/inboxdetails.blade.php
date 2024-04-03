@extends('layouts.app')

@section('title','Send New Ticket')

@section('content')
<div class="invite_sent_wrapper">
  <div class="row">

    @include('client.message.messagesidebar')

		<div class="message-right-container p-4">
            <x-title-section title='apps' section='Messages' subtitle='Tickets' />
			<div class="read_invite_set">
				<a href="{{ route('client.ticket.inbox')}}">
            		<i class="fa fa-chevron-left"></i> {{ __('message.back') }}
        		</a>
				<br>{{ status() }}
				<div class="row read_invite_set_row">
					<div class="col-md-6">
						<div class="read_invite_profile">
							<div class="read_invite_profile_img">
								<img src="{{ asset('images/supplier/profile').'/'.$ticketinbox->ticketsender->image}}">
							</div>
							<div class="read_invite_content">
								<h3><b> {{ __('message.Supplier') }} </b>- {{ $ticketinbox->location->location_name}}</h3>
								<p>{{ __('message.to') }}: {{ $ticketinbox->ticketsender->email}} </p>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="read_invite_right">
							<div class="read_invite_date">
								<h3> {{ date('d/m/Y',strtotime($ticketinbox->created_at))}}</h3>
							</div>
                            <div class="read_invite_date">
                                <form action="{{ route('client.delete.inbox.tickets') }}" method="post">
                                    @csrf
                                    <input type="hidden" value="{{  $ticketinbox->id }}" name="ticket_id">
                                    <button type="submit" class="btn btn-primary">{{ __('message.delete') }}</button>
                                </form>
                            </div>
							@can ('reply ticket')
                                <div class="read_invite_date ">
                                    <a href="#" class="btn btn-primary replybtn">{{ __('message.resend') }}</a>
                                </div>
							@endcan
						</div>
					</div>
				</div>
        		<div class="row read_invite_set_row1">
					<div class="col-md-12">
						<h2>{{ __('message.subject') }}</h2>
						<form>
							@if($ticketinbox->ticket_type == 3)
							<div class="accept_location_data">
								<table class ="table table-borderless">
									<tbody>
										<tr>
											<td>
												Hello,
											</td>
										</tr>
										<tr>
											<td>
												I am {{$location->locationcreator->getSupplierFullName()}}. I'm a supplier of your company.
											</td>
										</tr>
										<tr>
											<td>
												I requesting to you, I'm created new location so please <a href="{{route('client.accept.location',['lid'=>$location->id])}}">Accept</a>  the my location which detail are :
											</td>
										</tr>
										<tr>
											<td>
												<table>
													<tr>
														<td>
															location name
														</td>
														<td>
															{{ $location->location_name}}
														</td>
													</tr>
													<tr>
														<td>
															location country
														</td>
														<td>
															{{ $location->country->name}}
														</td>
													</tr>
													<tr>
														<td>
															location state
														</td>
														<td>
															{{ $location->state->name}}
														</td>
													</tr>
													<tr>
														<td>
															location city
														</td>
														<td>
															{{ $location->city->name}}
														</td>
													</tr>
													<tr>
														<td>
															location category
														</td>
														<td>
															{{ $location->category->title}}
														</td>
													</tr>
													<tr>
														<td>
															location size
														</td>
														<td>
															{{ $location->size->value}}
														</td>
													</tr>
													<tr>
														<td>
															location maturity
														</td>
														<td>
															{{ $location->locationmaturity->level_name}}
														</td>
													</tr>
													<tr>
														<td>
															location security
														</td>
														<td>
															@if($location->security == 1 ) Yes @else No @endif
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							@else
								<textarea  rows ="8	" style="resize:none" readonly>{{ $ticketinbox->description }}</textarea>
							@endif

           			 	</form>
					</div>
				</div>
                <hr>
                {{-- replay section start--}}

                {{-- reply section end--}}
				<div class="row read_invite_set_row1 replybutton">
					@can ('reply ticket')
                        <div class="col-md-12">
                            <a href="#" class="btn btn-primary replybtn">{{ __('message.replay') }}</a>
                            @if($ticketinbox->status == 1)
                                <a href="{{ route('client.supplier.ticket.change.status', $ticketinbox->id) }}" class="btn btn-primary">{{ __('message.close') }}</a>
                            @endif
                        </div>
					@endcan
				</div>
                @foreach($replymessages as $reply)
                    <div class="reply_ticket_section mb-4" style="height: auto;">
                        <div class="row">
                            <div class="col-md-1">
                                <div class="read_invite_profile">
                                    <div class="read_invite_profile_img">
                                        <img src="{{ asset('images/client/profile').'/'.$reply->ticketsender->image}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-11">
                                <div class="read_invite_content">
                                    <h3><b> {{ __('message.Supplier') }} </b>- {{ $reply->location->location_name}}</h3>
                                    <p>{{ __('message.from') }}: {{ $reply->ticketsender->email}} </p>
                                </div>
                            </div>
                        </div>
                        <div class="row read_invite_set_row1">
                            <div class="col-md-12">
                                {{ $reply->description }}
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class ="reply_ticket_section d-none">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="read_invite_profile">
                                <div class="read_invite_profile_img">
                                    <img src="{{ asset('images/client/profile').'/'.$user->image}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="read_invite_content">
                                <h3><b> {{ __('message.Supplier') }} </b>- {{ $ticketinbox->location->location_name}}</h3>
                                <p>{{ __('message.to') }}: {{ $ticketinbox->ticketreceiver->email}} </p>
                            </div>
                        </div>
                    </div>
                    <div class="row read_invite_set_row1">
                        <div class="col-md-12">
                            <form action="{{ route('client.inbox.ticket.reply')}}" method ="post" enctype="multipart/form-data" >
                                @csrf
                                    <textarea rows="6"  name ="description" style="resize:none" placeholder ="write text..." required> </textarea>
                                @error('description')
                                    <div class="text-danger"><strong>{{ $message }}</strong></div>
                                @enderror
                                <input type="file" name="attach_doc" id="attach_doc">
                                <input type="hidden" name="location" value="{{ $ticketinbox->location_id }}">
                                <input type="hidden" name="ticket_type" value="{{ $ticketinbox->ticket_type}}">
                                <input type="hidden" name="ticekt_number" value ="{{ $ticketinbox->ticket_number}}">
                                <div class="form-group">
                                    <a href="#" class="btn btn-primary cancelbtn">{{ __('message.Cancel') }}</a>
                                    <button type ="submit" class="btn btn-primary">{{ __('message.send') }}</button>
                                </div>
                            </form>
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
  $('.replybtn').click(function(){
	$('.reply_ticket_section').removeClass('d-none');
	$('.replybutton').addClass('d-none');
  });
  $('.cancelbtn').click(function(){
	$('.reply_ticket_section').addClass('d-none');
	$('.replybutton').removeClass('d-none');
  });
});
</script>
<script type="text/javascript">
	@error('description')
	$(document).ready(function(){
		$('.reply_ticket_section').addClass('d-none');
	});
	@enderror
</script>
@endsection
