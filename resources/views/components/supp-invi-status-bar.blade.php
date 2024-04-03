@props(['title', 'color', 'value', 'min', 'max', 'total'])
<div class="row w-100 align-items-center ml-0">
    <div class="col-3">{{ $title }}</div>
    <div class="col-9">
        <x-progress-bar min="{{ $min }}" max="{{ $max }}" total="{{ $total }}"
            color="{{ $color }}"></x-progress-bar>
    </div>
</div>
