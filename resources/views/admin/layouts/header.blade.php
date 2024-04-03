<!-- BEGIN: Header-->
<header class="page-topbar" id="header">
        <div class="navbar navbar-fixed">
            <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-light">
                <div class="nav-wrapper">
                    <div class="header-search-wrapper hide-on-med-and-down"><i class="material-icons">search</i>
                        <input class="header-search-input z-depth-2" type="text" name="Search" placeholder="Explore Materialize" data-search="template-list">
                        <ul class="search-list collection display-none"></ul>
                    </div>
                    @php
                        $adminid = Auth::user()->id;
                        $admin = App\Models\Admin::find($adminid);
                    @endphp

                    <ul class="navbar-list right">
                        <li class="dropdown-language"><a class="waves-effect waves-block waves-light translation-button" href="#" data-target="translation-dropdown"><span class="flag-icon @if(app()->getLocale() == 'en') flag-icon-gb @elseif(app()->getLocale() == 'es')flag-icon-es  @elseif(app()->getLocale() == 'ca') flag-icon-ad @endif"></span></a></li>

                        <li class="hide-on-large-only search-input-wrapper"><a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i class="material-icons">search</i></a></li>

                        <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown"><span class="avatar-status avatar-online">
                            <img src="{{ asset('images/admin/profile/'.$admin->image) }}" alt="avatar"></span></a>
                        </li>
                    </ul>
                    <!-- translation-button-->
                    <ul class="dropdown-content" id="translation-dropdown">
                        <li class="dropdown-item"><a class="grey-text text-darken-1" href="{{ url('lang/en') }}" data-language="en"><i class="flag-icon flag-icon-gb"></i> {{ __('message.English')}}</a></li>
                        <li class="dropdown-item"><a class="grey-text text-darken-1" href="{{ url('lang/es') }}" data-language="es"><i class="flag-icon flag-icon-es"></i> {{ __('message.Spanish')}}</a></li>
                        <li class="dropdown-item"><a class="grey-text text-darken-1" href="{{ url('lang/ca') }}" data-language="ad"><i class="flag-icon flag-icon-ad"></i> {{ __('message.Catalan')}}</a></li>
                    </ul>
                    <!-- notifications-dropdown-->
                    <ul class="dropdown-content" id="notifications-dropdown">
                        <li>
                            <h6>NOTIFICATIONS<span class="new badge">5</span></h6>
                        </li>
                        <li class="divider"></li>
                        <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle cyan small">add_shopping_cart</span> A new order has been placed!</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">2 hours ago</time>
                        </li>
                        <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle red small">stars</span> Completed the task</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">3 days ago</time>
                        </li>
                        <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle teal small">settings</span> Settings updated</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">4 days ago</time>
                        </li>
                        <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle deep-orange small">today</span> Director meeting started</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">6 days ago</time>
                        </li>
                        <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle amber small">trending_up</span> Generate monthly report</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">1 week ago</time>
                        </li>
                    </ul>
                    <!-- profile-dropdown-->
                    <ul class="dropdown-content" id="profile-dropdown">
                        <li>
                            <a class="grey-text text-darken-1" href="{{ route('admin.profile.view') }}">
                                {{ __('message.My Profile') }}
                            </a>
                        </li>
                        <li>
                            <a class="grey-text text-darken-1" href="{{ route('admin.change.password') }}">
                                {{ __('message.Change Password') }}
                            </a>
                        </li>
                        <li><a class="grey-text text-darken-1" href="#"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                {{ __('message.Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                <nav class="display-none search-sm">
                    <div class="nav-wrapper">
                        <form id="navbarForm">
                            <div class="input-field search-input-sm">
                                <input class="search-box-sm mb-0" type="search" required="" id="search" placeholder="hey, serching is here" data-search="template-list">
                                <label class="label-icon" for="search"><i class="material-icons search-sm-icon">search</i></label><i class="material-icons search-sm-close">close</i>
                                <ul class="search-list collection search-list-sm display-none"></ul>
                            </div>
                        </form>
                    </div>
                </nav>
            </nav>
        </div>
    </header>
<!-- END: Header-->
