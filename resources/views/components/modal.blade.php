@props(['title', 'id', 'action'=>'', 'method' => 'POST', 'specialMethod' => null, 'saveButtonName' => __('message.update'), 'enctype'=>''])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ $action }}" method="{{ $method }}" class="modal-content" enctype="{{$enctype}}">
            @csrf

            @if($specialMethod)
                @method($specialMethod)
            @endif

            <div class="modal-header" style="border-bottom: none !important">
                <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-modal-update">{{ $saveButtonName }}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('message.Cancel') }}</button>
            </div>

        </form>
    </div>
</div>
