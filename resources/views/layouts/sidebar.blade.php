<x-modal title="Change Password" id="change-password" action="{{ route('client.store.change.password') }}">
    @if (session('success'))
        <div class=" alert alert-success"> {{ session('success') }} </div>
    @endif
    @if (session('error'))
        <div class=" alert alert-danger"> {{ session('error') }} </div>
    @endif
    <div class="form-group">
        <label for="newpassword">{{ __('message.Current Password') }}</label>
        <input type="password" class="form-control" id="newpassword" name="current_password"
            placeholder="{{ __('message.Current Password') }}">
        @error('current_password')
            <div class="text-danger"> <strong> {{ $message }}</strong></div>
        @enderror
    </div>
    <div class="form-group">
        <label for="newpassword">{{ __('message.New Password') }}</label>
        <input type="password" class="form-control" id="newpassword" name="new_password"
            placeholder="{{ __('message.New Password') }}">
        @error('new_password')
            <div class="text-danger"> <strong> {{ $message }}</strong></div>
        @enderror
    </div>
    <div class="form-group">
        <label for="repeatpassword">{{ __('message.Confirm Password') }}</label>
        <input type="password" class="form-control" id="repeatpassword" name="confirm_password"
            placeholder="{{ __('message.Confirm Password') }}">
        @error('confirm_password')
            <div class="text-danger"> <strong> {{ $message }}</strong></div>
        @enderror
    </div>
</x-modal>

