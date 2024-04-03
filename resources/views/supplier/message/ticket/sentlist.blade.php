@extends('supplier.layouts.app')

@section('title','ticket sent list')

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
                <div class="row mb-4">
                    <div class="col-md-6">
                        <x-view-profile-edit-card title="{{ __('message.ticket_status') }}" dataTarget="" noIconOrButton="true"
                                                  :showBorderBottom="false" class="no-padding">
                            <table class="table w-100">
                                <thead>
                                <tr class="border-top: none">
                                    <th scope="col">{{ __('message.Status') }}</th>
                                    <th scope="col">{{ __('message.percentage') }} (%)</th>
                                    <th scope="col">{{ __('message.value') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="align-middle border-none">{{ __('message.open') }}</td>
                                    <td class="align-middle border-none">
                                        <x-progress-bar color="#61CE00" total="{{ round($per_open), 2 }}">
                                        </x-progress-bar>
                                    </td>
                                    <td class="align-middle border-none">{{ number_format($per_open), 2 }} %</td>
                                </tr>
                                <tr>
                                    <td class="align-middle border-none">{{ __('message.closed') }}</td>
                                    <td class="align-middle border-none">
                                        <x-progress-bar color="#E24042" total="{{ round($per_close, 2) }}">
                                        </x-progress-bar>
                                    </td>
                                    <td class="align-middle border-none">{{ number_format($per_close, 2) }} %</td>
                                </tr>
                                </tbody>
                            </table>
                        </x-view-profile-edit-card>
                    </div>
                    <div class="col-md-6">
                        <x-view-profile-edit-card title="{{ __('message.ticket_types') }}" dataTarget="" noIconOrButton="true"
                                                  :showBorderBottom="false" class="no-padding">
                            <table class="table w-100">
                                <thead>
                                <tr class="border-top: none">
                                    <th scope="col">{{ __('message.Status') }}</th>
                                    <th scope="col">{{ __('message.percentage') }} (%)</th>
                                    <th scope="col">{{ __('message.value') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="align-middle border-none">{{ __('message.support') }}</td>
                                    <td class="align-middle border-none">
                                        <x-progress-bar color="#3BD0AE" total="{{ round($per_support), 2 }}">
                                        </x-progress-bar>
                                    </td>
                                    <td class="align-middle border-none">{{ number_format($per_support), 2 }} %</td>
                                </tr>
                                <tr>
                                    <td class="align-middle border-none">{{ __('message.questionnaires') }}</td>
                                    <td class="align-middle border-none">
                                        <x-progress-bar color="#38BAF2" total="{{ round($per_questionnaires, 2) }}">
                                        </x-progress-bar>
                                    </td>
                                    <td class="align-middle border-none">{{ number_format($per_questionnaires, 2) }} %
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle border-none">{{ __('message.verification') }}</td>
                                    <td class="align-middle border-none">
                                        <x-progress-bar color="#B638E1" total="{{ round($per_verification, 2) }}">
                                        </x-progress-bar>
                                    </td>
                                    <td class="align-middle border-none">{{ number_format($per_verification, 2) }} %
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </x-view-profile-edit-card>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <x-view-profile-edit-card title="{{ __('message.invitations_sent') }}" dataTarget="" noIconOrButton="true"
                                                  :showBorderBottom="false" class="no-padding">
                            <div class="col-12">
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <button class="btn btn-block btn-modal-update" id="deletetoselected" disabled>{{ __('message.delete_all_selected') }}</button>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{route('supplier.ticket.inbox')}}" class="btn btn-block btn-modal-update">{{ __('message.assign_to_me') }}</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ route('supplier.ticket.new')}}" class="btn btn-block btn-modal-update btn-primary"><i class="fa fa-plus"></i> {{ __('message.new_ticket') }}</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        {{ status() }}

                                        <form action="{{route('suppler.delete.sent.ticket')}}" method="post" id ="deleteform" class="d-none">
                                            @csrf
                                            <input type="hidden" name="ticket_id" id ="formticket" value="">
                                        </form>

                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col"><input type="checkbox" name="all" id="all"></th>
                                                <th scope="col">select</th>
                                                <th scope="col">To:</th>
                                                <th scope="col">Ticket Number</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">sent Date</th>
                                                <th scope="col">Attach Doc</th>
                                                <th scope="col">status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php $i=0; @endphp
                                            @foreach($tickets as $ticket)
                                                <tr class ="send-detasils" data-href="">
                                                    <td><input type="checkbox" class="ticket" id ="{{$ticket->id}}"></td>
                                                    <td><label  for="customCheck1"> {{ ++$i }} </label></td>
                                                    <td><a href="{{route('supplier.ticket.sent.detail',$ticket->id)}}">{{$ticket->ticketreceiver->getFullName()}}</a></td>
                                                    <td>{{ $ticket->ticket_number}}</td>
                                                    <td>{{ $ticket->name}}</td>
                                                    <td>
                                                        @if($ticket->ticket_type==1)
                                                            Support
                                                        @elseif($ticket->ticket_type==2)
                                                            Questionnaire
                                                        @elseif($ticket->ticket_type==3)
                                                            Varification
                                                        @endif
                                                    </td>
                                                    <td>{{ date('Y-m-d',strtotime($ticket->created_at))}}</td>
                                                    <td> @if($ticket->attach_doc_id == null) none @else
                                                            <a href="{{asset('document/supplier/tickets'.'/'.$ticket->attachDoc->attach_doc_name)}}"> {{$ticket->attachDoc->attach_doc_name}}</a> @endif</td>
                                                    <td> @if($ticket->is_deleted == 1) Deleted @else @if($ticket->status  == 1) active  @else Inactive @endif @endif</td>
                                                    <td>
                                                        <a href="{{route('supplier.ticket.change.status',$ticket->id)}}" role ="button"
                                                           @if($ticket->status  == 1)
                                                               class ="btn btn-info" title="Inactive Ticket">
                                                            @else
                                                                class ="btn btn-danger" title="Active Ticket">
                                                            @endif
                                                            <i class="fa fa-refresh"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </x-view-profile-edit-card>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
<script>
$(document).ready(function(){
  const tickets = [];

  var totalcheckbox = $('input.ticket').length;
  $('.ticket').click(function(){
    $('#deletetoselected').prop('disabled',$('input.ticket:checked').length == 0);
    if($(this).is(':checked'))
    {
      tickets.push($(this).attr('id'));
    }
    else
    {
      tickets.pop($(this).attr('id'));
    }
    $('#formticket').val(tickets);
  });

  $('#all').on('change',function(){
    var all_tickets = [];
    $('#deletetoselected').prop('disabled',(!$(this).prop('checked')));
    $('.ticket').prop('checked',$(this).prop('checked'));
    $('input.ticket:checked').each(function(){
        all_tickets.push($(this).attr('id'));
    });
    $('#formticket').val(all_tickets);
  });
  $('#deletetoselected').click(function(){
    var x = confirm('Are you sure to delete this  ticket...?');
    if( x == true){
      $('#deleteform').submit();
    }
  });
});
</script>
@endsection
