@props(['total'=>90, 'min'=>0, 'max'=>100, 'color', 'style' => 'height:.5rem'])

<div class="progress" style="{{ $style }}">
    <div class="progress-bar custom-progress-bar" role="progressbar"
        style="width: {{ $total }}%; {{ isset($color) ? 'background-color: ' . $color . '!important;' : '' }}"
        aria-valuenow="{{ $max }}" aria-valuemin="{{ $min }}" aria-valuemax="{{ $max }}"></div>
</div>
