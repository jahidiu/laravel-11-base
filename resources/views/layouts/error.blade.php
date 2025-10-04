{{-- <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title', 'Error') | {{ config('app.name', 'Event Booking Management') }}</title>

</head>
<body class="bg-error">
    @yield('content')
</body>
</html> --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Error') | {{ config('app.name', 'Event Booking Management') }}</title>

    <link rel="shortcut icon" href="{{ showDefaultImage('storage/' . $siteData['favicon']) }}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap.min.css') }}">

    <style>
        body {
            background: #0d1117; /* dark background */
            color: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .error-pages .error-title {
            font-size: 6rem;
            font-weight: bold;
        }
        .error-sub-title {
            font-size: 2rem;
        }
        .error-message {
            font-size: 1rem;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
