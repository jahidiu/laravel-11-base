@extends('layouts.admin_app')

@section('title')
    User
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/css/select2.min.css') }}" />
@endpush

@section('breadcrumb')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">User</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">User</li>
            </ol>
        </div>
    </div>
@endsection

@section('page-content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <form action="{{ route('user.store') }}" method="POST" id="user-form">
                                    @csrf
                                    <div class="card-body">
                                        <x-common.input :required="true" column=12 type="text" id="name" name="name" label="Name" placeholder="Name" :value="old('name')" />
                                        <x-common.input :required="true" column=12 type="email" id="email" name="email" label="Email" placeholder="Email" :value="old('email')" />
                                        <x-common.input :required="true" column=12 type="text" id="username" name="username" label="Username" placeholder="Username"
                                            :value="old('username')" />
                                        <x-common.input :required="true" column=12 type="password" id="password" name="password" label="Password" placeholder="Password" />
                                        <x-common.server-side-select :required="true" column=12 name="role_id" id="role_id"
                                            class="role_id" disableOptionText="Select Role" label="Role"> </x-common.server-side-select>
                                        @can('user.create')
                                        <button type="submit" class="btn btn-success float-end">Create</button>
                                        @endcan
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-sm" id="user-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>Action</th>
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
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editUserModal" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" id="editUserForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="edit_id">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <div class="row mb-3">
                                <label for="edit_name" class="form-label col-sm-3">Name <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="edit_name" name="name" placeholder="Name">
                                    <div class="invalid-feedback" id="error_edit_name"></div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="edit_email" class="form-label col-sm-3">Email <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="edit_email" name="email" label="Email" placeholder="Email" readonly>
                                    <div class="invalid-feedback" id="error_edit_email"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="edit_username" class="form-label col-sm-3">Username <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="edit_username" name="username" label="Username" placeholder="Username">
                                    <div class="invalid-feedback" id="error_edit_username"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="edit_role_id" class="form-label col-sm-3">Role <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="role_id" id="edit_role_id" class="form-control role_id" style="width: 100%"></select>
                                    <div class="invalid-feedback" id="error_edit_role_id"></div>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <input type="hidden" id="base_route" value="{{ route('user.index') }}">
    </div>
@endsection

@push('js')
    <script>
        $(function() {
            $('#user-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user.index') }}",
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
                        data: 'role',
                        name: 'role.name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'username',
                        name: 'username'
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

        $(document).on('click', '.editBtn', function() {
            const id = $(this).data('id');
            const url = $(this).data('url');
            $.get(url, function(data) {
                $('#edit_id').val(data.id);
                $('#edit_name').val(data.name);
                $('#edit_email').val(data.email);
                $('#edit_username').val(data.username);

                // set role select2
                const option = new Option('Loading...', data.role_id, true, true);
                $('#edit_role_id').append(option).trigger('change');

                $.ajax({
                    url: "{{ route('role.list') }}",
                    data: {
                        search: ''
                    },
                    success: function(response) {
                        $('#edit_role_id').empty();
                        response.results.forEach(function(role) {
                            const selected = role.id == data.role_id;
                            const option = new Option(role.text, role.id, selected, selected);
                            $('#edit_role_id').append(option);
                        });
                    }
                });

                const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
                modal.show();
            });

        });

        $('#editUserForm').submit(function(e) {
            e.preventDefault();
            const id = $('#edit_id').val();
            const url = `${$('#base_route').val()}/${id}`;
            const data = {
                _token: $('input[name="_token"]').val(),
                _method: 'PUT',
                name: $('#edit_name').val(),
                username: $('#edit_username').val(),
                role_id: $('#edit_role_id').val()
            };

            $.ajax({
                url,
                method: 'POST',
                data,
                success: function() {
                    $('#editUserModal').modal('hide');
                    $('#user-table').DataTable().ajax.reload();
                    toastr.success('User updated successfully');
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            const input = $(`#edit_${key}`);
                            input.addClass('is-invalid');
                            input.next('.invalid-feedback').text(value[0]);
                        });
                    } else {
                        toastr.error('An error occurred');
                    }
                }
            });
        });
    </script>

    @include('base::scripts.sweet_alert')
@endpush
@push('js')
    <script src="{{ asset('backend/js/select2.min.js') }}"></script>
    <script>
        (function($) {
            "use strict";
            $("#role_id").select2({
                ajax: {
                    url: "{{ route('role.list') }}",
                    type: "get",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        var query = {
                            search: params.term,
                            page: params.page || 1,
                        }
                        return query;
                    },
                    cache: false
                },
                escapeMarkup: function(m) {
                    return m;
                }
            });
        })(jQuery);
    </script>
@endpush
