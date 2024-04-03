@extends('layouts.app')

@section('title', 'Edit Company')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 edit_company_left_sec">
                @if (session('success'))
                    <div class=" alert alert-success"> {{ session('success') }} </div>
                @endif
                @if (session('error'))
                    <div class=" alert alert-success"> {{ session('error') }} </div>
                @endif
                <div class="profile_img">
                    @if ($brand->brand_logo != null)
                        <img id="showimage" src="{{ asset('images/client/brand' . '/' . $brand->brand_logo) }}"
                            class="rounded-circle" alt="Cinque Terre" width="200" height="200">
                    @endif
                    <p id="filename"></p>
                    <form action="{{ route('client.company.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-xs-3 browse_btn_edit_set">
                            <input type="file" name="image" onchange="showPreviewOne(event)" />
                        </div>
                        <span class="color_edit_comp" style="background:{{ $brand->primary_color }}"></span>
                        <span class="color_edit_comp1" style="background:{{ $brand->secondary_color }}"></span>
                        <a href="{{ route('client.edit.brand') }}" class="btn btn-primary customize_btn_set">Customize
                            Branding</a>
                        @error('image')
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
                </div>
            </div>
            <div class="col-md-8 edit_comp_rht_set">
                <div class="form-group">
                    <label>{{ __('message.Company Name') }}:</label>
                    <input type="text" id="cname" name="cname" class="form-control @error('cname') is-invalid @enderror"
                        value="{{ $company->name }}" placeholder="Enter the Company name">
                    @error('cname')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputCIF1">CIF</label>
                    <input type="text" class="form-control" id="cif" name="cif" value="{{ $company->cif }}">
                    @error('cif')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <select name="country" class="form-control selecttwodropdown" id="country">
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" @if ($company->contrty_id == $country->id) selected @endif>
                                {{ $country->name }}</option>
                        @endforeach
                    </select>
                    @error('country')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="country">State</label>
                    <select name="state" class="form-control selecttwodropdown" id="state">
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}" @if ($company->state_id == $state->id) selected @endif>
                                {{ $state->name }}</option>
                        @endforeach
                    </select>
                    @error('state')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="country">City</label>
                    <select name="city" class="form-control selecttwodropdown" id="city">
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" @if ($company->city_id == $city->id) selected @endif>
                                {{ $city->name }}</option>
                        @endforeach
                    </select>
                    @error('city')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address"
                        value="{{ $company->address }}">
                    @error('address')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputaddress1">Postal Code</label>
                    <input type="text" class="form-control" name="postal_code" id="postal_code"
                        value="{{ $company->postalcode }}">
                    @error('postal_code')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="csector">Company Sector</label>
                    <select name="csector[]" class="form-control selecttwodropdown" id="csector" multiple>
                        @foreach ($sectors as $sector)
                            @foreach ($company->sectorName($company->company_size_id) as $companysector)
                                <option value="{{ $sector->id }}" @if ($companysector->id == $sector->id) selected @endif>
                                    {{ $sector->title }} </option>
                            @endforeach
                        @endforeach
                    </select>
                    @error('csector')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="csize">Company Size</label>
                    <select name="csize" class="form-control selecttwodropdown" id="csize">
                        @foreach ($sizes as $size)
                            <option value="{{ $size->id }}" @if ($company->company_size_id == $size->id) selected @endif>
                                {{ $size->value }}</option>
                        @endforeach
                    </select>
                    @error('csize')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="maturity">Company Maturity</label>
                    <select name="maturity" class="form-control selecttwodropdown" id="maturity">
                        @foreach ($maturities as $maturity)
                            <option value="{{ $maturity->id }}" @if ($company->maturity_level_id == $maturity->id) selected @endif>
                                {{ $maturity->level_name }}</option>
                        @endforeach
                    </select>
                    @error('maturity')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="security">Company Security</label>
                    <select name="security" class="form-control selecttwodropdown" id="security">
                        <option value="1" @if ($company->security == 1) selected @endif>Yes</option>
                        <option value="0" @if ($company->security == 0) selected @endif>No</option>
                    </select>
                    @error('security')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <a href="{{ route('client.profile.view') }}" class="btn btn-primary save_edit_prf"> cancel</a>
                <button type="submit" class="btn btn-primary save_edit_prf">Save</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        function showPreviewOne(event) {
            if (event.target.files.length > 0) {
                let src = URL.createObjectURL(event.target.files[0]);
                let preview = document.getElementById("showimage");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
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

@endsection
