@props(['title', 'showBorderBottom' => true, 'dataTarget', 'noIconOrButton' => false, 'buttonText' => '', 'faIcon' => 'fa fa-edit', 'extraClasses' => '', 'titleStyle' => '', 'otherSlot' => false])

<div {{ $attributes->merge(['class' => 'view-profile-edit-card h-100']) }}>
    @if ($title !== '')
        <div class="view-profile-edit-card-title d-flex justify-content-between align-items-center  @unless ($showBorderBottom) border-0 mb-0 @endunless">
            <div class="view-profile-edit-card-title-text mr-auto" style="{{ $titleStyle }}">{{ $title }}</div>
            @if ($noIconOrButton)
                <div></div>
            @else
                @if ($buttonText === '')
                    <a class="view-profile-edit-card-title-icon ml-auto" data-toggle="modal" data-target="{{ $dataTarget }}">
                        <i class="{{ $faIcon }}"></i>
                    </a>
                @else
                    <div class="btn btn-primary btn-modal-update" data-toggle="modal" data-target="{{ $dataTarget }}">
                        <i class="{{ $faIcon }}"></i>
                        {{ $buttonText }}
                    </div>
                @endif
            @endif
            <div>

            </div>
        </div>
    @endif

    @if ($otherSlot)
        {{ $slot }}
    @else
        <div
            class="d-flex align-items-center {{ $extraClasses }}{{ $attributes->get('class') === 'with-margin-top-auto' ? 'mt-auto' : '' }} {{ $attributes->get('class') === 'no-padding' ? '' : 'view-profile-edit-card-content' }}">
            {{ $slot }}
        </div>
    @endif

</div>
