<x-app-layout>
    <x-slot name="header">Sales Report</x-slot>
    <x-slot name="activeMenu">sales</x-slot>

    <div class="container mt-5">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover m-0 table-striped">
                    <thead>
                        <tr class="bg-warning">
                            <th>Invoice Number</th>
                            <th>Product Name</th>
                            <th>Shoe Size</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Sales Date</th>
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
    </div>
</x-app-layout>
