@extends('layouts.admin_app')

@section('title')
    General Setting
@endsection

@push('css')
    <!-- Tagify CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" />
@endpush

@section('breadcrumb')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">General Setting</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">General Setting</li>
            </ol>
        </div>
    </div>
@endsection
@section('page-content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <form action="{{ route('setting.store') }}" method="POST" id="setting-form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="site-info-tab" data-bs-toggle="tab" data-bs-target="#site-info-tab-pane" type="button" role="tab"
                                    aria-controls="site-info-tab-pane" aria-selected="true">Site info </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-info-tab" data-bs-toggle="tab" data-bs-target="#contact-info-tab-pane" type="button" role="tab"
                                    aria-controls="contact-info-tab-pane" aria-selected="false">Contact info</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="social-link-tab" data-bs-toggle="tab" data-bs-target="#social-link-tab-pane" type="button" role="tab"
                                    aria-controls="social-link-tab-pane" aria-selected="false">Social link</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="SEO-tab" data-bs-toggle="tab" data-bs-target="#SEO-tab-pane" type="button" role="tab"
                                    aria-controls="SEO-tab-pane" aria-selected="false">SEO</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="others-tab" data-bs-toggle="tab" data-bs-target="#others-tab-pane" type="button" role="tab"
                                    aria-controls="others-tab-pane" aria-selected="false">Others</button>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="site-info-tab-pane" role="tabpanel" aria-labelledby="site-info-tab" tabindex="0">

                                <div class="row mb-3">
                                    <label for="SiteName" class="col-sm-2 col-form-label">Site Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="site_name" class="form-control" id="SiteName" value="{{ $settings['site_name'] ?? '' }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="shortFormSiteName" class="col-sm-2 col-form-label">Short Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="site_short_name" class="form-control" id="shortFormSiteName" value="{{ $settings['site_short_name'] ?? '' }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="PrimaryLogo" class="col-sm-2 col-form-label">Primary Logo</label>
                                    <div class="col-sm-6">
                                        @if (!empty($settings['primary_logo']))
                                            <div class="mb-2">
                                                <img src="{{ showDefaultImage('storage/' . $settings['primary_logo']) }}" alt="Primary Logo" width="100">
                                            </div>
                                        @endif
                                        <input type="file" name="primary_logo" class="form-control" id="PrimaryLogo" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="SecondaryLogo" class="col-sm-2 col-form-label">Secondary Logo</label>
                                    <div class="col-sm-6">
                                        @if (!empty($settings['secondary_logo']))
                                            <div class="mb-2">
                                                <img src="{{ showDefaultImage('storage/' . $settings['secondary_logo']) }}" alt="Secondary Logo" width="100">
                                            </div>
                                        @endif
                                        <input type="file" name="secondary_logo" class="form-control" id="SecondaryLogo" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Favicon" class="col-sm-2 col-form-label">Favicon</label>
                                    <div class="col-sm-6">
                                        @if (!empty($settings['favicon']))
                                            <div class="mb-2">
                                                <img src="{{ showDefaultImage('storage/' . $settings['favicon']) }}" alt="Favicon" width="100">
                                            </div>
                                        @endif
                                        <input type="file" name="favicon" class="form-control" id="Favicon" />
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="contact-info-tab-pane" role="tabpanel" aria-labelledby="contact-info-tab" tabindex="0">

                                <div class="row mb-3">
                                    <label for="Phone" class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="phone" class="form-control" id="Phone" value="{{ $settings['phone'] ?? '' }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-6">
                                        <input type="email" name="email" class="form-control" id="Email" value="{{ $settings['email'] ?? '' }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Address" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-6">
                                        <textarea name="address" class="form-control" rows="5" aria-label="Address">{{ $settings['address'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="social-link-tab-pane" role="tabpanel" aria-labelledby="social-link-tab" tabindex="0">

                                <div class="row mb-3">
                                    <label for="Facebook" class="col-sm-2 col-form-label">Facebook</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="facebook" class="form-control" id="Facebook" value="{{ $settings['facebook'] ?? '' }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Linkedin" class="col-sm-2 col-form-label">Linkedin</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="linkedin" class="form-control" id="Linkedin" value="{{ $settings['linkedin'] ?? '' }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="X" class="col-sm-2 col-form-label">X</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="x" class="form-control" id="X" value="{{ $settings['x'] ?? '' }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Instagram" class="col-sm-2 col-form-label">Instagram</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="instagram" class="form-control" id="Instagram" value="{{ $settings['instagram'] ?? '' }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Pinterest" class="col-sm-2 col-form-label">Pinterest</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="pinterest" class="form-control" id="Pinterest" value="{{ $settings['pinterest'] ?? '' }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="YouTube" class="col-sm-2 col-form-label">YouTube</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="youtube" class="form-control" id="YouTube" value="{{ $settings['youtube'] ?? '' }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="SEO-tab-pane" role="tabpanel" aria-labelledby="SEO-tab" tabindex="0">

                                <div class="row mb-3">
                                    <label for="MetaTitle" class="col-sm-2 col-form-label">Meta Title</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="meta_title" class="form-control" id="MetaTitle" value="{{ $settings['meta_title'] ?? '' }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="MetaTag" class="col-sm-2 col-form-label">Meta Tag</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="meta_tag" class="form-control" id="MetaTag" value="{{ $settings['meta_tag'] ?? '' }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="MetaDescription" class="col-sm-2 col-form-label">Meta Description</label>
                                    <div class="col-sm-6">
                                        <textarea name="meta_description" class="form-control" rows="5" aria-label="MetaDescription">{{ $settings['meta_description'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="MetaImage" class="col-sm-2 col-form-label">Meta Image</label>
                                    <div class="col-sm-6">
                                        @if (!empty($settings['meta_image']))
                                            <div class="mb-2">
                                                <img src="{{ showDefaultImage('storage/' . $settings['meta_image']) }}" alt="Meta-Image" width="100">
                                            </div>
                                        @endif
                                        <input type="file" name="meta_image" class="form-control" id="MetaImage" />
                                        <small>Recommended Size: 1200 x 628 px and Aspect Ratio: 1.91:1</small>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="others-tab-pane" role="tabpanel" aria-labelledby="others-tab" tabindex="0">

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Allow Cookies</legend>
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cookies_allow" id="cookies_allow" value="Yes" {{ (@$settings['cookies_allow'] == 'Yes') ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="cookies_allow"> Yes </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cookies_allow" id="cookies_allow" value="No" {{ (@$settings['cookies_allow'] == 'No') ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="cookies_allow"> No </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="row mb-3">
                                    <label for="ClearCache" class="col-sm-2 col-form-label">Cache Clear</label>
                                    <div class="col-sm-6">
                                        <button class="btn btn-light" id="ClearCache" type="btn"><i class="bi bi-radioactive"></i> Click To Clear Cache</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- Tagify JS -->
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var input = document.getElementById('MetaTag');
        new Tagify(input, {
            delimiters: ",|Enter", // Trigger tags on comma or Enter
        });
    });
</script>

@endpush
