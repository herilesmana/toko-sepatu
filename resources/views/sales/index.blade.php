<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('sales.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Sale</a>
                    <table class="min-w-full mt-4">
                        <thead>
                            <tr class="bg-yellow-500 bg-opacity-50 text-black">
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">Total Amount</th>
                                <th class="border px-4 py-2">Date</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $sale)
                                <tr class="hover:bg-slate-50">
                                    <td class="border px-4 py-2">{{ $sale->id }}</td>
                                    <td class="border px-4 py-2">{{ $sale->total_amount }}</td>
                                    <td class="border px-4 py-2">{{ $sale->created_at->format('d-m-Y') }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('sales.show', $sale->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">View</a>
                                    </td>
                                </tr>
                            @endforeach

                            @if ($sales->isEmpty())
                                <tr>
                                    <td class="border px-4 py-2 text-center" colspan="4">No sales found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $sales->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
