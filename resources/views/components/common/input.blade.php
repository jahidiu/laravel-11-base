{{-- @props([
    'label' => '',
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'column' => '12',
    'required' => false
])
<div class="col-md-{{$column}} mb-2">
    @if ($label)
        <label for="{{ $name }}" class="form-label">{{$label}} <span class='text-danger'>{{$required ? "*" : ''}} </span></label>
    @endif
    <input id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ old($name) ? old($name) : $value }}" {{$attributes->class(['form-control'])->merge(['type' => 'text'])}}>
    @error($name)
        <div class="valid-feedback">{{$message}}</div>
    @enderror
</div> --}}
@props([
    'label' => '',
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'column' => '12',
    'required' => false,
    'type' => 'text',
])

<div class="col-md-{{ $column }} mb-2">
    @if ($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
            <span class='text-danger'>{{ $required ? '*' : '' }}</span>
        </label>
    @endif

    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}"
        {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }} {{ $required ? 'required' : '' }}>

    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
