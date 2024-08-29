<x-app-layout>
    <x-slot name="header">Laporan Penjualan</x-slot>
    <x-slot name="activeMenu">laporan-penjualan</x-slot>

    <div class="card">
        <div class="card-body">
            {{-- Filter tahun dan tanggal --}}
            <form action="" method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <label for="year" class="form-label">Tahun:</label>
                        <select name="year" id="year" class="form-control">
                            <option value="">Semua</option>
                            @for($i = date('Y'); $i >= 2021; $i--)
                            <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="month" class="form-label">Bulan:</label>
                        <select name="month" id="month" class="form-control">
                            <option value="">Semua</option>
                            <option value="1" {{ $month == 1 ? 'selected' : '' }}>Januari</option>
                            <option value="2" {{ $month == 2 ? 'selected' : '' }}>Februari</option>
                            <option value="3" {{ $month == 3 ? 'selected' : '' }}>Maret</option>
                            <option value="4" {{ $month == 4 ? 'selected' : '' }}>April</option>
                            <option value="5" {{ $month == 5 ? 'selected' : '' }}>Mei</option>
                            <option value="6" {{ $month == 6 ? 'selected' : '' }}>Juni</option>
                            <option value="7" {{ $month == 7 ? 'selected' : '' }}>Juli</option>
                            <option value="8" {{ $month == 8 ? 'selected' : '' }}>Agustus</option>
                            <option value="9" {{ $month == 9 ? 'selected' : '' }}>September</option>
                            <option value="10" {{ $month == 10 ? 'selected' : '' }}>Oktober</option>
                            <option value="11" {{ $month == 11 ? 'selected' : '' }}>November</option>
                            <option value="12" {{ $month == 12 ? 'selected' : '' }}>Desember</option>
                        </select>
                    </div>
                </div>
                <button class="btn btn-secondary mt-3">
                    <i class="mdi mdi-filter"></i>
                    Terapkan Filter
                </button>
            </form>
            <hr>
            <div id="sales-report-container"></div>
            <hr>
            <table class="table table-hover m-0 table-striped">
                <thead>
                    <tr class="bg-light">
                        <th>ID Penjualan</th>
                        <th>Nama Sepatu</th>
                        <th>Ukuran</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $sales)
                    <tr>
                        <td>#{{ $sales->sale->id }}</td>
                        <td>{{ $sales->product->name }}</td>
                        <td>{{ $sales->shoeSize->size }}</td>
                        <td>{{ number_format($sales->quantity, 0, ',', '.') }}</td>
                        <td>{{ number_format($sales->price, 0, ',', '.') }}</td>
                        <td>{{ number_format($sales->total, 0, ',', '.') }}</td>
                        <td>{{ date('d M Y', strtotime($sales->sale->created_at)) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" class="text-end">Total</th>
                        <th>{{ number_format($total, 0, ',', '.') }}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="https://code.highcharts.com/highcharts.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Highcharts.chart('sales-report-container', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Product Sales Report'
                    },
                    xAxis: {
                        categories: @json($chartData->pluck('product')),
                        title: {
                            text: null
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Quantity',
                            align: 'high'
                        },
                        labels: {
                            overflow: 'justify'
                        }
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            }
                        }
                    },
                    series: [{
                        name: 'Quantity',
                        data: @json($chartData->pluck('quantity'))
                    }]
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('.table').DataTable();
            });
        </script>
    </x-slot>
</x-app-layout>
