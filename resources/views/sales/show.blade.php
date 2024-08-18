<x-app-layout>
    <x-slot name="header">Sale Details</x-slot>
    <x-slot name="activeMenu">sales</x-slot>

    <div class="card">
        <div class="card-body">
            <h3 class="h5">Sale ID: {{ $sale->id }}</h3>
            <p class="text-muted">Date: {{ $sale->created_at->format('d-m-Y') }}</p>
            <p class="text-muted">Total Amount: {{ $sale->total_amount }}</p>
            <table class="table table-hover mt-4">
                <thead>
                    <tr class="table-light">
                        <th>Product</th>
                        <th>Shoe Size</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sale->items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->shoeSize->size }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->quantity * $item->price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                <a href="{{ route('sales.index') }}" class="btn btn-primary">Back to Sales List</a>
            </div>
        </div>
    </div>
</x-app-layout>
