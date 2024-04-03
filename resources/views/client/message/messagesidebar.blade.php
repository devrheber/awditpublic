@php
    $ticketinbox = \App\Models\SupplierTicket::query()
                    ->where('receiver_id',auth()->user()->id)
                    ->where('status',1)
                    ->where('is_deleted','!=',1)->count();
    $sentticket = \App\Models\ClientTicket::query()
                                ->where('sender_id',auth()->user()->id)
                                ->count();
    $invitation = \App\Models\Invitation::query()
                                ->where('sender_id', auth()->user()->id)
                                ->count();
    $invitationExpired = \App\Models\Invitation::query()
                                ->where('sender_id', auth()->user()->id)
                                ->where('status',3)
                                ->count();
    $questionnaires = \App\Models\QuestionnaireReminder::query()
                                ->where('client_id', auth()->user()->id)
                                ->count();
@endphp
<div class="">
    <div class="sidenav_inner global_box">
        <div class="sidenavbar_inner_titles">
            {{ __('message.tickets') }}
        </div>
        <a href="{{ route('client.ticket.inbox') }}"
            class="d-flex align-items-center w-100 sidenav-inner-item @if (request()->is('ticket/inbox*')) sidenav-inner-selected @endif">
            <i class="fa fa-inbox mr-2"></i>
            <p class="sidenav-inner-text text-left">{{ __('message.inbox') }}</p>
            <div class="sidenavbar_inner_titles ml-auto">
                {{ $ticketinbox }}
            </div>
        </a>
        <a href="{{ route('client.ticket.sent') }}"
            class="d-flex align-items-center w-100 sidenav-inner-item @if (request()->is('ticket/sent*')) sidenav-inner-selected @endif">
            <i class="fa fa-star-o mr-2"></i>
            <p class="sidenav-inner-text">{{ __('message.sent') }}</p>
            <div class="sidenavbar_inner_titles ml-auto">
                {{ $sentticket }}
            </div>
        </a>



        <div class="sidenavbar_inner_titles mt-2">
            {{ __('message.invitations') }}
        </div>
        <a href="{{ route('client.invitation.sent') }}"
            class="d-flex align-items-center w-100 sidenav-inner-item @if (request()->is('invitation/sent*')) sidenav-inner-selected @endif">
            <i class="fa fa-star-o mr-2"></i>
            <p class="sidenav-inner-text">{{ __('message.sent') }}</p>
            <div class="sidenavbar_inner_titles ml-auto">
                {{ $invitation }}
            </div>
        </a>

        <a href="{{ route('client.invitation.expired') }}"
            class="d-flex align-items-center w-100 sidenav-inner-item @if (request()->is('invitation/expired*')) sidenav-inner-selected @endif">
            <i class="fa fa-exclamation-circle mr-2"></i>
            <p class="sidenav-inner-text">{{ __('message.expired') }}</p>
            <div class="sidenavbar_inner_titles ml-auto">
                {{ $invitationExpired }}
            </div>
        </a>

        <div class="sidenavbar_inner_titles mt-2">
            {{ __('message.questionnaires') }}
        </div>
        <a href="{{ route('client.questionnaire.reminder') }}"
            class="d-flex align-items-center w-100 sidenav-inner-item  @if (request()->is('questionnaire/reminder*')) sidenav-inner-selected @endif">
            <i class="fa fa-inbox mr-2"></i>
            <p class="sidenav-inner-text"> {{ __('message.questionnaires') }}</p>
            <div class="sidenavbar_inner_titles ml-auto">
                {{ $questionnaires }}
            </div>
        </a>

    </div>
</div>