<div class="sidebar">
    {{-- PERFIL --}}
    @php
        $user = App\Models\User::find(Auth::user()->id);
        $role = App\Models\UserRole::find($user->user_role);
    @endphp
    <a class="profile_drp_img profile-drp-img-deactive" href="#" style="text-align: center; margin-top:1rem">
        @if ($user->image)
            <img src="{{ asset('images/client/profile' . '/' . $user->image) }}">
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
                <p style="margin: 0;"><small class=" profile_button_text">{{ $role->name }}</small></p>
            </div>
            <div class="col-2" style="color: #b6b6b6">
                <i class="fa fa-chevron-down"></i>
            </div>
        </div>
    </button>
    <div>
        <ul class="side-bar-profile show-hide d-none">
            <li class="@if (request()->is('view-profile*')) sidebar-selected @endif"><a
                    href={{ route('client.profile.view') }}><svg width="17" height="18" viewBox="0 0 17 18"
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
            <li class="@if (request()->is('view-roles*')) sidebar-selected @endif"><a
                    href={{ route('client.profile.roles') }}><svg width="20" height="20" viewBox="0 0 20 20"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="9.99996" cy="9.99996" r="2.45455" fill="#1B2E4B" fill-opacity="0.05"
                            stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M16.0545 12.4545C15.8317 12.9594 15.9386 13.5491 16.3245 13.9436L16.3736 13.9927C16.6809 14.2997 16.8536 14.7161 16.8536 15.1505C16.8536 15.5848 16.6809 16.0013 16.3736 16.3082C16.0667 16.6155 15.6502 16.7881 15.2159 16.7881C14.7816 16.7881 14.3651 16.6155 14.0582 16.3082L14.0091 16.2591C13.6146 15.8732 13.0249 15.7663 12.52 15.9891C12.0254 16.2011 11.704 16.6865 11.7018 17.2245V17.3636C11.7018 18.2674 10.9692 19 10.0655 19C9.16172 19 8.42909 18.2674 8.42909 17.3636V17.29C8.41613 16.7358 8.06571 16.2459 7.54545 16.0545C7.04056 15.8317 6.45088 15.9386 6.05636 16.3245L6.00727 16.3736C5.70034 16.6809 5.28385 16.8536 4.84955 16.8536C4.41524 16.8536 3.99875 16.6809 3.69182 16.3736C3.38455 16.0667 3.21189 15.6502 3.21189 15.2159C3.21189 14.7816 3.38455 14.3651 3.69182 14.0582L3.74091 14.0091C4.12682 13.6146 4.23374 13.0249 4.01091 12.52C3.79894 12.0254 3.31353 11.704 2.77545 11.7018H2.63636C1.73262 11.7018 1 10.9692 1 10.0655C1 9.16172 1.73262 8.42909 2.63636 8.42909H2.71C3.26418 8.41613 3.75411 8.06571 3.94545 7.54545C4.16828 7.04056 4.06136 6.45088 3.67545 6.05636L3.62636 6.00727C3.31909 5.70034 3.14644 5.28385 3.14644 4.84955C3.14644 4.41524 3.31909 3.99875 3.62636 3.69182C3.93329 3.38455 4.34978 3.21189 4.78409 3.21189C5.2184 3.21189 5.63489 3.38455 5.94182 3.69182L5.99091 3.74091C6.38543 4.12682 6.97511 4.23374 7.48 4.01091H7.54545C8.04002 3.79894 8.36149 3.31353 8.36364 2.77545V2.63636C8.36364 1.73262 9.09626 1 10 1C10.9037 1 11.6364 1.73262 11.6364 2.63636V2.71C11.6385 3.24807 11.96 3.73349 12.4545 3.94545C12.9594 4.16828 13.5491 4.06136 13.9436 3.67545L13.9927 3.62636C14.2997 3.31909 14.7161 3.14644 15.1505 3.14644C15.5848 3.14644 16.0013 3.31909 16.3082 3.62636C16.6155 3.93329 16.7881 4.34978 16.7881 4.78409C16.7881 5.2184 16.6155 5.63489 16.3082 5.94182L16.2591 5.99091C15.8732 6.38543 15.7663 6.97511 15.9891 7.48V7.54545C16.2011 8.04002 16.6865 8.36149 17.2245 8.36364H17.3636C18.2674 8.36364 19 9.09626 19 10C19 10.9037 18.2674 11.6364 17.3636 11.6364H17.29C16.7519 11.6385 16.2665 11.96 16.0545 12.4545Z"
                            fill="#1B2E4B" fill-opacity="0.05" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>{{ __('message.Roles') }}</span></a></li>
            <li data-toggle="modal" data-target="#change-password" class="change-pass-li"><a><svg width="18"
                        height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M8.15659 2.68677H2.59035C1.71203 2.68677 1 3.39879 1 4.27712V15.4096C1 16.2879 1.71203 16.9999 2.59035 16.9999H13.7228C14.6012 16.9999 15.3132 16.2879 15.3132 15.4096V9.84336"
                            fill="#1B2E4B" fill-opacity="0.05" />
                        <path
                            d="M8.15659 2.68677H2.59035C1.71203 2.68677 1 3.39879 1 4.27712V15.4096C1 16.2879 1.71203 16.9999 2.59035 16.9999H13.7228C14.6012 16.9999 15.3132 16.2879 15.3132 15.4096V9.84336"
                            stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M14.1205 1.49406C14.7792 0.835314 15.8473 0.835314 16.506 1.49406C17.1647 2.1528 17.1647 3.22084 16.506 3.87959L8.95182 11.4338L5.77112 12.2289L6.56629 9.04824L14.1205 1.49406Z"
                            fill="#1B2E4B" fill-opacity="0.05" stroke="#1B2E4B" stroke-opacity="0.9"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>{{ __('message.Change Password') }}</span></a></li>
            <li><a href="{{ route('logout') }}"
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
    @php
        $subtitle = 'DASHBOARD';
    @endphp
    @include('partials/subtitle')
    <ul>
        <li class="@if (request()->is('home*')) sidebar-selected @endif"><a href="{{ route('home') }}"><svg
                    width="18" height="18" viewBox="0 0 18 18" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M16.368 12.1143C14.968 15.4261 11.5313 17.3971 7.96664 16.9326C4.40196 16.4681 1.58483 13.6822 1.07977 10.1221C0.574709 6.56209 2.50577 3.10227 5.80052 1.66412"
                        fill="#1B2E4B" fill-opacity="0.04" />
                    <path
                        d="M16.368 12.1143C14.968 15.4261 11.5313 17.3971 7.96664 16.9326C4.40196 16.4681 1.58483 13.6822 1.07977 10.1221C0.574709 6.56209 2.50577 3.10227 5.80052 1.66412"
                        stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M17 9.00168C17 6.8795 16.1572 4.84424 14.657 3.34364C13.1567 1.84303 11.122 1 9.00037 1V9.00168H17Z"
                        fill="#1B2E4B" fill-opacity="0.04" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span>{{ __('message.Summary') }}</span></a>
        </li>
        <li class="@if (request()->is('suppliers*')) sidebar-selected @endif"><a
                href="{{ route('client.supplier.index') }}"><svg width="18" height="18" viewBox="0 0 18 18"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9 1L1 5L9 9L17 5L9 1Z" fill="#1B2E4B"
                        fill-opacity="0.05" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M1 13L9 17L17 13" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M1 9L9 13L17 9" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span>{{ __('message.Supplier') }}</span></a></li>
    </ul>
    @php
        $subtitle = 'APPS';
    @endphp
    @include('partials/subtitle')
    <ul>
        <li class="@if (request()->is('questionnaire')) sidebar-selected @endif"><a
                href="{{ route('client.questionnarie.index') }}"><svg width="19" height="20"
                    viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M17.1371 13.5492V6.3772C17.1364 5.73727 16.7948 5.1462 16.2406 4.82624L9.96506 1.24022C9.4103 0.919927 8.72681 0.919927 8.17205 1.24022L1.89651 4.82624C1.34231 5.1462 1.00066 5.73727 1 6.3772V13.5492C1.00066 14.1892 1.34231 14.7802 1.89651 15.1002L8.17205 18.6862C8.72681 19.0065 9.4103 19.0065 9.96506 18.6862L16.2406 15.1002C16.7948 14.7802 17.1364 14.1892 17.1371 13.5492Z"
                        fill="#1B2E4B" fill-opacity="0.05" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M1.24207 5.44482L9.06856 9.97218L16.8951 5.44482" stroke="#1B2E4B" stroke-opacity="0.9"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9.06861 19V9.9632" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span>{{ __('message.Questionnaire') }}</span></a></li>
        <li class="@if (request()->is('ticket*') || request()->is('invitation*') || request()->is('questionnaire/reminder')) sidebar-selected @endif"><a
                href="{{ route('client.ticket.inbox') }}"><svg width="18" height="18" viewBox="0 0 18 18"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M17 11.6667C17 12.6485 16.2041 13.4444 15.2222 13.4444H4.55556L1 17V2.77778C1 1.79594 1.79594 1 2.77778 1H15.2222C16.2041 1 17 1.79594 17 2.77778V11.6667Z"
                        fill="#1B2E4B" fill-opacity="0.05" stroke="black" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <span>{{ __('message.Messages') }}</span></a></li>
        @can('read event')
            <li class="@if (request()->is('event*')) sidebar-selected @endif"><a
                    href="{{ route('client.event.inex') }}"><svg width="18" height="19" viewBox="0 0 18 19"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1" y="2.6842" width="15.1579" height="15.1579" rx="2"
                            fill="#1B2E4B" fill-opacity="0.05" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M12.7895 1V4.36842" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6.05264 1V4.36842" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M1.84216 7.73685H17.0001" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>{{ __('message.Calendar') }}</span></a></li>
        @endcan
        <li><a href="#"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle cx="9" cy="9" r="8" fill="#1B2E4B" fill-opacity="0.05"
                        stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <circle cx="9.00005" cy="8.99999" r="3.2" fill="#1B2E4B" fill-opacity="0.05"
                        stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M3.34399 3.34399L6.73599 6.73599" stroke="#1B2E4B" stroke-opacity="0.9"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M11.264 11.264L14.656 14.656" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M11.264 6.73599L14.656 3.34399" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M11.264 6.73599L14.088 3.91199" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M3.34399 14.656L6.73599 11.264" stroke="#1B2E4B" stroke-opacity="0.9" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span>{{ __('message.FAQ’s') }}</span></a></li>
    </ul>
</div>
