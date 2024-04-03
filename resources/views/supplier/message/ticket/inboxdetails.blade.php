@extends('supplier.layouts.app')

@section('title','sent invitation details')

@section('css')
<style>
.resentmail{
	display:none;
}
</style>
@endsection

@section('content')
    <div class="invite_sent_wrapper">
        <div class="row">
            @include('supplier.message.messagesidebar')
            <div class="message-right-container p-4">
                <div class="row">
                    <div class="col-12">
                        <div class="read_invite_set">
                            <a href="{{route('supplier.ticket.inbox')}}"><i class="fa fa-chevron-left"></i> {{ __('message.back') }}</a>
                            <br>{{ status() }}
                            <div class="row read_invite_set_row">
                                <div class="col-md-6">
                                    <div class="read_invite_profile">
                                        <div class="read_invite_profile_img">
                                            <img src="{{ asset('images/supplier/profile').'/'.$user->image}}">
                                        </div>
                                        <div class="read_invite_content">
                                            <h3><b>{{ __('message.Supplier') }}</b> - {{ $ticket->location->location_name}}</h3>
                                            <p>{{ __('message.from') }}: {{ $ticket->ticketsender->email}} </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="read_invite_right">
                                        <div class="read_invite_date">
                                            <h3> {{ date('d/m/Y',strtotime($ticket->created_at))}}</h3>
                                        </div>
                                        <div class="read_invite_date">
                                            <a href="#" class="btn btn-primary resentbtn">{{ __('message.resend') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row read_invite_set_row1">
                                <div class="col-md-12">
                                    <h2>{{ __('message.subject') }}</h2>
                                    <form>
                                        <textarea contenteditable="false" readonly rows="6">{{ $ticket->description}}</textarea>
                                        <a href="#" class="btn btn-primary replybtn">{{ __('message.replay') }}</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class ="reply_ticket_section d-none">
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="read_invite_profile">
                                        <div class="read_invite_profile_img">
                                            <img src="{{ asset('images/supplier/profile').'/'.$user->image}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-11">
                                    <div class="read_invite_content">
                                        <h3><b>{{ __('message.Supplier') }}</b>- {{ $ticket->location->location_name}}</h3>
                                        <p>{{ __('message.from') }}: {{ $ticket->ticketreceiver->email}} </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row read_invite_set_row1">
                                <div class="col-md-12">
                                    <form action="{{ route('supplier.ticket.inbox.reply')}}" method ="post" enctype="multipart/form-data" >
                                        @csrf
                                        <textarea rows="6"  name ="description" style="resize:none" placeholder ="write text..." required> </textarea>
                                        @error('description')
                                        <div class="text-danger"><strong>{{$message}}</strong></div>
                                        @enderror
                                        <input type="file" name="attach_doc" id="attach_doc">
                                        @error('attach_doc')
                                        <div class="text-danger"><strong>{{$message}}</strong></div>
                                        @enderror
                                        <input type="hidden" name="location" value="{{ $ticket->location_id }}">
                                        <input type="hidden" name="ticket_type" value="{{ $ticket->ticket_type}}">
                                        <input type="hidden" name="ticekt_number" value ="{{ $ticket->ticket_number}}">
                                        <div class="form-group">
                                            <a href="#" class="btn btn-primary cancelbtn">{{ __('message.Cancel') }}</a>
                                            <button type="submit" class="btn btn-primary">{{ __('message.send') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @foreach($replies as $reply)
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
@endsection
