@extends('supplier.layouts.app')

@section('title','Send New Ticket')

@section('content')
<div class="invite_sent_wrapper">
    <div class="row">
        @include('supplier.message.messagesidebar')
        <div class="message-right-container p-4">
            <div class="row">
                <div class="col-12 col-md-10">
                    <x-title-section title='apps' section="{{ __('message.messages') }}" subtitle="{{ __('message.tickets') }}"/>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    {{ status() }}
                </div>
                <div class="col-md-3">
                    <div class="inner_left_nw_invite_img">
                        <img src="{{ asset('images/supplier/profile').'/'.$user->image }}" alt ="">
                    </div>
                </div>
                <div class="col-md-9 form-column">
                    <form action="{{route('supplier.ticket.store')}}"  method="POST" enctype= multipart/form-data>
                        @csrf
                        <div class="form-group">
                            @if($locations->count()>0)
                                <select name="location" id="location" class ="selecttwodropdown form-control" >
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id}}">{{ $location->location_name}}</option>
                                    @endforeach
                                </select>
                            @else
                                <span class="text-danger"> <strong> No any Approved Location are available...!!</strong></span>
                            @endif
                            @error('location') <span class="text-danger"> <strong> {{ $message }} </strong></span>@enderror
                        </div>

                        <div class="form-group">
                            <select name="ticket_type" id="ticket_type" class ="form-control">
                                <option value="1">{{ __('message.support') }}</option>
                                <option value="2">{{ __('message.questionnaire') }}</option>
                                <option value="3">{{ __('message.verification') }}</option>
                            </select>
                            @error('ticket_type') <span class="text-danger"> <strong> {{ $message }} </strong></span>@enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name ="name" id="name" aria-describedby="nameHelp" value="{{ @old('name')}}" placeholder="{{ __('message.Supplier Name') }}e">
                            @error('name') <span class="text-danger"> <strong> {{ $message }} </strong></span>@enderror
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" name="description" id="discription" placeholder="{{ __('message.description') }}">{{@old('description')}}</textarea>
                            @error('description') <span class="text-danger"> <strong> {{ $message }} </strong></span>@enderror
                        </div>
                        <div class="form-group">
                            <input type="file" name="attach_doc" id="attach_doc">
                            @error('attach_doc') <span class="text-danger"> <strong> {{ $message }} </strong></span>@enderror
                        </div>
                        <div class="form-row my-4">
                            <div class="col">
                                <a href="{{ route('client.ticket.inbox')}}" class="form-button-secondary btn-block">{{ __('message.Cancel') }}</a>
                            </div>
                            <div class="col">
                                <button type="submit" class="form-button btn-block">{{ __('message.send') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection
