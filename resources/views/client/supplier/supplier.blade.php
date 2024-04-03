@extends('layouts.app')
@section('title', __('message.suppliers') )
@section('content')

    @php
        $user = App\Models\User::find(Auth::user()->id);
        // $role = App\Models\UserRole::find($user->user_role);
    @endphp
    <x-modal title="New Supplier Invitation" id="new-supp-modal" action="{{ route('client.invitation.store') }}"
        saveButtonName="Add">
        {{ status() }}
        <div class="inner_left_nw_invite_img mr-auto ml-auto mb-2">
            <img src="{{ asset('images/client/profile') . '/' . $user->image }}" alt="">
        </div>
        @csrf
        <div class="form-group">
            <label for="newpassword">Name</label>
            <input type="text" class="form-control" name="nameaddnewsupplier" id="nameaddnewsupplier" aria-describedby="nameHelp"
                value="{{ @old('name') }}" placeholder="Enter a supplier name">
            @error('nameaddnewsupplier')
                <span class="text-danger"> <strong> {{ $message }} </strong></span>
            @enderror
        </div>
        <div class="form-group">
            <label for="newpassword">ID</label>
            <input type="text" class="form-control" name="idaddnewsupplier" id="idaddnewsupplier" aria-describedby="IDHelp"
                value="{{ @old('supplierid') }}" placeholder="Enter a supplier ID">
            @error('idaddnewsupplier')
                <span class="text-danger"> <strong> {{ $message }} </strong></span>
            @enderror
        </div>
        <div class="form-group">
            <label for="newpassword">CIF</label>
            <input type="text" class="form-control" name="cifaddnewsupplier" id="cifaddnewsupplier" value="{{ @old('cif') }}"
                aria-describedby="cifHelp" placeholder="Enter a supplier CIF">
            @error('cifaddnewsupplier')
                <span class="text-danger"> <strong> {{ $message }} </strong></span>
            @enderror
        </div>
        <div class="form-group">
            <label for="newpassword">Email</label>
            <input type="email" class="form-control" name="emailaddnewsupplier" id="emailaddnewsupplier" aria-describedby="emailHelp"
                value="{{ @old('email') }}" placeholder="Enter email">
            @error('emailaddnewsupplier')
                <span class="text-danger"> <strong> {{ $message }} </strong></span>
            @enderror
        </div>
    </x-modal>
    <div style="padding-left: 80px">
        <div class="global_wrapper">
            <div class="main_supplier_pg">
                <x-title-section title='DASHBOARD' section='SUMMARY' subtitle="{{ __('message.suppliers') }}" />
                {{-- filter header disply start --}}
                @include('client.filter_header')
                {{-- filter header disply end --}}
                {{-- filter output section start --}}
                <div class="row my-4">
                    <div class="col-md-8">
                        <x-view-profile-edit-card title="" dataTarget="" :showBorderBottom="false" noIconOrButton="true"
                                                  extraClasses="justify-content-between w-100  flex-wrap mt-auto">
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                <div class="w-100 text-center" id="new-supplier-cont" style="cursor: pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 50px; height: 50px">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    <br>
                                    <span>{{ __('message.new_supplier') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                <x-suppliers-mini-card extraclass='mb-4' title="{{ __('message.suppliers') }}" color="#68C90D" icon="suppliers"
                                                       value="{{ $suppliers->count() }}">
                                </x-suppliers-mini-card>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                <x-suppliers-mini-card extraclass='mb-4' title="{{ __('message.location') }}" color="#2ABDFE" icon="locations"
                                                       value="{{ $locations->count() }}">
                                </x-suppliers-mini-card>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                <x-suppliers-mini-card extraclass='mb-4' title="{{ __('message.pending') }}" color="#F6AC00" icon="pending"
                                                       value="{{ $pendingsupplier->count() }}">
                                </x-suppliers-mini-card>
                            </div>
                        </x-view-profile-edit-card>
                    </div>
                    <div class="col-md-4 mb-2">
                        <x-view-profile-edit-card title="{{ __('message.invitation_status') }}" titleStyle="font-size:.9rem" dataTarget=""
                                                  noIconOrButton="true" otherSlot="true">
                            <x-supp-invi-status-bar min=1 max=100 total="{{ $total }}" color="#9226B6"
                                                    title="{{ __('message.sign_up') }}">
                            </x-supp-invi-status-bar>
                            <x-supp-invi-status-bar min=1 max=100 total="{{ $first }}" color="#3BD1AC"
                                                    title="{{ __('message.first_time') }}">
                            </x-supp-invi-status-bar>
                            <x-supp-invi-status-bar min=1 max=100 total="{{ $second }}" color="#44D5FF"
                                                    title="{{ __('message.second_time') }}">
                            </x-supp-invi-status-bar>
                            <x-supp-invi-status-bar min=1 max=100 total="{{ $third }}" color="#DB1B1E"
                                                    title="{{ __('message.expired') }}">
                            </x-supp-invi-status-bar>
                        </x-view-profile-edit-card>
                    </div>
                </div>
            </div>
            <x-view-profile-edit-card title="{{ __('message.location') }} vs {{ __('message.Status') }}" dataTarget="" noIconOrButton="true"
                extraClasses="justify-content-between w-100 flex-wrap mt-auto" otherSlot="true">
                <div class="row justify-content-between w-100 pl-4 pr-2">
                    <div class="col-md-2 col-sm-2 col-6">
                        <div class="inner_size_locate">
                            <p>{{ __('message.big') }}</p>
                            <h3>{{ round($big) }}%</h3>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-6">
                        <div class="inner_size_locate">
                            <p>{{ __('message.medium') }}</p>
                            <h3>{{ round($medium) }}%</h3>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-6">
                        <div class="inner_size_locate">
                            <p>{{ __('message.small') }}</p>
                            <h3>{{ round($small) }}%</h3>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-6">
                        <div class="inner_size_locate">
                            <p>{{ __('message.micro') }}</p>
                            <h3>{{ round($micro) }}%</h3>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-6">
                        <div class="inner_size_locate">
                            <p>{{ __('message.security_department')  }}</p>
                            <h3>{{ round($sec) }}%</h3>
                        </div>
                    </div>
                </div>
                <div class="location_supplier_graph">
                    <div class="chart-container">
                        <canvas id="chart1"></canvas>
                    </div>
                </div>
            </x-view-profile-edit-card>
            <br>
            <x-view-profile-edit-card title="{{ __('message.company_categories') }}" dataTarget="" noIconOrButton="true"
                                      extraClasses="justify-content-between w-100 flex-wrap mt-auto" otherSlot="true">
                <div class="row justify-content-between w-100 pl-4 pr-2">
                    @foreach($companiesCategories as $companiesCategory)
                        <div class="col-md-4 col-sm-4 col-4 d-flex justify-content-center">
                            <div class="inner_size_locate" style="height: 90%">
                                <p>{{ $companiesCategory['category'] }}</p>
                                <h3>{{ $companiesCategory['total_companies'] }}%</h3>
                                <h5>{{ $companiesCategory['total_locations'] }}</h5>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="location_supplier_graph">
                    <div class="chart-container">
                        <canvas id="company-category-chart"></canvas>
                    </div>
                </div>
            </x-view-profile-edit-card>
            <br>
            <x-view-profile-edit-card title="{{ __('message.suppliers') }}" dataTarget="" :showBorderBottom="false" class="no-padding"
                                      noIconOrButton="true">
                <div class="col-12">
                    <div class="row justify-content-end">
                        <div class="col-12 col-md-2 row justify-content-end mr-2">
                            <a href="{{ route('client.invitation.sent') }}" class="btn btn-dark"><i class="fa fa-plus"></i> {{ __('message.new_supplier') }}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @can('read supplier')
                                <table class="table pl-3 pr-2" id="suppliers-table">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('message.Supplier') }}</th>
                                        <th scope="col">{{ __('message.location') }}</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">{{ __('message.Registerd Date') }}</th>
                                        <th scope="col">{{ __('message.category') }}</th>
                                        <th scope="col">{{ __('message.company_size') }}</th>
                                        <th scope="col">{{ __('message.maturity_level')  }}</th>
                                        <th scope="col">{{ __('message.security_department')  }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            @endcan
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-9"></div>
                        <div class="col-12 col-md-3 d-flex">
                            <select name="" id="paginate-by-suppliers" class="form-control form-sm">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="all">{{ __('message.all') }}</option>
                            </select>
                            <ul class="pagination pagination-circled mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" data-disabled="true" id="prev-page-paginate-suppliers">
                                        <i class="fa fa-chevron-left"></i>
                                    </a>
                                </li>
                                <li style="width: 70px !important;">
                                    <input type="text" class="form-control text-center" id="current-page-suppliers" value="1" readonly>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" data-disable="false" id="next-page-paginate-suppliers" href="#">
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </x-view-profile-edit-card>
            <br>
            <x-view-profile-edit-card title="{{ __('message.pending_suppliers') }}" dataTarget="" :showBorderBottom="false" class="no-padding"
                noIconOrButton="true">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            @can('read supplier')
                                <table class="table pr-0 pl-0" id="table-suppliers-pending">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('message.Supplier') }}</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">{{ __('message.invitation_status') }}</th>
                                        <th scope="col">{{ __('message.sent_date') }}</th>
                                        <th scope="col">{{ __('message.deadline') }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            @endcan
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-9"></div>
                        <div class="col-12 col-md-3 d-flex">
                            <select name="" id="paginate-by-suppliers-pending" class="form-control form-sm">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="all">{{ __('message.all') }}</option>
                            </select>
                            <ul class="pagination pagination-circled mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" data-disabled="true" id="prev-page-paginate-suppliers-pending">
                                        <i class="fa fa-chevron-left"></i>
                                    </a>
                                </li>
                                <li style="width: 70px !important;">
                                    <input type="text" class="form-control text-center" id="current-page-suppliers-pending" value="1" readonly>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" data-disable="false" id="next-page-paginate-suppliers-pending" href="#">
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </x-view-profile-edit-card>
            <br>
            <x-view-profile-edit-card title="{{ __('message.deleted_suppliers') }}" dataTarget="" :showBorderBottom="false" class="no-padding"
                noIconOrButton="true">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            @can('read supplier')
                                <table class="table pr-0 pl-0" id="table-suppliers-delete">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">{{ __('message.Supplier') }}</th>
                                        <th scope="col">{{ __('message.location') }}</th>
                                        <th scope="col">{{ __('message.delete_date') }}</th>
                                        <th scope="col">{{ __('message.delete_time') }}</th>
                                        <th scope="col">{{ __('message.user_who_deleted') }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            @endcan
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-9"></div>
                        <div class="col-12 col-md-3 d-flex">
                            <select name="" id="paginate-by-suppliers-delete" class="form-control form-sm">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="all">{{ __('message.all') }}</option>
                            </select>
                            <ul class="pagination pagination-circled mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" data-disabled="true" id="prev-page-paginate-suppliers-delete">
                                        <i class="fa fa-chevron-left"></i>
                                    </a>
                                </li>
                                <li style="width: 70px !important;">
                                    <input type="text" class="form-control text-center" id="current-page-suppliers-delete" value="1" readonly>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" data-disable="false" id="next-page-paginate-suppliers-delete" href="#">
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </x-view-profile-edit-card>
        </div>
    </div>
    <br>
    <br>
@endsection
@section('script')
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
        var data = {
            labels: ["Big", "Medium", "Small", "Micro", "Security Dep."],
            datasets: [{
                label: "Size",
                backgroundColor: [
                    '#5CA7F6',
                    '#5CA7F6',
                    '#5CA7F6',
                    '#5CA7F6',
                    '#5CA7F6'
                ],
                borderWidth: 0,

                data: [{{ round($big) }}, {{ round($medium) }}, {{ round($small) }}, {{ round($micro) }},
                    {{ round($sec) }}
                ],
            }]
        };
        var options = {
            legend: {
                display: false
            },
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    stacked: true,
                    gridLines: {
                        display: true,
                        color: "#deebec"
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false
                    },
                    barPercentage: 0.35
                }]
            }
        };
        Chart.Bar('chart1', {
            options: options,
            data: data
        });
    </script>
    <script>
        $(document).ready(function() {

            $('#with_search_drp').change(function() {
                let value = $(this).val();
                url = "{{ route('client.supplier.details', ':value') }}"
                url = url.replace(':value', value);
                $("<a>").prop({
                    target: "_blank",
                    href: url,
                })[0].click();

            });

            getSuppliersTable();
            getSuppliersPendingTable();
            getSuppliersDeleteTable();
        });

        @if (isset($errors->messages()['nameaddnewsupplier']) ||
                isset($errors->messages()['idaddnewsupplier']) ||
                isset($errors->messages()['cifaddnewsupplier']) ||
                isset($errors->messages()['emailaddnewsupplier']))
            $("#new-supp-modal").modal("show");
        @endif

        $('#new-supplier-cont').click(function() {
            $('#new-supp-modal').modal('show')
        });

        // DATA SUPPLIERS

        $('#paginate-by-suppliers').change(function () {
            $('#current-page-suppliers').val(1);

            getSuppliersTable();
        })

        $('#prev-page-paginate-suppliers').click(function (e) {
            e.preventDefault();

            if($('#current-page-suppliers').val() == 1) {
                return;
            }

            let prevPage = parseInt($('#current-page-suppliers').val()) - 1;
            $('#current-page-suppliers').val(prevPage);

            getSuppliersTable();
        })

        $('#next-page-paginate-suppliers').click(function (e) {
            e.preventDefault();

            let nextPage = parseInt($('#current-page-suppliers').val()) + 1;
            $('#current-page-suppliers').val(nextPage)

            getSuppliersTable();
        })

        function getSuppliersTable() {
            let page = $('#current-page-suppliers').val();
            let perPage = $('#paginate-by-suppliers').val();

            $('#suppliers-table tbody').html('');

            $.get('/supplier/data/get-paginate', {page,perPage})
            .done(function(response) {
                $('#current-page-suppliers').val(response.current_page)
                if(response.next_page_url == null) {
                    $('#next-page-paginate-suppliers').parent().addClass('disabled');
                } else {
                    $('#next-page-paginate-suppliers').parent().removeClass('disabled');
                }
                if(response.prev_page_url == null) {
                    $('#prev-page-paginate-suppliers').parent().addClass('disabled');
                } else {
                    $('#prev-page-paginate-suppliers').parent().removeClass('disabled');
                }

                $.each(response.data, function (idx, item) {
                    let tr = `
                            <tr>
                                <td class="align-middle">${item.first_name} ${item.last_name}</td>
                                <td class="align-middle">${item.location.length > 0 ? item.location[0].location_name : '-'}</td>
                                <td class="align-middle">${item.email}</td>
                                <td class="align-middle">${moment(item.created_at).format("DD MMMM, YYYY")}</td>
                                <td class="align-middle">${item.location.length > 0 ? item.location[0].category.title : '-' }</td>
                                <td class="align-middle">${item.location.length > 0 ? item.location[0].size.value : '-' }</td>
                                <td class="align-middle">${item.location.length > 0 ? item.location[0].locationmaturity.level_name : '-' }</td>
                                <td class="align-middle">${item.location.length > 0 ? (item.location[0].security == 1 ? 'SI' : 'NO') : '-' }</td>
                                <td class="align-middle">
                                    <a href="/suppliers/${item.id}"
                                       class="btn btn-modal"
                                       style="color: #68C90D; border:1px solid #68C90D; border-radius:.4rem">
                                        <i class="fa fa-eye" style="color: #68C90D"></i>
                                        {{ __('message.view') }}
                                    </a>
                                    @can('delete existing supplier')
                                        <a href="/delete-supplier/${item.id}"
                                               onclick="return confirm('Are you sure you want to delete this supplier? All details associated with this supplier will be permanently removed.')"
                                               class="btn btn-modal mt-1"
                                               style="color: #E24042; border:1px solid #E24042; border-radius:.4rem;">
                                                <i class="fa fa-trash" style="color: #E24042"></i>
                                                {{ __('message.delete') }}
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                    `;
                    $('#suppliers-table tbody').append(tr);
                })
            }).fail((e) => {
                console.log('error')
            });
        }

        // DATA SUPPLIERS PENDING

        $('#paginate-by-suppliers-pending').change(function () {
            $('#current-page-suppliers').val(1);

            getSuppliersPendingTable();
        })

        $('#prev-page-paginate-suppliers-pending').click(function (e) {
            e.preventDefault();

            if($('#current-page-suppliers-pending').val() == 1) {
                return;
            }

            let prevPage = parseInt($('#current-page-suppliers-pending').val()) - 1;
            $('#current-page-suppliers-pending').val(prevPage);

            getSuppliersPendingTable();
        })

        $('#next-page-paginate-suppliers-pending').click(function (e) {
            e.preventDefault();

            let nextPage = parseInt($('#current-page-suppliers-pending').val()) + 1;
            $('#current-page-suppliers-pending').val(nextPage)

            getSuppliersPendingTable();
        })

        function getSuppliersPendingTable() {
            let page = $('#current-page-suppliers-pending').val();
            let perPage = $('#paginate-by-suppliers-pending').val();

            $('#table-suppliers-pending tbody').html('');

            $.get('/supplier/data/get-paginate-pending?', {page,perPage})
                .done(function(response) {
                    $('#current-page-suppliers-pending').val(response.current_page)
                    if(response.next_page_url == null) {
                        $('#next-page-paginate-suppliers-pending').parent().addClass('disabled');
                    } else {
                        $('#next-page-paginate-suppliers-pending').parent().removeClass('disabled');
                    }
                    if(response.prev_page_url == null) {
                        $('#prev-page-paginate-suppliers-pending').parent().addClass('disabled');
                    } else {
                        $('#prev-page-paginate-suppliers-pending').parent().removeClass('disabled');
                    }

                    $.each(response.data, function (idx, item) {
                        let tr = `
                           <tr>
                                <td class="align-middle">${item.supplier_name}</td>
                                <td class="align-middle">${item.email}</td>
                                <td class="align-middle">`;
                        if(item.invitation_time == 1) {
                            tr += `First Time`;
                        } else if (item.invitation_time == 2) {
                            tr += `Second Time`;
                        } else {
                            tr += `Third Time`;
                        }
                        tr += `</td>
                            <td class="align-middle">${moment(item.created_at).format("DD MMMM, YYYY")}</td>

                        `;
                        if(item.invitation_time == 1) {
                            tr += `<td class="align-middle">${moment(item.expired_date).format("DD MMMM, YYYY")}</td>`;
                        } else if (item.invitation_time == 2) {
                            tr += `<td class="align-middle">${moment(item.second_expired_date).format("DD MMMM, YYYY")}</td>`;
                        } else {
                            tr += `<td class="align-middle">${moment(item.third_expired_date).format("DD MMMM, YYYY")}</td>`;
                        }
                    tr+= `
                        <td class="align-middle">
                            @can('re-invite invitation')
                                <a href="/resend-invitation/${item.id}"
                                   class="btn btn-outline-info  ">
                                    <i class="fa fa-repeat" aria-hidden="true"></i>
                                    {{ __('message.re_invite') }}
                                </a>
                            @endcan
                            @can('delete invited supplier')
                                <a href="/delete/invitation/${item.id}"
                                   class="btn btn-modal mt-1"
                                   style="color: #E24042; border:1px solid #E24042; border-radius:.4rem;">
                                    <i class="fa fa-trash" style="color: #E24042"></i>
                                    {{ __('message.delete') }}
                                </a>
                            @endcan
                        </td>
                    </tr>
                        `;
                        $('#table-suppliers-pending tbody').append(tr);
                    })
                }).fail((e) => {
                console.log('error')
            });
        }

        // DATA SUPPLIERS DELETE

        $('#paginate-by-suppliers-delete').change(function () {
            $('#current-page-suppliers').val(1);

            getSuppliersDeleteTable();
        })

        $('#prev-page-paginate-suppliers-delete').click(function (e) {
            e.preventDefault();

            if($('#current-page-suppliers-delete').val() == 1) {
                return;
            }

            let prevPage = parseInt($('#current-page-suppliers-delete').val()) - 1;
            $('#current-page-suppliers-delete').val(prevPage);

            getSuppliersDeleteTable();
        })

        $('#next-page-paginate-suppliers-delete').click(function (e) {
            e.preventDefault();

            let nextPage = parseInt($('#current-page-suppliers-delete').val()) + 1;
            $('#current-page-suppliers-delete').val(nextPage)

            getSuppliersDeleteTable();
        })

        function getSuppliersDeleteTable() {
            let page = $('#current-page-suppliers-delete').val();
            let perPage = $('#paginate-by-suppliers-delete').val();

            $('#table-suppliers-delete tbody').html('');

            $.get('/supplier/data/get-paginate-delete?', {page,perPage})
                .done(function(response) {
                    $('#current-page-suppliers-delete').val(response.current_page)
                    if(response.next_page_url == null) {
                        $('#next-page-paginate-suppliers-delete').parent().addClass('disabled');
                    } else {
                        $('#next-page-paginate-suppliers-delete').parent().removeClass('disabled');
                    }
                    if(response.prev_page_url == null) {
                        $('#prev-page-paginate-suppliers-delete').parent().addClass('disabled');
                    } else {
                        $('#prev-page-paginate-suppliers-delete').parent().removeClass('disabled');
                    }

                    $.each(response.data, function (idx, item) {
                        let tr = `
                           <tr>
                                <td class="align-middle" scope="row">${idx + 1}</td>
                                <td class="align-middle">${item.username}</td>
                                <td class="align-middle">${ item.location.length > 0 ? item.location[0].location_name : '-' }</td>
                                <td class="align-middle">${moment(item.deleted_at).format("DD MMMM, YYYY")}</td>
                                <td class="align-middle">${moment(item.deleted_at).format("h:mm:ss")}</td>
                                <td class="align-middle">${item.user_delete.first_name } ${item.user_delete.last_name}</td>
                                <td class="align-middle">
                                    <a href="/supplier/reinvitation/${item.id}" class="btn btn-outline-info mt-1">
                                        <i class="fa fa-repeat" aria-hidden="true"></i>
                                        {{ __('message.re_invite') }}
                                    </a>
                                </td>
                            </tr>`;

                        $('#table-suppliers-delete tbody').append(tr);
                    })
                }).fail((e) => {
                console.log('error')
            });
        }

        const dataGraphCategorySection = @json($dataGraphCategorySection);
        const dataGraphCategoryLegend = @json($dataGraphCategoryLegend);

        const config = {
            type: 'line',
            data: {
                datasets: [{
                    data: dataGraphCategorySection,
                    tension: 0,
                    borderColor: 'rgba(92, 167, 246, 1)', // Color de la línea
                    backgroundColor: 'rgba(92, 167, 246, 0.2)',
                }],
                labels: dataGraphCategoryLegend
            },
            options: {
                responsive: true,
                legend: {
                    display: false
                },
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: false,
                        text: 'Chart.js Line Chart'
                    }
                },
                scales: {
                    y: [{
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            stepSize: 10,
                        }
                    }]
                },
            },
        };

        // 5CA7F6

        const ctx = document.getElementById('company-category-chart');

        new Chart(ctx, config);
    </script>
@endsection
