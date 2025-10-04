@if ($asset)
    <img src="{{ showDefaultImage('storage/' . $asset) }}" alt="Asset" width="120" height="60" class="img-thumbnail">
@else
    N/A
@endif
