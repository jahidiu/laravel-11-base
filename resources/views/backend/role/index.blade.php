@extends('layouts.admin_app')

@section('title')
    Role & Permissions
@endsection

@section('breadcrumb')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Role & Permissions</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Role & Permissions</li>
            </ol>
        </div>
    </div>
@endsection
@section('page-content')
    <div class="row">
        <div class="col-12">
            <!-- success box -->
            <div class="card card-success card-outline">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <form action="{{ route('role.store') }}" method="POST" id="role-form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <x-common.input :required="true" column=12 type="text" id="name" name="name" label="Name"
                                                placeholder="Name" :value="old('name')"></x-common.input>
                                        </div>
                                        @can('role.create')
                                        <button type="submit" class="btn btn-success float-end">Create</button>
                                        @endcan
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-sm" id="role-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Name</th>
                                                <th style="width: 10px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="editRoleForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="edit_name" class="form-label col-sm-3">Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="edit_name" name="name" placeholder="Name">
                                <div class="invalid-feedback" id="error_edit_name"></div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="updateBtn" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <input type="hidden" id="base_route" name="base_route" value="{{ route('role.index') }}">
@endsection
@push('js')
    <script type="text/javascript">
        $(function() {
            $('#role-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('role.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
    <script>
        $(document).on('click', '.editBtn', function() {
            const id = $(this).data('id');
            const url = $(this).data('url');

            clearValidationErrors();

            $.get(url, function(data) {
                // Populate the form fields
                $('#id').val(id);
                $('#edit_name').val(data.name);
                // Show modal
                const modal = new bootstrap.Modal(document.getElementById('editRoleModal'));
                modal.show();
            });
        });

        function clearValidationErrors() {
            $('.invalid-feedback').text('');
        }

        $(document).on('submit', '#editRoleForm', function(e) {
            e.preventDefault();

            const id = $('#id').val();
            const base_url = $('#base_route').val();
            const url = `${base_url}/${id}`;
            const form = $(this);

            const data = {
                _token: $('input[name="_token"]').val(),
                _method: 'PUT',
                name: $('#edit_name').val(),
            };

            // Clear previous errors
            clearValidationErrors();

            $.ajax({
                url: url,
                method: 'POST',
                data: data,
                success: function(response) {
                    $('#editRoleModal').modal('hide');
                    $('#role-table').DataTable().ajax.reload();
                    toastr.success('Role updated successfully');
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;

                        // Manual mapping for edit modal inputs
                        const fieldMap = {
                            name: 'edit_name',
                        };

                        $.each(errors, function(key, messages) {
                            const editFieldId = fieldMap[key];
                            $('#' + editFieldId).addClass('is-invalid');
                            $('#error_' + editFieldId).text(messages[0]);
                        });
                    } else {
                        toastr.error('Something went wrong. Please try again.');
                    }
                }

            });
        });
    </script>

    @include('base::scripts.sweet_alert')
@endpush
