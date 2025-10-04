@props([
    'label' => '',
    'name' => '',
    'value' => '',
    'column' => '12',
    'required' => false,
    'extension' => 'image/*,.pdf,.doc,.docx,.xls,.xlsx,.csv',
])
<div class="col-md-{{ $column }} mb-2">
    @if ($label)
        <label class="form-label">{{ $label }} <span class='text-danger'>{{ $required ? '*' : '' }} </span></label>
    @endif
    <input name="{{ $name }}" id="formFile" {{ $attributes->class(['form-control'])->merge(['type' => 'file']) }} accept="{{ $extension }}" value="{{ $value }}"
        {{ $required ? 'required' : '' }}>
    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
