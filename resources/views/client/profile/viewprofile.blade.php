@extends('layouts.app')
@section('title', 'User Profile')
@section('content')
    <div style="padding-left: 80px">
        <div class="global_wrapper ">
            <x-title-section title="{{ __('message.user') }}" section="{{ __('message.account') }}" subtitle="{{ __('message.account') }}" />
            <div class="row">
                <div class="col-12">
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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <div class="view-profile-two-cards row align-items-stretch justify-content-between p-0">
                <div class="col-12 col-md-6">
                    <x-view-profile-edit-card title="{{ __('message.company_branding') }}" class="with-margin-top-auto" dataTarget="#edit_brand">
                        <div class="view-profile-edit-logo">
                            <img src="{{ asset('images/client/brand' . '/' . $brand->brand_logo) }}" alt="Logo" height="100px" width="auto">
                            <div class="logo-awdit">Awdit</div>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center ml-auto">
                            <span class="color_edit_comp"></span>
                            <p class="text-uppercase font-weight-bold" style="font-size:.6rem">{{ __('message.primary_color') }}</p>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <span class="color_edit_comp1"></span>
                            <p class="text-uppercase font-weight-bold" style="font-size:.6rem">{{ __('message.secondary_color') }}</p>
                        </div>
                    </x-view-profile-edit-card>
                </div>
                <div class="col-12 col-md-6">
                    <x-view-profile-edit-card title="{{ __('message.company_info') }}" dataTarget="#edit_company">
                        {{-- <a href="{{ route('client.company.edit') }}" class="btn btn-primary">Edit</a>
                        {{ status() }} --}}
                        @if ($client->role_assigner == null)
                            <div class="col-6 border-right pl-0">
                                <div class="font-weight-bold mb-2" style="font-size: 1.2rem">Awdit</div>
                                <div class="mb-1"><strong>CIF:</strong> {{ $company->cif }} </div>
                                <div class="mb-1"><strong>{{ __('message.company_sector') }}:</strong>
                                    @foreach ($company->sectorName($company->company_sector_id) as $comsector)
                                        {{ $comsector->title }}
                                    @endforeach
                                </div>
                                <div class="mb-1"><strong>{{ __('message.company_size') }}:</strong> {{ $company->companySize->value }}</div>
                                <div class="mb-1"><strong>{{ __('message.maturity_level') }}:</strong> {{ $company->companyMaturity->level_name }}
                                </div>
                                <div class="mb-1"><strong>{{ __('message.security_department') }}:</strong>
                                    @if ($company->security_department == 1)
                                        {{ __('message.yes') }}
                                    @else
                                        {{ __('message.no') }}
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="font-weight-bold mb-2"
                                    style="color:#B4B6BE;text-transform:uppercase;font-size:.7rem">{{ __('message.address') }}</div>
                                <div class="mb-1"><strong>{{ __('message.address') }}: </strong>{{ $company->address }}</div>
                                <div class="mb-1"><strong>{{ __('message.postal_code') }}:</strong> {{ $company->postalcode }}</div>
                                <div class="mb-1"><strong>{{ __('message.state') }}:</strong> {{ $company->state->name }}</div>
                                <div class="mb-1"><strong>{{ __('message.city') }}:</strong> {{ $company->city->name }}</div>
                                <div class="mb-1"><strong>{{ __('message.Country') }}:</strong> {{ $company->country->name }}</div>

                            </div>
                        @else
                            <div class=""></div>
                        @endif
                    </x-view-profile-edit-card>
                </div>
            </div>

            <div class="view-profile-two-cards row align-items-stretch justify-content-between mt-3 p-0">
                <div class="col-12 overflow-auto">
                    <x-view-profile-edit-card title="{{ __('message.responsable_in_questionnaire') }}" dataTarget="#edit_responsable"
                        class="no-padding" :showBorderBottom="false">
                        <table class="table ">
                            <thead>
                                <tr class="border-top: none">
                                    <th scope="col">{{ __("message.photo") }}</th>
                                    <th scope="col">{{ __('message.name') }}</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">{{ __('message.Job Title') }}</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">{{ __('message.Action') }}</th>
                                </tr>
                            </thead>

                            <tbody class=" align-items-center mr-3 ml-0 pr-2  mt-2 mb-2">
                                <td class=" align-middle"><img style="width: 50px" class="rounded-circle"
                                        src=" {{ asset('images/client/profile') . '/' . $client->image }}"></td>
                                <td class=" align-middle">{{ $client->first_name }} {{ $client->last_name }}</td>
                                <td class=" align-middle">{{ $client->email }}</td>
                                <td class=" align-middle">{{ $client->job_title }}</td>

                                <td class=" align-middle">{{ $role->name }}</td>
                                <td class=" align-middle">
                                    <button type="button" class="btn btn-change-password d-flex align-items-center"
                                        data-toggle="modal" data-target="#change_password">
                                        <i class="fa fa-lock"></i>
                                        <span>{{ __('message.change_password') }}</span>
                                    </button>
                                </td>
                            </tbody>
                        </table>
                    </x-view-profile-edit-card>
                    <br>
                </div>
            </div>
        </div>
    </div>

    {{-- add role modal start --}}
    <div class="modal" id="addrolemodal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Role</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('client.create.client') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" name="email" class="form-control" id="email"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="userrole">Select Role:</label>
                            <select class="form-control selecttwodropdown" name="role" id="userrole">
                                <option></option>
                                @foreach ($userroles as $role)
                                    <option value="{{ $role->id }}"> {{ $role->name }} </option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" rows="6" style="resize:none" readonly></textarea>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary brand-secondary-color"
                            id="userCreate">save</button>
                        <button type="button" class="btn btn-danger brand-secondary-color"
                            data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- add role modal end --}}
    {{-- edit role modal start --}}
    <div class="modal" id="editpendingclientrole">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Role</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('client.edit.client') }}" method="post">
                    <!-- Modal body -->
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="userid" id="userid">
                        <div class="form-group">
                            <label for="sel1">Select Role:</label>
                            <select class="form-control selecttwodropdown" name="role" id="edit_userrole">
                                @foreach ($userroles as $role)
                                    <option value="{{ $role->id }}"> {{ $role->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="usr">Description:</label>
                            <textarea class="form-control" rows="5" readonly id="edit_description"></textarea>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="userCreate">save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- edit role mddal end --}}
    {{-- update role modal start --}}
    <div class="modal" id="alert_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="modal-title" id="alert_type"> </h4>
                    <div class="text-success" id="success"></div>
                    <div class="text-danger" id="danger"></div>
                </div>
            </div>
        </div>
    </div>
    {{-- update role modal end --}}
    {{-- EDIT BRAND --}}
    <x-modal title="Edit Branding" id="edit_brand" action="{{ route('client.company.update.branding') }}" method="POST" specialMethod="PUT" enctype="multipart/form-data">

        <div class="d-flex justify-content-center align-items-center"
            style="margin-right: 2rem; margin-left:2rem;">
            <img id="showimage" src="{{ asset('images/client/brand' . '/' . $brand->brand_logo) }}" alt="Logo"
                style="max-height: 100px; border: 1px solid rgb(151, 151, 151);
                max-height: 132px;
                padding: 17px 35px;">
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <label>No File Selected</label>
        </div>


        <div class="d-flex justify-content-center align-items-center">
            {{-- <input id="fileButton" class="btn btn-generate-report btn-summary w-50" --}}
            {{-- style="margin-top: .8rem; margin-bottom: 4rem; height: 0px;width:0px; overflow:hidden;" type="file" name="image" onchange="showPreviewOne(event)"/> --}}
            <input id="fileButton" onchange="showPreviewOne(event)" type="file" class="file-brand-input w-50"
                style="margin-top: .8rem; margin-bottom: 4rem" name="image" onchange="showPreviewOne(event)">


        </div>

        <div class="d-flex justify-content-center align-items-center">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <input class="color_edit_comp" type="color" id="pcolor" name="pcolor"
                    value="{{ $brand->primary_color }}">
                <p class="text-uppercase font-weight-bold " style="font-size:.6rem">PRIMARY</p>
            </div>
            <div class="col-2"></div>
            <div class="d-flex flex-column justify-content-center align-items-center">
                <input class="color_edit_comp1" type="color" id="scolor" name="scolor"
                    value="{{ $brand->secondary_color }}">
                <p class="text-uppercase font-weight-bold " style="font-size:.6rem">SECONDARY</p>
            </div>
        </div>
        <script>
            function showPreviewOne(event) {
                // console.log('asd');
                if (event.target.files.length > 0) {
                    let src = URL.createObjectURL(event.target.files[0]);
                    let preview = document.getElementById("showimage");
                    preview.src = src;
                    preview.style.display = "block";
                    console.log(preview.src);
                }
            }
            $(document).ready(function() {
                $('#pcolor').on('change', function() {
                    var pcolor = $(this).val();
                    $('#spcolor').css('background', pcolor);
                })
                $('#scolor').on('change', function() {
                    var scolor = $(this).val();
                    $('#sscolor').css('background', scolor);
                })
            });

            // document.getElementById('fileButton').addEventListener('change', showPreviewOne);
        </script>
    </x-modal>
    {{-- EDIT COMPANY --}}
    <x-modal title="Edit Company" action="{{ route('client.company.update') }}" specialMethod="PUT" id="edit_company" saveButtonName="Save">
        <input type="hidden" name="company_id" value="{{ $company->id }}">
        <div class="row">
            <div class="col-7">
                <x-edit-company-input title="{{ __('message.Company Name') }}" value="{{ $company->name }}"
                    id="cname" name="cname" placeholder="Enter the Company name"
                    extraClass="@error('cname') is-invalid @enderror"></x-edit-company-input>
            </div>
            <div class="col-5">
                <x-edit-company-input title="CIF" value="{{ $company->cif }}" id="cif" name="cif"
                    for="exampleInputCIF1">
                </x-edit-company-input>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <x-edit-company-input title="ADDRESS" name="address" value="{{ $company->address }}"></x-edit-company-input>
            </div>

        </div>
        <div class="row">
            <div class="col-6">
                <x-edit-company-input id="city" name="city" title="CITY" value="{{ $company->city->name }}" select="true">
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}" @if ($company->city_id == $city->id) selected @endif>
                            {{ $city->name }}</option>
                    @endforeach
                </x-edit-company-input>
            </div>
            <div class="col-6">
                <x-edit-company-input title="POSTAL CODE" name="postal_code" value="{{ $company->postalcode }}"></x-edit-company-input>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <x-edit-company-input id="state" name="state" title="STATE" value="{{ $company->state->name }}" select="true">
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}" @if ($company->state_id == $state->id) selected @endif>
                            {{ $state->name }}</option>
                    @endforeach
                </x-edit-company-input>
            </div>
            <div class="col-6">
                <x-edit-company-input id="country" name="country" title="COUNTRY" value="{{ $company->country->id }}"
                    select="true">
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" @if ($company->contrty_id == $country->id) selected @endif>
                            {{ $country->name }}</option>
                    @endforeach
                </x-edit-company-input>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <x-edit-company-input title="MATURITY" name="maturity" select="true">
                    @foreach ($maturities as $maturity)
                        <option value="{{ $maturity->id }}" @if ($company->maturity_level_id == $maturity->id) selected @endif>
                            {{ $maturity->level_name }}</option>
                    @endforeach
                </x-edit-company-input>
            </div>
            <div class="col-4">
                <x-edit-company-input title="SIZE" name="csize" select="true">
                    @foreach ($sizes as $size)
                        <option value="{{ $size->id }}" @if ($company->company_size_id == $size->id) selected @endif>
                            {{ $size->value }}</option>
                    @endforeach
                </x-edit-company-input>
            </div>
            <div class="col-4">
                <x-edit-company-input title="SECURITY" name="security" select="true">
                    <option value="1" @if ($company->security == 1) selected @endif>Yes</option>
                    <option value="0" @if ($company->security == 0) selected @endif>No</option>
                </x-edit-company-input>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <x-edit-company-input title="Sector" name="csector[]" id="csector" for="csector" select="true"
                    multiple="true" extraClasses="selecttwodropdown sector_multiple_dropdown">
                    @foreach ($sectors as $sector)
                        @foreach ($company->sectorName($company->company_size_id) as $companysector)
                            <option value="{{ $sector->id }}" @if ($companysector->id == $sector->id) selected @endif>
                                {{ $sector->title }} </option>
                        @endforeach
                    @endforeach
                </x-edit-company-input>
            </div>
        </div>


    </x-modal>
    {{-- CHANGE PASSWORD --}}
    <x-modal title="Change Password" id="change_password" saveButtonName="Change password">
        <x-edit-company-input title="CURRENT PASSWORD">
        </x-edit-company-input>
        <x-edit-company-input title="NEW PASSWORD">
        </x-edit-company-input>
        <x-edit-company-input title="CONFIRM PASSWORD">
        </x-edit-company-input>
    </x-modal>
    {{-- EDIT RESPONSABLE --}}
    <x-modal title="Edit Responsable" id="edit_responsable">
        <div class="d-flex justify-content-center align-items-center"
            style="  height: 100px; margin-right: 2rem; margin-left:2rem;">
            <img class="rounded-circle h-100" src=" {{ asset('images/client/profile') . '/' . $client->image }}">
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <div>
                No file selected
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <button type="button" class="btn btn-generate-report btn-summary w-50"
                style="margin-top: .8rem; margin-bottom: 4rem">
                Select a file
            </button>
        </div>

        <x-edit-company-input title="first name" value="{{ $client->first_name }}">
        </x-edit-company-input>
        <x-edit-company-input title="last name" value="{{ $client->last_name }}">
        </x-edit-company-input>
        <x-edit-company-input title="job title" value="{{ $client->job_title }}">
        </x-edit-company-input>
    </x-modal>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#country').change(function() {
                var countryID = $(this).val();
                url = "{{ route('client.get.state', ':id') }}";
                url = url.replace(':id', countryID);
                if (countryID) {
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(res) {
                            if (res) {
                                $("#state").empty();
                                $("#state").append('<option>Select</option>');
                                $.each(res, function(key, value) {
                                    $("#state").append('<option value="' + value.id +
                                        '">' + value.name + '</option>');
                                });

                            } else {
                                $("#state").empty();
                            }
                        }
                    });
                } else {
                    $("#state").empty();
                    $("#city").empty();
                }
            });

            $('#state').on('change', function() {
                var stateID = $(this).val();
                url = "{{ route('client.get.city', ':id') }}";
                url = url.replace(':id', stateID);
                if (stateID) {
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(res) {
                            console.log(res.length);
                            if (res) {
                                $("#city").empty();
                                $("#city").append('<option>Select</option>');
                                $.each(res, function(key, value) {
                                    $("#city").append('<option value="' + value.id +
                                        '">' + value.name + '</option>');
                                });

                            } else {
                                $("#city").empty();
                            }
                        }
                    });
                } else {
                    $("#city").empty();
                }

            });
        });
    </script>

    <script>
        $(".edit_role_btn").click(function(e){
            e.preventDefault();

            var id = $(this).attr('id');
            $('#userid').val(id);
            $("#editrolemodal").modal('show');
        });
    </script>
@endsection
