<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $siteData['site_name'] }} | @yield('title')</title>
    <script>
        const APP_URL = '{{ url('/') }}';
        const APP_TOKEN = '{{ csrf_token() }}';
    </script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="{{ $siteData['site_name'] }} | {{ $siteData['meta_title'] }}" />
    <meta name="description" content="{{ $siteData['meta_description'] }}" />
    <meta name="keywords" content="{{ $siteData['meta_tag'] }}" />
    <link rel="shortcut icon" href="{{ showDefaultImage('storage/' . $siteData['favicon']) }}" type="image/x-icon">
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
        crossorigin="anonymous" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link href="{{ asset('backend/css/overlayscrollbars.min.css') }}" rel="stylesheet">

    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <link href="{{ asset('backend/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <!--begin::Required Plugin(AdminLTE)-->

    <link href="{{ asset('backend/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('backend/css/adminlte.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->

    <!-- Toastr CSS -->
    <link href="{{ asset('backend/css/toastr.min.css') }}" rel="stylesheet">
    <style>
        .nowrap{
            white-space: nowrap !important;
        }
    </style>
    @stack('css')
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg sidebar-mini bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        @include('backend.partials.header')

        <!--end::Header-->
        <!--begin::Sidebar-->
        @include('backend.partials.sidebar')
        <!--end::Sidebar-->
        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    @yield('breadcrumb')

                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->
            <!--begin::App Content-->
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    @yield('page-content')
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->
        <!--begin::Footer-->
        @include('backend.partials.footer')
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->

    <!--begin::Script-->
    <!--begin::jQuery -->
    <script src="{{ asset('backend/js/jquery-3.6.0.min.js') }}"></script>
    <!--end::jQuery-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="{{ asset('backend/js/overlayscrollbars.browser.es6.min.js') }}"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="{{ asset('backend/js/popper.min.js') }}"></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)-->
    <!--begin::Required Plugin(Bootstrap 5)-->
    <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
    <!--end::Required Plugin(Bootstrap 5)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('backend/js/adminlte.js') }}"></script>
    <!--end::Required Plugin(AdminLTE)-->
    <!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <!--end::OverlayScrollbars Configure-->

    <script src="{{ asset('backend/plugins/flatpickr/flatpickr.js') }}"></script>
    <!-- dataTables JS -->
    <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables/dataTables.bootstrap5.min.js') }}"></script>

    <script src="{{ asset('backend/js/custom.js') }}"></script>

    <!-- sweetAlert JS -->
    <script src="{{ asset('backend/js/sweetAlert.js') }}"></script>
    <!-- Toastr JS -->
    <script src="{{ asset('backend/js/toastr.min.js') }}"></script>
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>

    @stack('js')
    <!--end::Script-->
</body>
<!--end::Body-->

</html>
