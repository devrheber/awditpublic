<div class="header">
    <a href="#" id="menu-action">
        <div class="show-hide d-none">
            <x-logo-awdit />

        </div>
        <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 5.875H14.5" stroke="#1B2E4B" stroke-opacity="0.6" stroke-width="1.875" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M1 1.375H14.5" stroke="#1B2E4B" stroke-opacity="0.6" stroke-width="1.875" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M1 10.375H14.5" stroke="#1B2E4B" stroke-opacity="0.6" stroke-width="1.875" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg>



    </a>
    <nav class="navbar navbar-expand-lg" style="padding: 0">
        <a class="navbar-brand" href="{{ url('supplier/home') }}">
            <div class="show-logo-2">
                <x-logo-awdit scaleX="0.6823" scaleY="0.6818" />
            </div>
        </a>
        @php
            $user = App\Models\Supplier::find(Auth::user()->id);
            $locations = App\Models\SupplierLocation::where('supplier_id', $user->id)
                ->orderBy('created_at', 'DESC')
                ->take(3)
                ->get();
            $questionnaires = App\Models\AssignQuestionary::where('supplier_id', $user->id)
                ->orderBy('created_at', 'DESC')
                ->take(3)
                ->get();

        @endphp


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 5.875H14.5" stroke="#1B2E4B" stroke-opacity="0.6" stroke-width="1.875"
                    stroke-linecap="round" stroke-linejoin="round" />
                <path d="M1 1.375H14.5" stroke="#1B2E4B" stroke-opacity="0.6" stroke-width="1.875"
                    stroke-linecap="round" stroke-linejoin="round" />
                <path d="M1 10.375H14.5" stroke="#1B2E4B" stroke-opacity="0.6" stroke-width="1.875"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>

        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Example single danger button -->
            <div class="mr-0 ml-auto"></div>
            <ul class="navbar-nav">


                <div class="btn-group border-right pr-2">
                    <button type="button" class="btn demo-questionnaire-btn dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        {{ __('message.questionnaires') }}
                    </button>
                    <div class="dropdown-menu">
                        @foreach ($questionnaires as $questionary)
                            <div class="questionary_drp_cont">
                                <a href="{{ route('supplier.questionary.details', $questionary->id) }}"
                                    class="btn btn-primary">
                                    {{ $questionary->questionnaire->name }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="btn-group border-right pr-2">
                    <button type="button" class="btn demo-questionnaire-btn dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        {{ __('message.locations') }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($locations as $location)
                            <div class="questionary_drp_cont">
                                <div class="left_drp_head">
                                    <img src="{{ asset('images/supplier/location') . '/' . $location->location_image }}"
                                        width="50px" height="50px" alt="locationimage">
                                </div>
                                <div class="rht_drp_head">
                                    <h6>{{ $location->location_name }}</h6>
                                    <p>
                                        @if ($location->status == 1)
                                            {{ __('message.active') }}
                                        @else
                                            {{ __('message.pending') }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                        @endforeach
                        <div class="questionary_drp_cont">
                            <a href="{{ route('supplier.location.create') }}" class="btn btn-primary">
                                {{ __('message.new_location') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="btn-group pl-2 pr-2">
                    <button type="button" class="btn dropdown-toggle " data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        @if (session('locale') == 'en')
                            {{ __('message.English') }}
                        @elseif(session('locale') == 'es')
                            {{ __('message.Spanish') }}
                        @elseif(session('locale') == 'ca')
                            {{ __('message.Catalan') }}
                        @else
                            {{ __('message.Language') }}
                        @endif
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ url('lang/en') }}">{{ __('message.English') }}</a>
                        <a class="dropdown-item" href="{{ url('lang/es') }}">{{ __('message.Spanish') }}</a>
                        <a class="dropdown-item" href="{{ url('lang/ca') }}">{{ __('message.Catalan') }}</a>
                    </div>
                </div>

            </ul>
        </div>
    </nav>
</div>
