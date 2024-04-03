@extends('layouts.app')

@section('title', 'Questionnaire reminer ')

@section('content')
    <div class="invite_sent_wrapper">
        <div class="row">
            @include('client.message.messagesidebar')

            <div class="message-right-container p-4">
                <x-title-section title='apps' section="{{ __('message.messages') }}" subtitle="{{ __('message.questionnaires') }}" />
                <div class="row">
                    <div class="col-md-6">
                        <x-view-profile-edit-card otherSlot='true' title="" dataTarget="" :showBorderBottom="false"
                            class="p-2">
                            <div class="d-flex mt-2">
                                <div style="font-size: 1.3rem; font-weight:700">{{ $questionnaire->count() }}</div>
                                <div class="ml-auto ">{{ round($done), 2 }}%</div>
                            </div>
                            <div class="w-100 mt-3 mb-4">
                                <x-progress-bar color="#61CE00" total="{{ round($done), 2 }}">
                                </x-progress-bar>
                            </div>
                            <div style="font-size: .8rem; font-weight:700" class="mb-2">{{ __('message.new_pending_suppliers') }}</div>

                        </x-view-profile-edit-card>
                    </div>
                    <div class="col-md-6">
                        <x-view-profile-edit-card otherSlot='true' title="" dataTarget="" :showBorderBottom="false"
                            class="p-2">
                            <div class="d-flex mt-2">
                                <div style="font-size: 1.3rem; font-weight:700">{{ $suppliers->count() }}</div>
                                <div class="ml-auto ">{{ round($notdone), 2 }}%</div>
                            </div>
                            <div class="w-100 mt-3 mb-4">
                                <x-progress-bar color="#E24042" total="{{ round($done), 2 }}">
                                </x-progress-bar>
                            </div>
                            <div style="font-size: .8rem; font-weight:700" class="mb-2">{{ __('message.questionnaire_reminder') }}</div>

                        </x-view-profile-edit-card>
                    </div>
                </div>
                <br>
                <div class="view-profile-edit-card  ">
                    <div class="view-profile-edit-card-title d-flex  align-items-center " style="">
                        <div class="view-profile-edit-card-title-text mr-auto " style="">
                            {{ __('message.new_pending_suppliers') }}
                        </div>
                        <button class="btn btn-change-password d-flex align-items-center ml-3" id="resendtoall"
                            disabled>{{ __('message.resend_all_selected') }}</Button>
                        <x-search-input id="supply-search" placeholder="{{ __('message.search_pending_suppliers') }}">

                        </x-search-input>

                    </div>
                    <table id="supply-table" class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <i name="all" id="all" class="fa fa-clone"></i>
                                    {{-- <input type="checkbox" name="all" id="all"> --}}
                                </th>
                                <th scope="col">ID</th>
                                <th scope="col">{{ __('message.Supplier Name') }}</th>
                                <th scope="col">Email</th>
                                <th scope="col">{{ __('message.location') }}</th>
                                <th scope="col">{{ __('message.questionnaire') }}</th>
                                <th scope="col">{{ __('message.Status') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php  $i =0; @endphp
                            @foreach ($questionnaire as $questionary)
                                <tr>
                                    <td class="align-middle">

                                        <input class="" type="checkbox" id="{{ $questionary->id }}"
                                            value="{{ $questionary->id }}" data-status="{{ $questionary->status }}">
                                    </td>
                                    <td class="align-middle"> {{ ++$i }}</label></td>
                                    <td class="align-middle">{{ $questionary->receiver->getSupplierFullName() }}</td>
                                    <td class="align-middle"> {{ $questionary->receiver->email }}</td>
                                    <td class="align-middle">{{ $questionary->location->location_name }}</td>
                                    <td class="align-middle">
                                        {{ $questionary->questionnaire->name }}

                                    </td>
                                    <td class="align-middle">
                                        <div class="text-center pr-2 pl-2"
                                            style="
                                            border-radius:1rem;
                                            color:white;
                                            background-color:
                                        @if ($questionary->answer_status == 1) #61CE00
                                        @elseif($questionary->answer_status == 0)
                                            #F4AC00
                                        @elseif($questionary->answer_status == 2)
                                            #E24042 @endif">
                                            @if ($questionary->answer_status == 1)
                                                {{ __('message.completed') }}
                                            @elseif($questionary->answer_status == 0)
                                                {{ __('message.pending') }}
                                            @elseif($questionary->answer_status == 2)
                                                {{ __('message.expired') }}
                                            @endif
                                        </div>
                                    </td>

                                    {{-- <td class="align-middle"><a href="{{ route('client.questionnaire.reminberdetails', $questionary->id) }}"
                                            class="btn btn-primary">Sent</a></td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ status() }}
                <div class="row invite_sent_rht_main">
                    <div class="col-md-4 offset-md-8">
                        <button class="btn btn-block btn-primary" id="resendtoall" disabled>{{ __('message.new_pending_suppliers') }}</Button>
                    </div>
                </div>
                {{-- <div class="new_supplier_reminder_set">
                    <div class="row">
                        <div class="col-md-9">
                            <h2 class="">New Pending suppliers: {{ $questionnaire->count() }}</h2>
                        </div>
                    </div>
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th scope="col">Sr. No.</th>
                                <th scope="col">
                                    <div class="form-group">
                                        <input type="checkbox" name="selectall" id="selectall">
                                    </div>
                                </th>
                                <th scope="col">Supplier name</th>
                                <th scope="col"> email</th>
                                <th scope="col">Location</th>
                                <th scope="col">status</th>
                                <th scope="col"> Questionnaire </th>
                                <th scope="col">Sent to All</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php  $i =0; @endphp
                            @foreach ($questionnaire as $questionary)
                                <tr>
                                    <td class="align-middle"> {{ ++$i }}</label></td>
                                    <td class="align-middle">
                                        <div class="form-check">
                                            <input class="form-check-input checkuplist" type="checkbox"
                                                id="{{ $questionary->id }}" value="{{ $questionary->id }}"
                                                data-status="{{ $questionary->status }}">
                                        </div>
                                    </td>
                                    <td class="align-middle">{{ $questionary->receiver->getSupplierFullName() }}</td>
                                    <td class="align-middle"> {{ $questionary->receiver->email }}</td>
                                    <td class="align-middle">{{ $questionary->location->location_name }}</td>
                                    <td class="align-middle">
                                        @if ($questionary->answer_status == 1)
                                            completed
                                        @else
                                            Pending
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        {{ $questionary->questionnaire->name }}
                                    </td>
                                    <td class="align-middle"><a
                                            href="{{ route('client.questionnaire.reminberdetails', $questionary->id) }}"
                                            class="btn btn-primary">Sent</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> --}}
                <br>
                <div class="view-profile-edit-card  ">
                    <div class="view-profile-edit-card-title d-flex  align-items-center " style="">
                        <div class="view-profile-edit-card-title-text mr-auto" style="">
                            {{ __('message.questionnaire_reminder') }}
                        </div>

                        <x-search-input id="questionnaire-search" placeholder="{{ __('message.search_questionnaire_reminder') }}">

                        </x-search-input>
                    </div>
                    <table id="questionnaire-table" class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <i name="all" id="all" class="fa fa-clone"></i>
                                    {{-- <input type="checkbox" name="all" id="all"> --}}
                                </th>
                                <th scope="col">Id</th>
                                <th scope="col">{{ __('message.Client') }}</th>
                                <th scope="col">{{ __('message.Supplier Name') }}</th>
                                <th scope="col">Email</th>
                                <th scope="col">{{ __('message.location') }}</th>
                                <th scope="col">{{ __('message.sent_date') }}</th>
                                <th scope="col">{{ __('message.Status') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php  $i =0; @endphp

                            @foreach ($suppliers as $supplier)
                                <tr>
                                    <td class="align-middle">

                                        <input class="" type="checkbox" id="{{ $supplier->id }}"
                                            value="{{ $supplier->id }}" data-status="{{ $supplier->status }}">
                                    </td>
                                    <td class="align-middle"> {{ ++$i }}</td>
                                    <td class="align-middle">
                                        <img src="{{ asset('images/client/profile') . '/' . $supplier->client->image }}"
                                            alt="" width="35px" height="35px" style="border-radius:100%">
                                    </td>
                                    <td class="align-middle"> <a
                                            href="{{ route('client.questionnaire.reminberdetails', $supplier->id) }}">
                                            {{ $supplier->supplier->getSupplierFullName() }} </a> </td>
                                    <td class="align-middle">{{ $supplier->supplier->email }}</td>
                                    <td class="align-middle"> {{ $supplier->location->location_name }} </td>

                                    <td class="align-middle"> {{ date('Y-m-d', strtotime($supplier->created_at)) }}</td>
                                    <td class="align-middle">
                                        <div class="text-center pr-2 pl-2"
                                            style="
                                            border-radius:1rem;
                                            color:white;
                                            background-color:
                                        @if ($supplier->status == 1) #61CE00
                                        @elseif($supplier->status == 0)
                                            #F4AC00
                                        @elseif($supplier->status == 2)
                                            #E24042 @endif">
                                            @if ($supplier->status == 1)
                                                ACCEPTED
                                            @elseif($supplier->status == 0)
                                                PENDING
                                            @elseif($supplier->status == 2)
                                                EXPIRED
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="invite_send_table new_supplier_reminder_set">
                    <h2 class="float-left">MF Reminder: {{ $suppliers->count() }}</h2>


                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    {{-- form of  the delete the ticket  start --}}
    <form action="{{ route('client.resend.selectall') }}" method="post" id="resendform" class="d-none">
        @csrf
        <input type="hidden" name="selected" id="formticket" value="">
    </form>
    {{-- form of  the delete the ticket  start --}}


@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.selecttwodropdown').select2();
            var table1 = $('#supply-table').DataTable({

                lengthChange: false
            });
            $('#supply-search').keyup(function() {
                table1.search($(this).val()).draw();
            });
            var table2 = $('#questionnaire-table').DataTable({

                lengthChange: false
            });
            $('#questionnaire-search').keyup(function() {
                table2.search($(this).val()).draw();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            const tickets = [];
            var totalcheckbox = $('input.ticket').length;
            $('.checkuplist').click(function() {
                $('#resendtoall').prop('disabled', $('input.checkuplist:checked').length == 0);
                if ($(this).is(':checked')) {
                    tickets.push($(this).attr('id'));
                } else {
                    tickets.pop($(this).attr('id'));
                }
                $('#formticket').val(tickets);
            });

            $('#selectall').on('change', function() {
                var all_tickets = [];
                if (this.checked) {

                    $('#resendtoall').prop('disabled', (!$(this).prop('checked')));
                    $('.checkuplist').each(function() {
                        if ($(this).attr('data-status') == 0) {
                            // alert('demo');
                            $(this).prop('checked', true);
                        }
                    });
                    $('input.checkuplist:checked').each(function() {
                        all_tickets.push($(this).attr('id'));
                    });
                    $('#formticket').val(all_tickets);
                } else {
                    $(':checkbox').each(function() {
                        this.checked = false;
                    });
                    all_tickets = [];
                }

            });

            $('#resendtoall').click(function() {
                $('#resendform').submit();
            });
        });
    </script>
@endsection
