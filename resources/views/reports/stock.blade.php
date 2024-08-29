<x-app-layout>
    <x-slot name="header">Stok Sepatu</x-slot>
    <x-slot name="activeMenu">stok-barang</x-slot>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover m-0 table-striped">
                <thead>
                    <tr class="bg-light">
                        <th>Nama Sepatu</th>
                        <th>Ukuran</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stockReport as $stock)
                    <tr>
                        <td>{{ $stock->product_name }}</td>
                        <td>{{ $stock->shoe_size }}</td>
                        <td>{{ number_format($stock->stock_quantity, 0, ',', '.') }}</td>
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
