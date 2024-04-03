<div class="">
    <div class="sidenav_inner global_box">
        <div class="sidenavbar_inner_titles">
            Tickets
        </div>
        <a href="{{ route('supplier.ticket.inbox') }}"
           class="d-flex align-items-center w-100 sidenav-inner-item @if (request()->is('supplier/ticket/inbox*')) sidenav-inner-selected @endif">
            <i class="fa fa-inbox mr-2"></i>
            <p class="sidenav-inner-text">{{ __('message.inbox') }}</p>
        </a>
        <a href="{{ route('supplier.ticket.sentlist') }}"
           class="d-flex align-items-center w-100 sidenav-inner-item @if (request()->is('supplier/ticket/sent*')) sidenav-inner-selected @endif">
            <i class="fa fa-star-o mr-2"></i>
            <p class="sidenav-inner-text">{{ __('message.sent') }}</p>
        </a>
    </div>
</div>
