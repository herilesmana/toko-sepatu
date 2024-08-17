@props([
    'header' => 'Home',
    'activeMenu' => null,
    'shortName' => 'GS',
    'longName' => 'Glory Shoes',
    'styles' => '',
    'scripts' => '',
    'menus' => json_encode([
        [
            'label' => '',
            'menu' => [
                [
                    'path' => '/dashboard',
                    'label' => 'Dashboard',
                    'icon' => 'mdi-speedometer',
                    'submenu' => []
                ],
            ]
        ]
    ])
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="enable">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $header != '' ? $header . ' - ' : '' }}{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Layout config Js -->
    <script src="{{ asset('assets/template/js/layout.js') }}"></script>
    <link href="{{ asset('assets/template/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/template/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/template/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/template/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    {{ $styles }}
</head>
<body class="font-sans antialiased">
    <!-- Begin page -->
    <div id="layout-wrapper">
        <x-templates.topbar />
        <x-templates.sidebar activeMenu="{{ $activeMenu }}" shortName="{!! $shortName !!}" longName="{!! $longName !!}" menus="{!! $menus !!}"/>
        
        <div class="main-content">
            <div class="page-content">
                {{ $activeMenu }}
                {{ $slot }}
            </div>
            <x-templates.footer />
        </div>
    </div>

    <!-- Preloader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    {{-- <script src="{{ asset('assets/template/plugins/global/jquery-3.6.0.min.js') }}"></script> Change to cdn --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/template/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/template/js/app.js') }}"></script>

    {{ $scripts }}
</body>
</html>
