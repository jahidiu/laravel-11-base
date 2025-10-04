@props([
    'label' => '',
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'column' => '12',
    'required' => false
])

<div class="col-md-{{$column}} mb-2">
    @if($label)
        <label class="form-label">{{$label}} <span class='text-danger'>{{$required ? "*" : ''}} </span></label>
    @endif
    <input name="{{ $name }}" placeholder="{{ $placeholder }}"
        {{ $attributes->class(['form-control timepicker flatpickr-input'])->merge(['type' => 'text']) }}
        value="{{ $value }}" readonly="readonly">
    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
