<x-app-layout>
    <x-slot name="header">Laporan Penjualan</x-slot>
    <x-slot name="activeMenu">laporan-penjualan</x-slot>

    <div class="card">
        <div class="card-body">
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
            </table>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            $(document).ready(function() {
                $('.table').DataTable();
            });
        </script>
    </x-slot>
</x-app-layout>
