<div class="header">
    <a href="#" id="menu-action">
        <div class="show-hide d-none">
            <x-logo-awdit />
        </div>
        <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1 5.875H14.5" stroke="#1B2E4B" stroke-opacity="0.6" stroke-width="1.875" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M1 1.375H14.5" stroke="#1B2E4B" stroke-opacity="0.6" stroke-width="1.875" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M1 10.375H14.5" stroke="#1B2E4B" stroke-opacity="0.6" stroke-width="1.875" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

    </a>
    <nav class="navbar navbar-expand-lg" style="padding: 0">
        <a class="navbar-brand" href="{{ url('/home') }}">
            <div class="show-logo-2">
                <x-logo-awdit scaleX="0.6823" scaleY="0.6818" />
            </div>
        </a>
        @php
            $user = App\Models\User::find(Auth::user()->id);
            $questionnaire = App\Models\Questionnaire::where('created_by', $user->id)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        @endphp






       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1 5.875H14.5" stroke="#1B2E4B" stroke-opacity="0.6" stroke-width="1.875" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M1 1.375H14.5" stroke="#1B2E4B" stroke-opacity="0.6" stroke-width="1.875" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M1 10.375H14.5" stroke="#1B2E4B" stroke-opacity="0.6" stroke-width="1.875" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Example single danger button -->
            <div class="mr-0 ml-auto"></div>
            <ul class="navbar-nav h-100">
                <div class="btn-group border-right pr-2">
                    <button type="button" class="btn demo-questionnaire-btn dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Demo Questionnaire
                    </button>
                    <div class="dropdown-menu">
                        @foreach ($questionnaire as $questionnary)
                            <div class="questionary_drp_cont">
                                <div class="left_drp_head">
                                    <h4>{{ $questionnary->name }}</h4>
                                    <p>
                                        @if ($questionnary->status == 1)
                                            {{ __('message.active') }}
                                        @else
                                            {{ __('message.inactive') }}
                                        @endif
                                    </p>
                                </div>
                                <div class="rht_drp_head">
                                    <a href="{{ route('client.questionnarie.show', $questionnary->id) }}"
                                        class="btn btn-primary">{{ __('message.view') }}</a>
                                    <a href="{{ route('client.questionnaire.setting', $questionnary->id) }}"
                                        class="btn btn-primary">{{ __('message.setting') }}</a>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                        @endforeach
                        <div class="questionary_drp_cont">
                            <button  class="btn btn-primary btn-block" data-toggle="modal" data-target="#questionnaire">{{ __('message.new_quiz') }}</button>
                        </div>
                    </div>
                </div>
                <div class="btn-group pl-2 pr-2">
                    <button type="button" class="btn dropdown-toggle h-100" data-toggle="dropdown" aria-haspopup="true"
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
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle profile_drp_img" href="#" id="navbarDropdown"
                         role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <img src="{{ asset('images/client/profile' . '/' . $user->image) }}">
                     </a>
                     <div class="dropdown-menu p-3" aria-labelledby="navbarDropdown">
                         <div class="az-header-profile text-center">
                             <div class="az-img-user">
                                 <img src="{{ asset('images/client/profile' . '/' . $user->image) }}" height="70px">
                             </div><!-- az-img-user -->
                             <h6 class="mt-2 mb-0">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h6>
                             <span>{{ auth()->user()->email }}</span>
                         </div>
                         <a class="btn btn-modal-update btn-block" href="{{ route('client.profile.view') }}">{{ __('message.my_profile') }}</a>
                         <a class="dropdown-item btn btn-primary my-2 text-center" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                             {{ __('message.Logout') }}
                         </a>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                             @csrf
                         </form>
                     </div>
                 </li>
            </ul>
        </div>
    </nav>
</div>
<div class="modal fade create_questionnaire_pop" id="questionnaire" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-center">{{ __('message.message_title_new_questionnaire') }}</h4>
                <p class="text-center">{{ __('message.message_choose_question_new_questionnaire') }}</p>
            </div>
            <div class="modal-body">
                <div class="cr_qus_nm">
                    @foreach ($questionnaire as $questionnary)
                        <a href="{{ route('client.import.questionnaire', $questionnary->id) }}"
                            class="bg_btn view_btn">{{ $questionnary->name }}</a>
                    @endforeach
                </div>
                @can('create questionnaire')
                    <div class="new_cr_btn">
                        <a href="{{ route('client.questionnarie.create') }}"
                            class="bg_btn view_btn">{{ __('message.new_quiz') }}</a>
                    </div>
                @endcan
            </div>
        </div>
    </div>
</div>
