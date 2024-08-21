@props([
    'header' => 'Home',
    'activeMenu' => null,
    'shortName' => 'GS',
    'longName' => 'Glory Shoes',
    'styles' => '',
    'scripts' => '',
    'menus' => json_encode([
        [
            'permission' => ['admin', 'user'],
            'label' => 'Welcome, ' . Auth::user()->name,
            'menu' => [
                [
                    'path' => '/dashboard',
                    'label' => 'Dashboard',
                    'icon' => 'mdi-speedometer',
                    'submenu' => []
                ],
            ]
        ],
        [
            'permission' => ['admin', 'user'],
            'label' => 'Transaksi',
            'menu' => [
                [
                    'path' => '/incoming-stocks/create',
                    'label' => 'Barang Masuk',
                    'icon' => 'mdi-import',
                    'submenu' => []
                ],
                [
                    'path' => '/sales/create',
                    'label' => 'Penjualan Barang',
                    'icon' => 'mdi-cash-register',
                    'submenu' => []
                ]
            ]
        ],
        [
            'permission' => ['admin', 'user'],
            'label' => 'Report',
            'menu' => [
                [
                    'path' => '/report/product-stock',
                    'label' => 'Stok Barang',
                    'icon' => 'mdi-file-chart',
                    'submenu' => []
                ],
                [
                    'path' => '/report/sales',
                    'label' => 'Laporan Penjualan',
                    'icon' => 'mdi-chart-line',
                    'submenu' => []
                ]
            ]
        ],
        [
            'permission' => ['admin'],
            'label' => 'Master Data',
            'menu' => [
                [
                    'path' => '/brands',
                    'label' => 'Master Merk',
                    'icon' => 'mdi-shoe-formal',
                    'submenu' => []
                ],
                [
                    'path' => '/categories',
                    'label' => 'Master Jenis',
                    'icon' => 'mdi-shoe-formal',
                    'submenu' => []
                ],
                [
                    'path' => '/products',
                    'label' => 'Master Sepatu',
                    'icon' => 'mdi-shoe-formal',
                    'submenu' => []
                ],
                [
                    'path' => '/users',
                    'label' => 'Master Pengguna',
                    'icon' => 'mdi-account-group',
                    'submenu' => []
                ]
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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    {{ $styles }}
</head>
<body class="font-sans antialiased">
    <!-- Begin page -->
    <div id="layout-wrapper">
        <x-templates.topbar />
        <x-templates.sidebar activeMenu="{{ $activeMenu }}" shortName="{!! $shortName !!}" longName="{!! $longName !!}" menus="{!! $menus !!}"/>
        
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ $header }}</h4>
    
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                <li class="breadcrumb-item active">Analytics</li> --}}
                                {{-- Generate from url --}}
                                @php
                                    $url = url()->current();
                                    $url = str_replace(url('/'), '', $url);
                                    $url = explode('/', $url);
                                @endphp

                                @foreach (collect($url)->filter(function ($_item) { return $_item != ''; }) as $item)
                                    <li class="breadcrumb-item
                                    @if ($loop->last)
                                        active
                                    @endif
                                    ">
                                        @if(!$loop->last)
                                        <a href="javascript: void(0);">{{ ucfirst($item) }}</a>
                                        @else
                                        {{ ucfirst($item) }}
                                        @endif
                                    </li>
                                @endforeach
                            </ol>
                        </div>
    
                    </div>
                </div>
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

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    {{ $scripts }}
</body>
</html>
