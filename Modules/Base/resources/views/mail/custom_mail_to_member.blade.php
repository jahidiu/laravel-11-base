@extends('layouts.admin_app')

@section('title', 'Custom Mail To Member')

@push('css')
    <link href="{{ asset('backend/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/plugins/summernote/summernote.min.css') }}" rel="stylesheet" />
    <style>
        input#tag-input {
            width: 25%;
            outline: none;
        }

        span.select2-selection.select2-selection--single {
            height: calc(1.5em + .75rem + 2px);
        }
    </style>
@endpush

@section('breadcrumb')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Custom Mail To Member</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Custom Mail To Member</li>
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
                    <form action="{{ route('member.send_custom_mail') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-6">
                                <label>Send For</label><br>
                                <label class="me-3">
                                    <input type="radio" name="type" value="members" checked> Individual Members
                                </label>
                                <label class="me-3">
                                    <input type="radio" name="type" value="custom"> Custom
                                </label>
                                <label class="me-3">
                                    <input type="radio" name="type" value="all_members"> All Members
                                </label>
                            </div>
                            <div class="col-6">
                                <label>Select Members</label>
                                <select class="form-control select2" id="member_id" name="member_id[]" multiple></select>
                            </div>
                        </div>

                        <div class="row mb-3" id="custom-emails">
                            <div class="col-12">
                                <label>Custom Emails</label>
                                <div id="tag-container" class="border p-2 rounded">
                                    <input type="text" id="tag-input" placeholder="Type and press Enter/Comma">
                                </div>
                                <input type="hidden" name="emails" id="hidden-emails">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label>Subject</label>
                                <input type="text" class="form-control" name="subject" required>
                            </div>
                            <div class="col-12">
                                <label>Email Body</label>
                                <textarea class="form-control email_template" name="body" rows="8">
                                    {{ old('member_custom_email_template', $settings['member_custom_email_template'] ?? '') }}
                                </textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <p><strong>Note: </strong>You can use the following shortcodes in the email template:</p>
                                <span class="d-block mt-1">
                                    <code>{donor_name}</code>, <code>{donation_type}</code>, <code>{plan_type}</code>
                                    <code>{amount}</code>, <code>{registration_id}</code>, <code>{membership_id}</code>
                                </span>
                                <small class="text-muted">
                                    These placeholders will be dynamically replaced with actual data when the email is sent.
                                </small>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('backend/js/select2.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/summernote/summernote.min.js') }}"></script>
    <script>
        setTimeout(function() {
            textEditor($('.email_template'), 300);
        }, 300);
    </script>
    <script>
        $("#member_id").select2({
            ajax: {
                url: "{{ route('member.list') }}",
                dataType: 'json',
                delay: 250,
                data: params => ({
                    search: params.term,
                    page: params.page || 1
                })
            }
        });

        function toggleFields(type) {
            if (type === 'members') {
                $('#member_id').closest('.col-6').show();
                $('#custom-emails').hide();
            } else if (type === 'custom') {
                $('#member_id').closest('.col-6').hide();
                $('#custom-emails').show();
            } else {
                $('#member_id').closest('.col-6').hide();
                $('#custom-emails').hide();
            }
        }

        $("input[name='type']").on('change', function() {
            toggleFields($(this).val());
        });
        toggleFields($("input[name='type']:checked").val());

        // Tagging for custom emails
        let tags = [];

        function renderTags() {
            $("#tag-container").find("span").remove();
            tags.forEach((tag, index) => {
                $("#tag-container").prepend(
                    `<span class="badge bg-info p-2 m-1">${tag} <span class="remove-tag" data-index="${index}" style="cursor:pointer;">&times;</span></span>`);
            });
            $("#hidden-emails").val(tags.join(","));
        }
        $("#tag-input").on("keydown", function(e) {
            let key = e.key,
                value = $(this).val().trim();
            if ((key === "Enter" || key === ",") && value !== "") {
                e.preventDefault();
                if (!tags.includes(value)) {
                    tags.push(value);
                    $(this).val("");
                    renderTags();
                }
            }
        });
        $(document).on("click", ".remove-tag", function() {
            tags.splice($(this).data("index"), 1);
            renderTags();
        });
    </script>
@endpush
