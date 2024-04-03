@props(['min', 'max', 'title', 'color' => 'green', 'icon' => '1', 'href' => '#'])
@php
    $total = 0;
@endphp

@if ($max != 0)
    @php
        $total = ($min / $max) * 100;
    @endphp
@endif

<div class="col-md-4">
    <a href="{{ $href }}">
        <div class="global_box">
            <div class="row justify-content-between">
                <div class="col-6 text-left summary_card_min_max">
                    <span>{{ $min }}</span>/{{ $max }}
                </div>
                <div class="col-6 text-right summary_card_percentage">
                    <span>{{ $total }}%</span>
                </div>
            </div>
            <x-progress-bar min="{{$min}}" max="{{$max}}" total="{{$total}}">

            </x-progress-bar>
            {{-- <div class="progress" style="height: .5rem;">
                <div class="progress-bar" role="progressbar" style="width: {{ $total }}%;"
                    aria-valuenow="{{ $max }}" aria-valuemin="{{ $min }}"
                    aria-valuemax="{{ $max }}"></div>
            </div> --}}
            <div class="row justify-content-between" style="display: flex;
            align-items: center;">
                <div class="col-8 summary-card-title">
                    <span>{{ $title }} </span>
                </div>
                <div class="summary-card-icon" style="background-color: {{ $color }};">
                    <img src="{{ asset('images/summary_' . $icon . '.png') }}" alt="avatar">
                </div>

            </div>
        </div>
    </a>
</div>
