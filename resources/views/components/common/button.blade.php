@props([
    'id' => '',
    'value' => '',
    'icon' => '',
    'column' => '12',
])
<div class="col-md-{{$column}} mt-3">
    <button id="{{ $id }}" {{$attributes->class(['btn'])->merge(['type' => 'submit'])}}><i class="{{ $icon }}"></i> {{ $value }}</button>
</div>
