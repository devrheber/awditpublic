@props(['title', 'value'=>'', 'placeholder' => '', 'for' => '', 'name' => '', 'id' => '', 'type' => 'text', 'extraClasses' => '', 'message' => '', 'select' => false, 'multiple' => false])

<div class="form-group">
    <label style="text-transform: uppercase">{{ $title }}</label>
    @if ($select)
        <select name="{{ $name }}" class="form-control {{ $extraClasses }}" id="{{ $id }}"
            @if ($multiple) multiple @endif>
            {{ $slot }}
        </select>
    @else
        <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}"
            placeholder="{{ $placeholder }}" class="form-control {{ $extraClasses }}">
    @endif

    @error('{{ $id }}')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
