<div class="drp_option d-flex step_one top_sec">
    <div class="input-group w-30 mr-20">
        <select name="MoSMif" class="form-control" id="MoSMif_drp1" data-width="100%"
            data-minimum-results-for-search="Infinity">
            <option>{{ __('message.filter') }} {{ __('message.by') }} {{ __('message.questionnaire') }}</option>
            <option value="All">All</option>
            <option value="1">Done</option>
            <option value="0">Not Done</option>
        </select>
    </div>
    <div class="input-group w-30 mr-20">
        @php $maturiies = getMaturity() @endphp
        <select name="maturity" class="form-control" id="maturity" data-width="100%"
            data-minimum-results-for-search="Infinity">
            <option value="">{{ __('message.filter') }} {{ __('message.by') }} {{ __('message.questionnaire') }} {{ __('message.level') }}</option>
            <option value="all">{{ __('message.all') }}</option>
            @foreach ($maturiies as $maturity)
                <option value="{{ $maturity->id }}">{{ $maturity->level_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group w-30 mr-20">
        @php $suppliers = getAllSuppliers() @endphp
        <select name="with_search_drp" class="form-control" id="with_search_drp">
            <option value="">{{ __('message.filter') }} {{ __('message.by') }} {{ __('message.Supplier') }}</option>
            <option value="All">{{ __('message.all') }}</option>
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->getSupplierFullName() }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group w-30 mr-20 ">
        <input name="datepicker" class="form-control" id="datefilter" type="date" value=""
            placeholder="Filter by Date" autocomplete="off">
    </div>
    {{-- <div class="calender mr-20">
        <input id="datefilter" type="date" name="datepicker">
    </div> --}}
    <div class="w-30 mr-20  ml-auto ">
        <div class="btn btn-primary btn-modal-update showFilters">
            <span class="btn-text">
                <i class="fa fa-sliders"></i>
                {{ __('message.show_more_filter') }}
            </span>
            <span class="btn-text-alt d-none">
                <i class="fa fa-sliders"></i>
               {{ __('message.hide_more_filter') }}
            </span>
        </div>
    </div>
</div>
{{-- first line header filter end --}}
{{-- second line header filter start --}}
<div id="filter-container" class="drp_option step_one bottom_sec hide-filters">
    <div class="input-group w-30 mr-20">
        @php $countries = getCountries()@endphp
        <select name="country" class="form-control" id="country">
            <option value="">{{ __('message.Country') }}</option>
            <option value="all">{{ __('message.all') }}</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group w-30 mr-20">
        @php $states =  getStates() @endphp
        <select name="state" class="form-control" id="state">
            <option value="">{{ __('message.state') }}</option>
        </select>
    </div>
    <div class="input-group w-30 mr-20">
        @php $cities =  getCity() @endphp
        <select name="city" class="form-control" id="city">
            <option value="">{{ __('message.city') }}</option>
        </select>
    </div>
    <div class="input-group w-30 mr-20">
        @php $categories = getCategory() @endphp
        <select name="category" class="form-control" id="category" data-width="100%"
            data-minimum-results-for-search="Infinity">
            <option value="">{{ __('message.category') }}</option>
            <option value="all">{{ __('message.all') }}</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group w-30 mr-20">
        @php $sizes = getSize() @endphp
        <select name="size" class="form-control" id="size" data-width="100%"
            data-minimum-results-for-search="Infinity">
            <option value="">{{ __('message.size') }}</option>
            <option value="all">{{ __('message.all') }}</option>
            @foreach ($sizes as $size)
                <option value="{{ $size->id }}">{{ $size->value }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group w-30 mr-20">
        <select name="security" class="form-control" id="security" data-width="100%"
            data-minimum-results-for-search="Infinity">
            <option value="">{{ __('message.security') }}</option>
            <option value="all">{{ __('message.all') }}</option>
            <option value="1">{{ __('message.yes') }}</option>
            <option value="0">{{ __('message.no') }}</option>
        </select>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.showFilters').click(function() {
            $('#filter-container').toggleClass('show-filters hide-filters');
            $('.showFilters .btn-text, .showFilters .btn-text-alt').toggleClass('d-none');
        });
    });
</script>
{{-- filter  header display  end --}}
