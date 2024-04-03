@extends('layouts.app')
@section('title', 'expired incitaions list')
@section('content')
    <div class="invite_sent_wrapper">
        <div class="row">
            @include('client.message.messagesidebar')
            <div class="message-right-container p-4">
                <div class="row">
                    <div class="col-12 col-md-10">
                        <x-title-section title='apps' section="{{ __('message.messages') }}" subtitle="{{ __('message.invitations') }}"  />
                    </div>
                    <div class="col-12 col-md-2">
                        <a href="{{ route('client.invitation.newset')}}" class="btn btn-modal-update float-right"><i class="fa fa-plus"></i> New invitation</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-2">
                        <x-view-profile-edit-card title="{{ __('message.invitation_status') }}" dataTarget="" noIconOrButton="true"
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
                                        <td class="align-middle border-none">{{ __('message.accepted') }}</td>
                                        <td class="align-middle border-none">
                                            <x-progress-bar color="#61CE00" total="{{ round($accepted), 2 }}">
                                            </x-progress-bar>
                                        </td>
                                        <td class="align-middle border-none">{{ number_format($accepted), 2 }} %</td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle border-none">{{ __('message.expired') }}</td>
                                        <td class="align-middle border-none">
                                            <x-progress-bar color="#E24042" total="{{ round($expired, 2) }}">
                                            </x-progress-bar>
                                        </td>
                                        <td class="align-middle border-none">{{ number_format($expired, 2) }} %</td>
                                    </tr>
                                </tbody>
                            </table>
                        </x-view-profile-edit-card>
                    </div>
                    <div class="col-md-6 mt-2">
                        <x-view-profile-edit-card title="{{ __('message.invitation_status') }}" dataTarget="" noIconOrButton="true"
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
                                        <td class="align-middle border-none">{{ __('message.first_time') }}</td>
                                        <td class="align-middle border-none">
                                            <x-progress-bar color="#3BD0AE" total="{{ round($first), 2 }}">
                                            </x-progress-bar>
                                        </td>
                                        <td class="align-middle border-none">{{ number_format($first), 2 }} %</td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle border-none">{{ __('message.second_time') }}</td>
                                        <td class="align-middle border-none">
                                            <x-progress-bar color="#38BAF2" total="{{ round($second, 2) }}">
                                            </x-progress-bar>
                                        </td>
                                        <td class="align-middle border-none">{{ number_format($second, 2) }} %
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle border-none">{{ __('message.third_time') }}</td>
                                        <td class="align-middle border-none">
                                            <x-progress-bar color="#B638E1" total="{{ round($third, 2) }}">
                                            </x-progress-bar>
                                        </td>
                                        <td class="align-middle border-none">{{ number_format($third, 2) }} %
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </x-view-profile-edit-card>
                    </div>
                </div>
                <br>
                <div class="view-profile-edit-card  ">
                    <div class="view-profile-edit-card-title d-flex  align-items-center " style="">
                        <div class="view-profile-edit-card-title-text mr-auto" style="">
                            {{ __('message.sent') }}
                        </div>
                        <button class="btn btn-change-password d-flex align-items-center ml-3" id="reseninvitation"
                            disabled>{{ __('message.invite_again_all_selected') }}</button>
                        <x-search-input id="expired-search" placeholder="{{ __('message.search_invitations') }}">
                        </x-search-input>
                    </div>
                    <table id="expired-table" class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <i name="all" id="all" class="fa fa-clone"></i>
                                    {{-- <input type="checkbox" name="all" id="all"> --}}
                                </th>
                                <th scope="col">select</th>
                                <th scope="col">{{ __('message.Supplier Name') }}</th>
                                <th scope="col">Email</th>
                                <th scope="col">{{ __('message.Status') }}</th>
                                <th scope="col">{{ __('message.Invitation Send Date') }}</th>
                            </tr>
                        </thead>
                        <tbody id="tablebody">
                            @php $i=0; @endphp
                            @php $i=0; @endphp
                            @foreach ($suppliers as $supplier)
                                <tr>
                                    <td> <input type="checkbox" name="checkbox" class="supplier" id="{{ $supplier->id }}">
                                    </td>
                                    <td> {{ ++$i }}</td>
                                    <td> <a href="{{ route('client.invitation.expireddetail', $supplier->id) }}">{{ $supplier->supplier_name }}
                                        </a> </td>
                                    <td>{{ $supplier->email }} </td>
                                    <td class="align-middle">
                                        <div class="text-center pr-2 pl-2"
                                            style="
                                            border-radius:1rem;
                                            color:white;
                                            background-color:
                                        @if ($supplier->answer_status == 1) #61CE00
                                        @elseif($supplier->answer_status == 2)
                                            #F4AC00
                                        @elseif($supplier->answer_status == 0)
                                            #E24042 @endif">
                                            @if ($supplier->answer_status == 1)
                                                {{ __('message.completed') }}
                                            @elseif($supplier->answer_status == 2)
                                                {{ __('message.pending') }}
                                            @elseif($supplier->answer_status == 0)
                                                {{ __('message.expired') }}
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ date('d/m/Y', strtotime($supplier->send_date)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ status() }}
                {{-- <div class="row invite_sent_rht_main">
                    <div class="col-md-4">
                        <button class="btn btn-primary" id="reseninvitation" disabled>Invite again all selected</button>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('client.invitation.newset') }}" class="btn btn-primary"><i
                                class="fa fa-plus"></i>New invitation</a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    {{-- form of  the delete the ticket  start --}}
    <form action="{{ route('client.reinvitation.expired') }}" method="post" id="resendform" class="d-none">
        @csrf
        <input type="hidden" name="supp_id" id="suppliers" value="">
    </form>
    {{-- form of  the delete the ticket  start --}}
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var table1 = $('#expired-table').DataTable({
                lengthChange: false
            });
            $('#expired-search').keyup(function() {
                table1.search($(this).val()).draw();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            const tickets = [];
            var totalcheckbox = $('input.ticket').length;
            $('.supplier').click(function() {
                $('#reseninvitation').prop('disabled', $('input.supplier:checked').length == 0);
                if ($(this).is(':checked')) {
                    tickets.push($(this).attr('id'));
                } else {
                    tickets.pop($(this).attr('id'));
                }
                $('#suppliers').val(tickets);
            });
            if (!$('input.supplier').length > 0) {
                $('#all').prop('disabled', true);
            }
            $('#all').on('change', function() {
                var all_tickets = [];
                $('#reseninvitation').prop('disabled', (!$(this).prop('checked')));
                $('.supplier').prop('checked', $(this).prop('checked'));
                $('input.supplier:checked').each(function() {
                    all_tickets.push($(this).attr('id'));
                });
                $('#suppliers').val(all_tickets);
            });
            $('#reseninvitation').click(function() {
                $('#resendform').submit();
            });
        });
    </script>
@endsection
