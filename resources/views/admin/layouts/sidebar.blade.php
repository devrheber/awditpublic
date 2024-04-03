<!-- BEGIN: SideNav-->
<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-dark gradient-45deg-deep-purple-blue sidenav-gradient sidenav-active-rounded">
        <div class="brand-sidebar">
            <h1 class="logo-wrapper">
                <a class="brand-logo darken-1" href="{{ url('admin/dashboard')}}">
                    <img class="hide-on-med-and-down " src="{{ asset('images/logo/materialize-logo.png') }}" alt="materialize logo" />
                    <img class="show-on-medium-and-down hide-on-med-and-up" src="{{  asset('images/logo/materialize-logo-color.png')}}" alt="materialize logo" />
                    <span class="logo-text hide-on-med-and-down">BSMP</span>
                </a>
                <a class="navbar-toggler" href="#">
                    <i class="material-icons">radio_button_checked</i>
                </a>
            </h1>
        </div>
        <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
            <li class="bold">
                <a class="waves-effect waves-cyan @if( (request()->is('admin')) || (request()->is('admin/dashboard'))  ) active @endif" href="{{ url('admin/dashboard') }}">
                    <i class="material-icons">settings_input_svideo</i>
                    <span class="menu-title">{{ __('message.Dashboard')}}</span>
                </a>
            </li>

            <li class="bold">
                <a class="waves-effect waves-cyan @if((request()->is('admin/client*')) || (request()->is('admin/supplier-list*'))) active @endif" href="{{ route('admin.client.list') }}">
                    <i class="material-icons">dvr</i>
                    <span class="menu-title">{{ __('message.Client List') }} </span>
                </a>
            </li>

            <li class="bold">
                <a class="waves-effect waves-cyan @if( (request()->is('admin/list-sector')) || (request()->is('admin/create-sector')) || (request()->is('admin/edit-sector*'))) active @endif" href="{{ route('admin.sector.list') }}">
                    <i class="material-icons">settings_input_svideo</i>
                    <span class="menu-title">{{ __('message.Company Sector') }}</span>
                </a>
            </li>

            <li class="bold">
                <a class="waves-effect waves-cyan @if((request()->is('admin/list-size')) || (request()->is('admin/create-size')) || (request()->is('admin/edit-size*'))) active @endif" href="{{ route('admin.size.list') }}">
                    <i class="material-icons">settings_input_svideo</i>
                    <span class="menu-title">{{ __('message.Company Size') }}</span>
                </a>
            </li>

            <li class="bold">
                <a class="waves-effect waves-cyan @if((request()->is('admin/list-maturity')) || (request()->is('admin/create-maturity')) || (request()->is('admin/edit-maturity*'))) active @endif" href="{{ route('admin.maturity.list') }}">
                    <i class="material-icons">settings_input_svideo</i>
                    <span class="menu-title">{{ __('message.Company Maturity')}}</span>
                </a>
            </li>

            <li class="bold">
                <a class="waves-effect waves-cyan @if( (request()->is('admin/question-value/*')) ) active @endif" href="{{ route('admin.questionvalue.list') }}">
                    <i class="material-icons">settings_input_svideo</i>
                    <span class="menu-title">{{ __('message.Question Value')}}</span>
                </a>
            </li>

            <li class="bold">
                <a class="waves-effect waves-cyan @if( (request()->is('admin/roles/*')) ) active @endif" href="{{ route('admin-roles.index') }}">
                    <i class="material-icons">settings_input_svideo</i>
                    <span class="menu-title">{{ __('Roles')}}</span>
                </a>
            </li>

            <li class="bold">
                <a class="waves-effect waves-cyan @if( (request()->is('admin/permission/*')) || (request()->is('admin/permission')) ) active @endif" href="{{ route('admin-permission.index') }}">
                    <i class="material-icons">settings_input_svideo</i>
                    <span class="menu-title">{{ __('Permission')}}</span>
                </a>
            </li>

            <li class="bold">
                <a class="waves-effect waves-cyan @if( (request()->is('admin/questionnaire/*')) || (request()->is('admin/permission')) ) active @endif" href="{{ route('admin.questionnaire.list') }}">
                    <i class="material-icons">settings_input_svideo</i>
                    <span class="menu-title">{{ __('Questionnaire')}}</span>
                </a>
            </li>

            {{-- <li class="bold">
                <a class="waves-effect waves-cyan @if( (request()->is('admin/country/*')) || (request()->is('admin/country')) ) active @endif" href="{{ route('admin.country.list') }}">
                    <i class="material-icons">settings_input_svideo</i>
                    <span class="menu-title">{{ __('Country')}}</span>
                </a>
            </li> --}}

        </ul>
        <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
    </aside>
<!-- END: SideNav-->
