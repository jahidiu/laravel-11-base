@extends('layouts.admin_app')

@section('title')
    Update Profile Info
@endsection

@section('breadcrumb')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Update Profile Info</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Profile Info</li>
            </ol>
        </div>
    </div>
@endsection
@section('page-content')
    <div class="row">
        <div class="col-12">
            <!-- success box -->
            <div class="card card-success card-outline">
                <form action="{{ route('user.update_profile') }}" method="POST" id="profile-form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="Personal-tab" data-bs-toggle="tab" data-bs-target="#Personal-tab-pane" type="button" role="tab"
                                    aria-controls="Personal-tab-pane" aria-selected="true">Personal info </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="Password-tab" data-bs-toggle="tab" data-bs-target="#Password-tab-pane" type="button" role="tab"
                                    aria-controls="Password-tab-pane" aria-selected="false">Password info</button>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="Personal-tab-pane" role="tabpanel" aria-labelledby="Personal-tab" tabindex="0">
                                <div class="row mb-3">
                                    <label for="Name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name" class="form-control" id="Name" value="{{ $user->name }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Phone" class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="phone" class="form-control" id="Phone" value="{{ $user->phone ?? '' }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-6">
                                        <input type="email" name="email" class="form-control" id="Email" value="{{ $user->email ?? '' }}" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Avatar" class="col-sm-2 col-form-label">Avatar</label>
                                    <div class="col-sm-6">
                                        @if (!empty($user->avatar))
                                            <div class="mb-2">
                                                <img src="{{ showDefaultImage('storage/' . $user->avatar) }}" alt="User-Image" width="100">
                                            </div>
                                        @endif
                                        <input type="file" name="avatar" class="form-control" id="Avatar" />
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Password-tab-pane" role="tabpanel" aria-labelledby="Password-tab" tabindex="0">

                                <div class="row mb-3">
                                    <label for="old_password" class="col-sm-2 col-form-label">Old Password</label>
                                    <div class="col-sm-6">
                                        <div class="input-group mb-3">
                                            <input type="password" name="old_password" class="form-control" id="old_password" />
                                            <span class="input-group-text">
                                                <i class="bi bi-eye-slash togglePassword" data-target="old_password" style="cursor: pointer;"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="new_password" class="col-sm-2 col-form-label">New Password</label>
                                    <div class="col-sm-6">
                                        <div class="input-group mb-3">
                                            <input type="password" name="new_password" class="form-control" id="new_password" />
                                            <span class="input-group-text">
                                                <i class="bi bi-eye-slash togglePassword" data-target="new_password" style="cursor: pointer;"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="new_password_confirmation" class="col-sm-2 col-form-label">Confirm Password</label>
                                    <div class="col-sm-6">
                                        <div class="input-group mb-3">
                                            <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation" />
                                            <span class="input-group-text">
                                                <i class="bi bi-eye-slash togglePassword" data-target="new_password_confirmation" style="cursor: pointer;"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        @can('user.update_profile')
                            <button type="submit" class="btn btn-success">Submit</button>
                        @endcan
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
@push('js')
<script>
    $(document).ready(function () {
        $('.togglePassword').on('click', function () {
            var targetId = $(this).data('target');
            var input = $('#' + targetId);
            var type = input.attr('type');

            input.attr('type', type === 'password' ? 'text' : 'password');
            $(this).toggleClass('bi-eye-slash bi-eye');
        });
    });
</script>
@endpush
