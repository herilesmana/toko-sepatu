<x-app-layout>
    <x-slot name="header">Product Stock Report</x-slot>
    <x-slot name="activeMenu">product-stock</x-slot>

    <div class="container mt-5">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover m-0 table-striped">
                    <thead>
                        <tr class="bg-warning">
                            <th>Product Name</th>
                            <th>Shoe Size</th>
                            <th>Stock Quantity</th>
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
    </div>
</x-app-layout>
