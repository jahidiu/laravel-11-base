@extends('layouts.admin_app')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Dashboard</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>
    </div>
@endsection
@section('page-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Welcome to Dashboard</h4>
                </div>
            </div>
        </div>
    <!--end::Row-->
@endsection
