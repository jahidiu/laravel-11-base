{{-- @php
    $routeEdit = isset($routeEdit) ? $routeEdit : null;
    $routeShow = isset($routeShow) ? $routeShow : null;
    $routeDelete = isset($routeDelete) ? $routeDelete : null;
    $routeApprove = isset($routeApprove) ? $routeApprove : null;
    $routeEditByModal = isset($routeEditByModal) ? $routeEditByModal : null;
@endphp
<div class="btn-group" role="group" aria-label="Basic example">
    @if ($routeEdit)
        <a href="{{ $routeEdit }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></a>
    @endif

    @if ($routeEditByModal)
        <button type="button" class="btn btn-warning btn-sm editBtn"
            data-id="{{ $id }}" data-url="{{ $routeEditByModal }}"> <i class="bi bi-pencil-fill"></i>
        </button>
    @endif

    @if ($routeShow)
        <a href="{{ $routeShow }}" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
    @endif

    @if ($routeDelete)
        <button type="button" class="btn btn-danger btn-sm" style="border-radius: 0 0.25rem .25rem 0;"
            onclick="confirmDelete({{ $id }})"><i class="bi bi-trash-fill"></i></button>
        <form id="delete-form-{{ $id }}" action="{{ $routeDelete }}" method="POST" style="display:none;">
            @csrf
            @method('delete')
        </form>
    @endif

    @if ($routeApprove)
        <a href="{{ $routeApprove }}" class="btn btn-success btn-sm"><i class="bi bi-check-circle-fill"></i></a>
    @endif


</div> --}}
@php
    $routeEdit = $routeEdit ?? null;
    $routeShow = $routeShow ?? null;
    $routeDelete = $routeDelete ?? null;
    $routeApprove = $routeApprove ?? null;
    $routeEditByModal = $routeEditByModal ?? null;
    $copyUrl = $copyUrl ?? null;

    $canEdit = $canEdit ?? true; // default to true if not set
    $canShow = $canShow ?? true;
    $canDelete = $canDelete ?? true;
@endphp

<div class="btn-group" role="group" aria-label="Action buttons">
    @if ($copyUrl)
        <button type="button" class="btn btn-sm btn-dark copyBtn" title="Copy {{ $copyUrl }}"
            data-url="{{ $copyUrl }}"><i class="bi bi-copy"></i></button>
    @endif

    @if ($routeEdit && $canEdit)
        <a href="{{ $routeEdit }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></a>
    @endif

    @if ($routeEditByModal && $canEdit)
        <button type="button" class="btn btn-warning btn-sm editBtn"
            data-id="{{ $id }}" data-url="{{ $routeEditByModal }}">
            <i class="bi bi-pencil-fill"></i>
        </button>
    @endif

    @if ($routeShow && $canShow)
        <a href="{{ $routeShow }}" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
    @endif

    @if ($routeDelete && $canDelete)
        <button type="button" class="btn btn-danger btn-sm" style="border-radius: 0 0.25rem .25rem 0;"
            onclick="confirmDelete({{ $id }})"><i class="bi bi-trash-fill"></i></button>
        <form id="delete-form-{{ $id }}" action="{{ $routeDelete }}" method="POST" style="display:none;">
            @csrf
            @method('delete')
        </form>
    @endif

    @if ($routeApprove)
        <a href="{{ $routeApprove }}" class="btn btn-success btn-sm"><i class="bi bi-check-circle-fill"></i></a>
    @endif

</div>
