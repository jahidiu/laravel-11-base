@extends('layouts.admin_app')

@section('title')
    Mail Setup
@endsection

@section('breadcrumb')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Mail Setup</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mail Setup</li>
            </ol>
        </div>
    </div>
@endsection
@section('page-content')
    <div class="row">
        <div class="col-12">
            <!-- success box -->
            <div class="card card-success card-outline">
                <form method="POST" action="{{ route('mail.update_settings') }}" class="text-start mb-3">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <x-common.select :required="true" column=6 id="MAIL_MAILER" name="MAIL_MAILER"
                                label="Email Protocol" disableOptionText="Select One" :value="env('MAIL_MAILER', 'smtp')"
                                :options="[['id' => 'smtp', 'name' => 'SMTP'], ['id' => 'sendmail', 'name' => 'Send Mail']]">
                            </x-common.select>

                            <x-common.select :required="true" column=6 id="MAIL_ENCRYPTION" name="MAIL_ENCRYPTION"
                                label="Mail Encryption" disableOptionText="Select One" :value="env('MAIL_ENCRYPTION', 'tls')"
                                :options="[['id' => 'tls', 'name' => 'TLS'], ['id' => 'ssl', 'name' => 'SSL']]">
                            </x-common.select>

                            <x-common.input :required="true" column=6 id="MAIL_FROM_NAME" name="MAIL_FROM_NAME" readonly
                                label="From Name" placeholder="From Name" :value="old('MAIL_FROM_NAME', env('MAIL_FROM_NAME', ''))">
                            </x-common.input>

                            <x-common.input :required="true" column=6 type="email" id="MAIL_FROM_ADDRESS"
                                name="MAIL_FROM_ADDRESS" label="From Mail" placeholder="From Mail" :value="old('MAIL_FROM_ADDRESS', env('MAIL_FROM_ADDRESS', ''))"
                                >
                            </x-common.input>

                            <x-common.input :required="true" column=6 id="MAIL_HOST" name="MAIL_HOST"
                                label="Mail Host" placeholder="Mail Host" :value="old('MAIL_HOST', env('MAIL_HOST', ''))">
                            </x-common.input>

                            <x-common.input :required="true" column=6 id="MAIL_PORT" name="MAIL_PORT"
                                label="Mail Port" placeholder="Mail Port" :value="old('MAIL_PORT', env('MAIL_PORT', ''))">
                            </x-common.input>

                            <x-common.input :required="true" column=6 id="MAIL_USERNAME" name="MAIL_USERNAME"
                                label="Username" placeholder="Username" :value="old('MAIL_USERNAME', env('MAIL_USERNAME', ''))">
                            </x-common.input>

                            <x-common.input :required="true" column=6 type="password" id="MAIL_PASSWORD"
                                name="MAIL_PASSWORD" label="Password" placeholder="Password" :value="old('MAIL_PASSWORD', env('MAIL_PASSWORD', ''))">
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
        @can('mail.test')
            <div class="col-6">
                <div class="card card-primary card-outline mt-3">
                    <form action="{{ route('mail.test') }}" method="post" class="text-start mb-3">
                        <div class="card-header">
                            <h4 class="mb-0">Mail Testing</h4>
                        </div>
                        <div class="card-body">
                            @csrf
                            <x-common.input :required="true" column=12 type="email" id="email" name="email"
                                label="Email" placeholder="Email" :value="old('email')"></x-common.input>
                            <x-common.text-area :required="false" column=12 id="message" name="message" label="Message"
                                placeholder="Message" :value="old('message')"></x-common.text-area>
                        </div>
                        <div class="card-footer">
                            <x-common.button column=12 type="submit" id="send_btn" class="btn-primary"
                                :value="'Test Mail'"></x-common.button>
                        </div>
                    </form>
                </div>
            </div>
        @endcan
    </div>
@endsection
