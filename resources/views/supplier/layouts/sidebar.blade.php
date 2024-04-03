<div class="sidebar">
    @php
        $user = App\Models\Supplier::find(Auth::user()->id);

    @endphp
    <a class="profile_drp_img profile-drp-img-deactive" href="#" style="text-align: center; margin-top:1rem">
        @if ($user->image)
            <img src="{{ asset('images/supplier/profile' . '/' . $user->image) }}">
        @else
            <img src="{{ asset('images/profile_pic.png') }}">
        @endif
    </a>
    <p></p>

    <button id="profile-button-action" class="btn btn-light text-dark profile-btn w-100 d-none"
        style="border: none; margin:0">
        <div class="row align-items-start">
            <div class="col-10" style="text-align: start">
                <a class="font-weight-bold profile_button_text">{{ $user->username }}</a>
                <p style="margin: 0;"><small class=" profile_button_text">{{ $user->email }}</small></p>
            </div>
            <div class="col-2" style="color: #F2F2F2">
                <i class="fa fa-chevron-down"></i>
            </div>
        </div>
    </button>
    <div>
        <ul class="side-bar-profile show-hide d-none">
            <li class="@if (request()->is('supplier/view-profile*')) sidebar-selected @endif"><a
                    href={{ route('supplier.profile.view') }}><svg width="17" height="18" viewBox="0 0 17 18"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M15.2222 17V15.2222C15.2222 13.2585 13.6303 11.6666 11.6667 11.6666H4.55556C2.59188 11.6666 1 13.2585 1 15.2222V17"
                            fill="#1B2E4B" fill-opacity="0.05" />
                        <path
                            d="M15.2222 17V15.2222C15.2222 13.2585 13.6303 11.6666 11.6667 11.6666H4.55556C2.59188 11.6666 1 13.2585 1 15.2222V17"
                            stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <circle cx="8.1111" cy="4.55556" r="3.55556" fill="#1B2E4B" fill-opacity="0.05"
                            stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <span>
                        @if (request()->is('view-profile*'))
                            Account
                        @else
                            {{ __('message.My Profile') }}
                        @endif
                    </span></a></li>

            <li><a href={{ route('supplier.change.password') }}><svg width="18" height="18" viewBox="0 0 18 18"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M8.15659 2.68677H2.59035C1.71203 2.68677 1 3.39879 1 4.27712V15.4096C1 16.2879 1.71203 16.9999 2.59035 16.9999H13.7228C14.6012 16.9999 15.3132 16.2879 15.3132 15.4096V9.84336"
                            fill="#1B2E4B" fill-opacity="0.05" />
                        <path
                            d="M8.15659 2.68677H2.59035C1.71203 2.68677 1 3.39879 1 4.27712V15.4096C1 16.2879 1.71203 16.9999 2.59035 16.9999H13.7228C14.6012 16.9999 15.3132 16.2879 15.3132 15.4096V9.84336"
                            stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M14.1205 1.49406C14.7792 0.835314 15.8473 0.835314 16.506 1.49406C17.1647 2.1528 17.1647 3.22084 16.506 3.87959L8.95182 11.4338L5.77112 12.2289L6.56629 9.04824L14.1205 1.49406Z"
                            fill="#1B2E4B" fill-opacity="0.05" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>{{ __('message.Change Password') }}</span></a></li>
            <li><a href="{{ route('supplier.logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();"><svg
                        width="18" height="20" viewBox="0 0 18 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M6.33333 19H2.77778C1.79594 19 1 18.1046 1 17V3C1 1.89543 1.79594 1 2.77778 1H6.33333"
                            fill="#1B2E4B" fill-opacity="0.05" />
                        <path d="M6.33333 19H2.77778C1.79594 19 1 18.1046 1 17V3C1 1.89543 1.79594 1 2.77778 1H6.33333"
                            stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5555 15L17 10L12.5555 5" fill="#1B2E4B"
                            fill-opacity="0.05" />
                        <path d="M12.5555 15L17 10L12.5555 5" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17 10H6.33337H17Z" fill="#1B2E4B"
                            fill-opacity="0.05" />
                        <path d="M17 10H6.33337" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>{{ __('message.Logout') }}</span></a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </ul>
    </div>
    <hr class="show-hide d-none" style="padding: 10px; margin: 10px">

    <ul>
        <li class="@if (request()->is('supplier/questionnaire*')) sidebar-selected @endif"><a
                href="{{ route('supplier.quetionnaire.index') }}"><svg width="19" height="20"
                    viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M17.1371 13.5492V6.3772C17.1364 5.73727 16.7948 5.1462 16.2406 4.82624L9.96506 1.24022C9.4103 0.919927 8.72681 0.919927 8.17205 1.24022L1.89651 4.82624C1.34231 5.1462 1.00066 5.73727 1 6.3772V13.5492C1.00066 14.1892 1.34231 14.7802 1.89651 15.1002L8.17205 18.6862C8.72681 19.0065 9.4103 19.0065 9.96506 18.6862L16.2406 15.1002C16.7948 14.7802 17.1364 14.1892 17.1371 13.5492Z"
                        fill="#1B2E4B" fill-opacity="0.05" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M1.24207 5.44482L9.06856 9.97218L16.8951 5.44482" stroke="#1B2E4B" stroke-opacity="0.9"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9.06861 19V9.9632" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg><span>{{ __('message.Questionnaire') }}</span></a>
        </li>
        {{-- <li><a href="{{ route('supplier.quetionnaire.index')}}"><i class="fa fa-list"></i><span>Questionnarie</span></a></li> --}}

        <li class="@if (request()->is('supplier/ticket*')) sidebar-selected @endif"><a href="{{ route('supplier.ticket.inbox') }}"><svg width="18" height="18" viewBox="0 0 18 18"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M17 11.6667C17 12.6485 16.2041 13.4444 15.2222 13.4444H4.55556L1 17V2.77778C1 1.79594 1.79594 1 2.77778 1H15.2222C16.2041 1 17 1.79594 17 2.77778V11.6667Z"
                        fill="#1B2E4B" fill-opacity="0.05" stroke="black" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg><span>{{ __('message.Messages') }}</span></a>
        </li>

        <li ><a href="#"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle cx="9" cy="9" r="8" fill="#1B2E4B" fill-opacity="0.05"
                        stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></circle>
                    <circle cx="9.00005" cy="8.99999" r="3.2" fill="#1B2E4B" fill-opacity="0.05"
                        stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></circle>
                    <path d="M3.34399 3.34399L6.73599 6.73599" stroke="#1B2E4B" stroke-opacity="0.9"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M11.264 11.264L14.656 14.656" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M11.264 6.73599L14.656 3.34399" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M11.264 6.73599L14.088 3.91199" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M3.34399 14.656L6.73599 11.264" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                </svg><span>FAQ’s</span></a></li>
        {{-- <li class="nav-item has-sub">
            <a class="nav-link" data-toggle="collapse" href="#sub1" aria-expanded="false" aria-controls="sub1">
                <i class="fa fa-language"></i>
                Language <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
            </a>
            <ul class="sub collapse" id="sub1">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('lang/en') }}">English</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('lang/es') }}">spanish</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('lang/ca') }}">catalan</a>
                </li>
            </ul>
        </li> --}}
    </ul>

</div>
