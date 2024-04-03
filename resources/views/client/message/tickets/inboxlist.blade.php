@extends('layouts.app')
@section('title', 'ticket inbox list')
@section('content')
    <div class="invite_sent_wrapper">
        <div class="row ">
            @include('client.message.messagesidebar')
            <div class="message-right-container p-4">
                <div class="row">
                    <div class="col-12 col-md-10">
                        <x-title-section title='apps' section="{{ __('message.messages') }}" subtitle="{{ __('message.tickets') }}"/>
                    </div>
                    <div class="col-12 col-md-2">
                        <a class="btn btn-modal-update float-right" href="{{ route('client.ticket.new')}}">
                            <i class="fa fa-file-text-o mr-2"></i>
                            {{ __('message.add_new_ticket') }}
                        </a>
                    </div>
                </div>

                <div class="row">
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
                <br>
                {{-- <x-view-profile-edit-card title="INBOX" dataTarget="" noIconOrButton="true" class="no-padding"> --}}
                <div class="view-profile-edit-card  ">
                    <div class="view-profile-edit-card-title d-flex  align-items-center " style="">
                        <div class="view-profile-edit-card-title-text " style="">
                            {{ __('message.inbox') }} ({{ $ticketinbox->count() }})
                        </div>
{{--                        <button class="btn btn-change-password d-flex align-items-center ml-auto" id="deletetoselected"--}}
{{--                            disabled>{{ __('message.delete_all_selected') }}</button>--}}
                        <a href="{{ route('client.ticket.inbox') }}"
                           class="btn btn-change-password d-flex align-items-center ml-3">clear {{ __("message.assign_to_me") }}</a>
                        <x-search-input id="inbox-ticket-search" placeholder="{{ __('message.search_ticket') }}"></x-search-input>
                    </div>
                    <table id="inbox-ticket-table" class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <i name="all" id="all" class="fa fa-clone"></i>
                                    {{-- <input type="checkbox" name="all" id="all"> --}}
                                </th>
                                <th scope="col">{{ __('message.from') }}</th>
                                <th scope="col">{{ __('message.ticket_Number') }}</th>
                                <th scope="col">{{ __('message.title') }}</th>
                                <th scope="col">{{ __("message.type") }} </th>
                                <th scope="col">{{ __("message.sent_date") }}</th>
                                <th scope="col">{{ __('message.attached_file') }}</th>
                                <th scope="col">{{ __("message.Status") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ticketinbox as $ticket)
                                <tr class="send-detasils" data-href="">
                                    <td style=""><input type="checkbox" class="ticket" id="{{ $ticket->id }}">
                                    </td>
                                    <td><a style="color: #29394f !important"
                                            href="{{ route('client.ticket.inboxdetails', $ticket->id) }}">{{ $ticket->ticketsender->getSupplierFullName() }}
                                        </a> </td>
                                    <td>{{ $ticket->ticket_number }}</td>
                                    <td>{{ $ticket->name }}</td>
                                    <td>
                                        <div class="text-center"
                                            style="
                                            border-radius:1rem;
                                            color:white;
                                            background-color:
                                        @if ($ticket->ticket_type == 1) #3BD0AE
                                        @elseif($ticket->ticket_type == 2)
                                            #38BAF2
                                        @elseif($ticket->ticket_type == 3)
                                            #B638E1 @endif">
                                            @if ($ticket->ticket_type == 1)
                                                {{ __('message.support') }}
                                            @elseif($ticket->ticket_type == 2)
                                                {{ __('message.questionnaire') }}
                                            @elseif($ticket->ticket_type == 3)
                                                {{ __('message.verification') }}
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ date('Y-m-d', strtotime($ticket->created_at)) }}</td>
                                    <td>
                                        @if ($ticket->attach_doc_id == null)
                                            none
                                        @else
                                            <a
                                                href="{{ asset('document/supplier/tickets' . '/' . $ticket->attachDoc->attach_doc_name) }}">
                                                {{ $ticket->attachDoc->attach_doc_name }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-center"
                                            style="
                                        border-radius:1rem;
                                        color:white;
                                        background-color:
                                    @if ($ticket->status == 1) #61CE00
                                    @else
                                        #E24042 @endif">
                                            @if ($ticket->status == 1)
                                            {{ __('message.open') }}
                                            @else
                                                {{ __('message.closed') }}
                                            @endif
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- </x-view-profile-edit-card> --}}
                {{-- <div class="row invite_sent_rht_main">
                    @can('send ticket')
                        <div class="col-md-4">
                            <a href="{{ route('client.ticket.new') }}" class="btn btn-primary"><i class="fa fa-plus"></i> New
                                ticket</a>
                        </div>
                    @endcan
                </div> --}}
                {{-- form of  the delete the ticket  start --}}
                <form action="{{ route('client.delete.inbox.tickets') }}" method="post" id="deleteform" class="d-none">
                    @csrf
                    <input type="hidden" name="ticket_id" id="formticket" value="">
                </form>
                {{-- form of  the delete the ticket  start --}}
                <div class="invite_send_table">
                    <h2></h2>
                </div>
            </div>
        </div>
    </div>
    <x-modal title="New Ticket" id="new_ticket" saveButtonName="Save">
        <x-edit-company-input id="sendto" title="SEND TO" value="AA" select="true">
            {{-- @foreach ($cities as $city)
                <option value="{{ $city->id }}" @if ($company->city_id == $city->id) selected @endif>
                    {{ $city->name }}</option>
            @endforeach --}}
        </x-edit-company-input>
        <x-edit-company-input id="supplier" title="SUPPLIER" value="AA" select="true">
            {{-- @foreach ($cities as $city)
                <option value="{{ $city->id }}" @if ($company->city_id == $city->id) selected @endif>
                    {{ $city->name }}</option>
            @endforeach --}}
        </x-edit-company-input>
        <x-edit-company-input id="type" title="TYPE" value="AA" select="true">
            {{-- @foreach ($cities as $city)
                <option value="{{ $city->id }}" @if ($company->city_id == $city->id) selected @endif>
                    {{ $city->name }}</option>
            @endforeach --}}
        </x-edit-company-input>

        <x-edit-company-input title="TITLE">
        </x-edit-company-input>

        <div class="form-group">
            <label for="description">DESCRIPTION</label>
            <textarea class="form-control" id="description" rows="6" style="resize:none"></textarea>
        </div>

        <div class="d-flex justify-content-center align-items-center">
            <button type="button" class="btn btn-generate-report btn-summary w-50">
                Select a file
            </button>
            <div class="mr-auto ml-2">
                No file selected
            </div>


        </div>

    </x-modal>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        var table1 = $('#inbox-ticket-table').DataTable({
            lengthChange: false
        });
        $('#inbox-ticket-search').keyup(function() {
            table1.search($(this).val()).draw();
        });
    });
</script>
    <script>
        $(document).ready(function() {
            const tickets = [];
            var totalcheckbox = $('input.ticket').length;
            $('.ticket').click(function() {
                $('#deletetoselected').prop('disabled', $('input.ticket:checked').length == 0);
                if ($(this).is(':checked')) {
                    tickets.push($(this).attr('id'));
                } else {
                    tickets.pop($(this).attr('id'));
                }
                $('#formticket').val(tickets);
            });
            $('#all').on('change', function() {
                var all_tickets = [];
                $('#deletetoselected').prop('disabled', (!$(this).prop('checked')));
                $('.ticket').prop('checked', $(this).prop('checked'));
                $('input.ticket:checked').each(function() {
                    all_tickets.push($(this).attr('id'));
                });
                $('#formticket').val(all_tickets);
            });
            $('#deletetoselected').click(function() {
                var x = confirm('Are you sure to delete this  ticket...?');
                if (x == true) {
                    $('#deleteform').submit();
                }
            });
        });
    </script>
@endsection
