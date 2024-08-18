<x-app-layout>
    <x-slot name="header">Incoming Stocks</x-slot>
    <x-slot name="activeMenu">incoming-stocks</x-slot>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('incoming-stocks.create') }}" class="btn btn-success mb-3">Add Incoming Stock</a>
            <div class="table-responsive">
                <table class="table table-bordered tabe-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>Shoe Size</th>
                            <th>Quantity</th>
                            <th>Transaction Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($incomingStocks as $incomingStock)
                            <tr>
                                <td>{{ $incomingStock->product->name }}</td>
                                <td>{{ $incomingStock->shoeSize->size }}</td>
                                <td>{{ $incomingStock->quantity }}</td>
                                <td>{{ $incomingStock->getFormattedCreatedAtAttribute() }}</td>
                            </tr>
                        @endforeach

                        @if ($incomingStocks->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">No incoming stocks found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $incomingStocks->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
