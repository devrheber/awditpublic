@props(['title', 'color', 'value', 'href' => '#', 'extraclass'=>'', 'icon' => ''])


<a href="{{ $href }}" class="row p-0 overflow-hidden no-gutters w-100 mr-0 text-black ${{$extraclass}}"
    style="max-height: 64px; border-radius:.7rem; background:#F4F8FE; color:#29394F !important">
    <div class="p-0"
        style="background:{{ $color }}; border-radius:.7rem; overflow:hidden; max-height:64px; max-width:64px; width:64px; height:64px">
        <img src="{{ asset('images/' . $icon . '.png') }}" alt="avatar" class="" style=" border-radius:.7rem;">
    </div>

    <div class="pl-2 pr-4">
        <div class="row">
            <div class="col p-0 pl-3 font-weight-bold">
                <span style="text-transform: uppercase; font-size:.8rem">{{ $title }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col p-0 pl-3">
                <h3 style="color:{{ $color }}">{{ $value }}
                </h3>
            </div>
        </div>
    </div>
</a>
