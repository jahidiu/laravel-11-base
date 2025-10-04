@extends('layouts.admin_app')

@section('title')
    Paypal Config Setup
@endsection

@section('breadcrumb')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Paypal Config Setup</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Paypal Config Setup</li>
            </ol>
        </div>
    </div>
@endsection
@section('page-content')
    <div class="row">
        <div class="col-12">
            <!-- success box -->
            <div class="card card-success card-outline">
                <form method="POST" action="{{ route('setting.update_paypal') }}" class="text-start mb-3">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <x-common.select :required="true" column=6 id="PAYPAL_MODE" name="PAYPAL_MODE"
                                label="PayPal Mode" disableOptionText="Select One" :value="env('PAYPAL_MODE', 'live')"
                                :options="[['id' => 'sandbox', 'name' => 'SandBox'], ['id' => 'live', 'name' => 'Live']]">
                            </x-common.select>

                            <x-common.input :required="true" column=6 id="PAYPAL_WEBHOOK_ID" name="PAYPAL_WEBHOOK_ID"
                                label="Webhook ID" placeholder="Webhook ID" :value="old('PAYPAL_WEBHOOK_ID', env('PAYPAL_WEBHOOK_ID', ''))">
                            </x-common.input>

                            <x-common.input :required="true" column=12 id="PAYPAL_CLIENT_ID" name="PAYPAL_CLIENT_ID"
                                label="Client ID" placeholder="Client ID" :value="old('PAYPAL_CLIENT_ID', env('PAYPAL_CLIENT_ID', ''))">
                            </x-common.input>

                            <x-common.input :required="true" column=12 id="PAYPAL_CLIENT_SECRET" name="PAYPAL_CLIENT_SECRET"
                                label="Secret Key" placeholder="Secret Key" :value="old('PAYPAL_CLIENT_SECRET', env('PAYPAL_CLIENT_SECRET', ''))">
                            </x-common.input>

                        </div>
                    </div>
                    <div class="card-footer">
                        <x-common.button column=12 type="submit" id="update_btn" class="btn btn-success"
                            :value="'Update'"></x-common.button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
