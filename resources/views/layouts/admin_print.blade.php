<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $siteData['site_name'] }} | @yield('title')</title>

    <meta name="title" content="{{ $siteData['site_name'] }} | {{ $siteData['meta_title'] }}" />
    <meta name="description" content="{{ $siteData['meta_description'] }}" />
    <meta name="keywords" content="{{ $siteData['meta_tag'] }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('front/assets/img/brand-lane-logo-1.png') }}">
    <link rel="shortcut icon" href="{{ showDefaultImage('storage/' . $siteData['favicon']) }}" type="image/x-icon">
    <link href="{{ asset('backend/css/bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body,
            html {
                margin: 0;
                padding: 0;
                width: 100%;
            }

            .container {
                width: 100% !important;
                max-width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            table {
                width: 100% !important;
                border-collapse: collapse;
            }

            th,
            td {
                padding: 6px !important;
                font-size: 12px;
            }

            @page {
                /*size: A4 portrait;*/
                size: A4 landscape;
                margin: 10mm;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                @yield('print-content')
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>
