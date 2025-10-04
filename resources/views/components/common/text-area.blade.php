@props([
    'label' => '',
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'column' => '12',
    'required' => false,
    'row' => 5,
])
<div class="col-md-{{ $column }} mb-2">
    @if ($label)
        <label for="{{ $name }}" class="form-label">{{ $label }} <span class='text-danger'>{{ $required ? '*' : '' }} </span></label>
    @endif
    <textarea id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}" rows="{{ $row }}" {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}>{{ old($name) ? old($name) : $value }}</textarea>
    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
