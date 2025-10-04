@if (is_array($text))
    @foreach ($text as $item)
        <span class="badge {{ $class }}">{{ $item }}</span>
    @endforeach
@else
    <span class="badge {{ $class }}">{{ $text }}</span>
@endif
