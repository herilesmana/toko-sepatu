    <x-app-layout>
        <x-slot name="header">Dahboard</x-slot>

        <x-slot name="activeMenu">dashboard</x-slot>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="alert alert-warning border-0 rounded-0 m-0 d-flex align-items-center" role="alert">
                                <div class="flex-grow-1 text-truncate">
                                    <h1>Selamat datang di aplikasi toko sepatu <strong>Glory Shoes</strong></h1>
                                </div>
                            </div>

                            <div class="row align-items-end">
                                <div class="col-sm-8">
                                    <div class="p-3">
                                        <span class="fs-16 lh-base">
                                            {{-- // Penjelasan menganai aplikasi toko sepatu Glory Shoes --}}
                                            Glory Shoes adalah aplikasi toko sepatu yang memudahkan Anda dalam mengelola data produk sepatu, merek sepatu, kategori sepatu, ukuran sepatu, dan stok sepatu. Aplikasi ini juga memudahkan Anda dalam melakukan penjualan sepatu dan melihat laporan penjualan.
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-4 align-items-end">
                                    <div class="px-3 d-flex justify-content-end">
                                        <img style="height: 90px" src="{{ asset('assets/template/images/user-illustarator-2.png') }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card-body-->
                    </div>
                </div>
                <h3>Master</h3>
                <div class="col-md-3">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Total Barang (Sepatu)</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{ $totalProducts }}">{{ $totalProducts }}</span></h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                            <i class="mdi mdi-cube-outline"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </div>
                <div class="col-md-3">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Jumlah Merk</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{ $totalBrands }}">{{ $totalBrands }}</span></h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                            <i class="ri-store-2-line"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </div>
                <div class="col-md-3">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Jumlah Jenis Sepatu</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{ $totalCategories }}">{{ $totalCategories }}</span></h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                            <i class="ri-folder-3-line"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </div>
                <div class="col-md-3">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Jumlah Ukuran Sepatu</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{ $totalShoeSizes }}">{{ $totalShoeSizes }}</span></h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                            <i class="ri-ruler-2-line"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </div>
                <h3>Laporan</h3>
                <div class="col-md-4">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Total Stok Barang</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{ $totalStocks }}">{{ $totalStocks }}</span></h2>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                            <i class="ri-stack-line"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Penjualan Bulan Ini</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr class="table-light">
                                            <th>ID</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($currentMonthSale as $sale)
                                            <tr>
                                                <td>{{ $sale->sale->id }}</td>
                                                <td>{{ $sale->product->name }}</td>
                                                <td>{{ $sale->quantity }}</td>
                                                <td>Rp{{ number_format($sale->price, 0, ',', '.') }}</td>
                                                <td>Rp{{ number_format($sale->quantity*$sale->price, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                
                                        @if ($currentMonthSale->isEmpty())
                                            <tr>
                                                <td class="border px-4 py-2 text-center" colspan="5">Belum ada penjualan bulan ini.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Barang Masuk Bulan Ini</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr class="table-light">
                                            <th>ID</th>
                                            <th>Nama Barang</th>
                                            <th>Ukuran</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($currentMonthIncomingStock as $stock)
                                            <tr>
                                                <td>{{ $stock->id }}</td>
                                                <td>{{ $stock->product->name }}</td>
                                                <td>{{ $stock->shoeSize->size }}</td>
                                                <td>{{ $stock->quantity }}</td>
                                            </tr>
                                        @endforeach
                
                                        @if ($recentSales->isEmpty())
                                            <tr>
                                                <td class="border px-4 py-2 text-center" colspan="4">Belum ada barang masuk bulan ini</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
