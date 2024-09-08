<x-app-layout>
    <x-slot name="header">Incoming Stocks</x-slot>
    <x-slot name="activeMenu">incoming-stocks</x-slot>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('incoming-stocks.create') }}" class="btn btn-success mb-3">
                <i class="mdi mdi-plus"></i>
                Buat Transaksi Kedatangan
            </a>
            <div class="table-responsive">
                <table class="table table-bordered tabe-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Supplier</th>
                            <th>Total Quantity</th>
                            <th>Waktu Transaksi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->supplier_name }}</td>
                                <td>{{ $transaction->items->sum('quantity') }}</td>
                                <td>{{ $transaction->getFormattedCreatedAtAttribute() }}</td>
                                <td>
                                    <a target="_blank" href="{{ route('incoming-stocks.receipt', $transaction->id) }}" class="btn btn-primary btn-sm">
                                        <i class="mdi mdi-printer"></i>
                                        Print
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        @if ($transactions->isEmpty())
                            <tr>
                                <td colspan="3" class="text-center">No incoming stocks found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
