@extends('layouts.app')
@section('title', 'sent invitaion list')
@section('content')
    <div class="invite_sent_wrapper">
        <div class="row ">
            @include('client.message.messagesidebar')
            <div class="message-right-container p-4">
                <div class="row">
                    <div class="col-12 col-md-10">
                        <x-title-section title='apps' section="{{ __('message.messages') }}" subtitle='{{ __("message.invitations") }}'  />
                    </div>
                    <div class="col-12 col-md-2">
                        <a href="{{ route('client.invitation.newset')}}" class="btn btn-modal-update float-right"><i class="fa fa-plus"></i> New invitation</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
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
                                        <td class="align-middle border-none">{{ __('message.pending') }}</td>
                                        <td class="align-middle border-none">
                                            <x-progress-bar color="#F4AC00" total="{{ round($expired, 2) }}">
                                            </x-progress-bar>
                                        </td>
                                        <td class="align-middle border-none">{{ number_format($expired, 2) }} %</td>
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
                    <div class="col-md-6">
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
                <div class="row invite_sent_rht_main">
                    @can('re-invite invitation')
                        <div class="col-md-4">
                            <!--<a href="#" class="btn btn-primary">Resend all selected</a>-->
                        </div>
                    @endcan
                    <div class="col-md-4">
                        {{-- <a href="#" id ="timeout" class="btn btn-primary">Time out deadline</a> --}}
                    </div>
                    @can('invite supplier')
                        <div class="col-md-4">
                        </div>
                    @endcan
                </div>
                <div class="view-profile-edit-card  ">
                    <div class="view-profile-edit-card-title d-flex  align-items-center " style="">
                        <div class="view-profile-edit-card-title-text mr-auto" style="">
                            {{ __('message.sent') }}
                        </div>
                        <x-search-input id="sent-invitation-search" placeholder="{{ __('message.search_invitations') }}">
                        </x-search-input>
                    </div>
                    <table id="sent-invitation-table" class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <i name="all" id="all" class="fa fa-clone"></i>
                                    {{-- <input type="checkbox" name="all" id="all"> --}}
                                </th>
                                <th scope="col">id</th>
                                <th scope="col">{{ __('message.Supplier Name') }}</th>
                                <th scope="col">Email</th>
                                <th scope="col">{{ __('message.Invitation Send Date') }}</th>
                                <th scope="col">{{ __('message.Status') }}</th>
                            </tr>
                        </thead>
                        <tbody id="tablebody">
                            @php $i=0; @endphp
                            @foreach ($suppliers as $supplier)
                                <tr class="send-detasils" id="{{ $supplier->id }}" data-href="">
                                    <td><input type="checkbox" class="ticket" id="{{ $supplier->id }}"></td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <!--<input type="checkbox" class="customcheck" >-->
                                            <label> {{ ++$i }} </label>
                                        </div>
                                    </td>
                                    <td> <a href="{{ route('client.invitation.sentdetail', $supplier->id) }}">{{ $supplier->supplier_name }}
                                        </a> </td>
                                    <td>{{ $supplier->email }}</td>
                                    <td>{{ date('d/m/Y', strtotime($supplier->send_date)) }}</td>
                                    <td>
                                        <div class="text-center "
                                            style="
                                            border-radius:1rem;
                                            color:white;
                                            background-color:
                                        @if ($supplier->status == 1) #61CE00
                                        @elseif($supplier->status == 2)
                                            #F4AC00
                                        @elseif($supplier->status == 3)
                                            #E24042 @endif">
                                            @if ($supplier->status == 1)
                                                {{ __('message.accepted') }}
                                            @elseif($supplier->status == 2)
                                                {{ __('message.pending') }}
                                            @elseif($supplier->status == 3)
                                                {{ __('message.expired') }}
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var table1 = $('#sent-invitation-table').DataTable({
                lengthChange: false,
            });
            $('#sent-invitation-search').keyup(function() {
                table1.search($(this).val()).draw();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#timeout').click(function() {
                var url = "{{ route('client.invitation.timeout') }}"
                $.ajax({
                    type: "get",
                    url: url,
                    success: function(res) {
                        console.log(res);
                        if (res.length > 0) {
                            $("#tablebody").empty();
                            $.each(res, function(key, value) {
                                $('#tablebody').append(
                                    '<tr class ="send-detasils" id="{{ $supplier->id }}" data-href="">' +
                                    '<td>' +
                                    '<div class="custom-control custom-checkbox">' +
                                    '<input type="checkbox" class="customcheck">' +
                                    '<label>' + (key + 1) + '</label>' +
                                    '</div>' +
                                    '</td>' +
                                    '<td> <a href="#">' + value.supplier_name +
                                    '</a> </td>' +
                                    '<td>' + value.email + '</td>' +
                                    '<td>' + 'Timeout' + '</td>' +
                                    '<td>' + value.send_date + '</td>' +
                                    '</tr>');
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
