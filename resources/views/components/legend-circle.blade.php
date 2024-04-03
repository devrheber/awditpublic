@props(['color', 'text'])
<div class="legend">
    <div
        style=" width: 15px;
    height: 15px;
    border-radius: 50%;
    margin-right: 5px;  background-color: {{ $color }}">
    </div>
    <div class="text" style="text-transform: uppercase">{{$text}}</div>
</div>
