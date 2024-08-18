<x-app-layout>
    <x-slot name="header">Sales</x-slot>
    <x-slot name="activeMenu">sales</x-slot>

    <div class="card">
        <div class="card-header">
            <a href="{{ route('sales.create') }}" class="btn btn-primary">Create Sale</a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr class="table-light">
                        <th>ID</th>
                        <th>Total Amount</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->total_amount }}</td>
                            <td>{{ $sale->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-sm btn-success">View</a>
                            </td>
                        </tr>
                    @endforeach

                    @if ($sales->isEmpty())
                        <tr>
                            <td class="text-center" colspan="4">No sales found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $sales->links() }}
        </div>
    </div>
</x-app-layout>
