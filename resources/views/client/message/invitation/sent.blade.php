@extends('layouts.app')

@section('title','send new Invitaion')

@section('content')
    <div class="invite_sent_wrapper">
        <div class="row">
            @include('client.message.messagesidebar')
            <div class="message-right-container p-4">

			<div class="new_invite_right">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success')}}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error')}}
                    </div>
                @endif
				<div class="row">
					<div class="col-md-3">
						<div class="inner_left_nw_invite_img">
							<img src="{{ asset('images/client/profile').'/'.$user->image }}" alt ="">
						</div>
					</div>
					<div class="col-md-9">
						<form action="{{route('client.invitation.store')}}"  method="POST">
							@csrf
							<div class="form-group">
                                <input type="email" class="form-control" name ="emailaddnewsupplier" id="email" aria-describedby="emailHelp" value="{{ @old('email')}}" placeholder="Enter email">
								@error('emailaddnewsupplier') <span class="text-danger"> <strong> {{ $message }} </strong></span>@enderror
							</div>
							<div class="form-group">
							    <input type="text" class="form-control" name="idaddnewsupplier" id="supplierid" aria-describedby="IDHelp" value="{{@old('supplierid') }}" placeholder="Supplier ID">
								@error('idaddnewsupplier') <span class="text-danger"> <strong> {{ $message }} </strong></span>@enderror
							</div>
							<div class="form-group">
							    <input type="text" class="form-control" name ="nameaddnewsupplier" id="name" aria-describedby="nameHelp" value="{{ @old('name')}}" placeholder="Supplier name">
								@error('idaddnewsupplier') <span class="text-danger"> <strong> {{ $message }} </strong></span>@enderror
							</div>
							<div class="form-group">
							    <input type="text" class="form-control" name="cifaddnewsupplier" id="cif" value="{{ @old('cif')}}" aria-describedby="cifHelp" placeholder="Supplier CIF">
								@error('cifaddnewsupplier') <span class="text-danger"> <strong> {{ $message }} </strong></span>@enderror
							</div>
							<!-- <div class="form-group">
							    <textarea class="form-control" name="description"  rows="4" id="discription" placeholder="Supplier Discription"></textarea>
							</div>	 -->
							<a href="{{ route('client.invitation.sent')}}" class="btn btn-primary cancel_btn_invite">Cancel</a>
							<button type="submit" class="btn btn-primary send_btn_invite">Send</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
