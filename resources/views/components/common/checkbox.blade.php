@props([
    'id' => '',
    'name' => '',
    'label' => '',
    'options' => [],
    'value' => [],
    'required' => false,
    'column' => 12
])

<div class="col-md-{{ $column }}">
    @if($label)
        <label class="form-label">{{ $label }} @if($required)<span class="text-danger">*</span>@endif</label>
    @endif

    <div class="form-check">
        @foreach($options as $option)
            @php
                $checked = in_array($option['id'], $value) ? 'checked' : '';
            @endphp
            <div class="form-check">
                <input class="form-check-input" type="checkbox"
                    name="{{ $name }}" {{-- keep name as plan_type[] --}}
                    id="{{ $id . '_' . $option['id'] }}"
                    value="{{ $option['id'] }}"
                    {{ $checked }}>
                <label class="form-check-label" for="{{ $id . '_' . $option['id'] }}">
                    {{ $option['name'] }}
                </label>
            </div>
        @endforeach
    </div>

    @error(str_replace('[]', '', $name)) {{-- remove [] for error lookup --}}
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
