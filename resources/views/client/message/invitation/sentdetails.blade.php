@extends('layouts.app')

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
            @include('client.message.messagesidebar')
            <div class="message-right-container p-4">
                <div class="read_invite_set">
                    <a href="{{route('client.invitation.sent')}}"><i class="fa fa-chevron-left"></i> {{ __('message.back') }}</a>
                    <div class="row read_invite_set_row">
                        <div class="col-md-6">
                            <div class="read_invite_profile">
                                <div class="read_invite_profile_img">
                                    <img src="{{ asset('images/supplier/profile').'/'.$suppliers->image }}">
                                </div>
                                <div class="read_invite_content">
                                    <h3><b> {{ __('message.Client') }} </b> - Location</h3>
                                    <p>{{ __('message.to') }}: {{ $suppliers->email}} </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="read_invite_right">
                                <div class="read_invite_date">
                                    <h3> {{ date('d/m/Y',strtotime($suppliers->send_date))}}</h3>
                                </div>
                                <div class="read_invite_date">
                                    <a href="#" class="btn btn-primary resentbtn">{{ __('message.resend') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row read_invite_set_row1">
                        <div class="col-md-12">
                            <h2>{{ __('message.invitation_mail') }}</h2>
                            <form>
                                <textarea rows="6">{{ $suppliers->description}}</textarea>
                                <a href="#" class="btn btn-primary">{{ __('message.resend') }}</a>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- reply box start -->
                <div class="re-send-invite-set resentmail">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="re_send_invite_profile">
                                <div class="re_send_invite_profile_img">
                                    <img src="http://chessmafia.com/php/SEAT/images/client/profile/new_profile.png">
                                </div>
                                <div class="re_send_invite_content">
                                    <h3><b> Supplier </b>- Location</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <form>
                                <textarea placeholder="Default text for invitation" rows="6"></textarea>
                                <a href="#" class="btn btn-primary cancel_btn_re">Cancel</a>
                                <a href="#" class="btn btn-primary send_btn_re">Send</a>
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
	$('.resentbtn').click(function(){
		$('.resentmail').css('display','block');
	});
});
</script>
@endsection
