@extends('layouts.admin_app')

@section('title')
    Role Assign Permission
@endsection

@section('breadcrumb')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Role Assign Permission</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Role Assign Permission</li>
            </ol>
        </div>
    </div>
@endsection

@section('page-content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h4>Assign Permissions to Role: <strong>{{ $role->name }}</strong></h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('role.assign.permission') }}" method="POST">
                        @csrf
                        <input type="hidden" name="role_id" value="{{ $role->id }}">

                        @foreach ($permissionGroups as $groupName => $groupPermissions)
                            <div class="card mb-3 border shadow-sm">
                                <div class="card-header bg-light">
                                    <label>
                                        <input type="checkbox" class="group-checkbox me-2" data-group="{{ Str::slug($groupName) }}">
                                        <strong>{{ $groupName }}</strong>
                                    </label>
                                </div>
                                <div class="card-body row">
                                    @foreach ($groupPermissions as $permission)
                                        <div class="col-md-3">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                    class="permission-checkbox group-{{ Str::slug($groupName) }}"
                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                                    {{-- {{ $permission->name }}  --}}
                                                    {{ Str::title(str_replace(['.', '_'], ' ', $permission->name)) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                        @can('role.assign.permission')
                        <button type="submit" class="btn btn-primary">Update Permissions</button>
                        @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Sync group checkboxes on page load
            document.querySelectorAll('.group-checkbox').forEach(groupCheckbox => {
                const group = groupCheckbox.dataset.group;
                const childCheckboxes = document.querySelectorAll('.group-' + group);
                groupCheckbox.checked = Array.from(childCheckboxes).every(cb => cb.checked);
            });

            // Handle group checkbox change
            document.querySelectorAll('.group-checkbox').forEach(groupCheckbox => {
                groupCheckbox.addEventListener('change', function() {
                    const group = this.dataset.group;
                    const checkboxes = document.querySelectorAll('.group-' + group);
                    checkboxes.forEach(cb => cb.checked = this.checked);
                });
            });

            // Optional: Update group checkbox if any individual child is changed
            document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const classList = Array.from(this.classList);
                    const groupClass = classList.find(c => c.startsWith('group-'));
                    if (groupClass) {
                        const group = groupClass.replace('group-', '');
                        const groupCheckbox = document.querySelector('.group-checkbox[data-group="' + group + '"]');
                        const children = document.querySelectorAll('.' + groupClass);
                        const allChecked = Array.from(children).every(cb => cb.checked);
                        groupCheckbox.checked = allChecked;
                    }
                });
            });
        });
    </script>
@endpush
