<!-- resources/views/components/guest-layout.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/template/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/template/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/template/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom Css-->
    <link href="{{ asset('assets/template/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="auth-body-bg">
    <div class="auth-page-wrapper">
        <div class="auth-page-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <a href="{{ url('/') }}">
                                        <img src="{{ asset('assets/logo.png') }}" alt="Logo" height="100">
                                    </a>
                                    <h5 class="text-primary mt-4">{{ $title ?? 'Login Toko Sepatu Glory' }}</h5>
                                    <p class="text-muted">{{ $subtitle ?? '' }}</p>
                                </div>

                                <div class="p-2 mt-4">
                                    {{ $slot }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/template/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/template/js/app.min.js') }}"></script>
</body>

</html>
