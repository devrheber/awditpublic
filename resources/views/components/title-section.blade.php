@props(['title', 'section', 'subtitle', 'extraButton' => false, 'extraButtonName' => '', 'extraButtonIcon' => '', 'href' => '', 'dataTarget' => ''])
<div class="row">
    <div class="col">
        <small class="font-weight-bold title-section">{{ $title }} /
            <span>{{ $section }}</span>
        </small>
        <h2 class="subtitle-section">{{ $subtitle }}</h2>
        <div style="margin-bottom: 2.5rem"></div>
    </div>

    @if ($extraButton)
        <div class="w-30 mr-20  ml-auto ">
            <a data-toggle="modal" data-target="{{ $dataTarget }}" class="btn btn-modal-update">
                <i class="{{ $extraButtonIcon }}"></i>
                {{ $extraButtonName }}
            </a>
        </div>
    @else
        <div class=""></div>
    @endif
</div>
