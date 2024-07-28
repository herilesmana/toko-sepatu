<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Incoming Stocks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('incoming-stocks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Incoming Stock</a>
                    <table class="min-w-full mt-4">
                        <thead>
                            <tr class="bg-yellow-500 bg-opacity-50 text-black">
                                <th class="border px-4 py-2">Product</th>
                                <th class="border px-4 py-2">Shoe Size</th>
                                <th class="border px-4 py-2">Quantity</th>
                                <th class="border px-4 py-2">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($incomingStocks as $incomingStock)
                                <tr class="hover:bg-slate-50">
                                    <td class="border px-4 py-2">{{ $incomingStock->product->name }}</td>
                                    <td class="border px-4 py-2">{{ $incomingStock->shoeSize->size }}</td>
                                    <td class="border px-4 py-2">{{ $incomingStock->quantity }}</td>
                                    <td class="border px-4 py-2">{{ $incomingStock->getFormattedCreatedAtAttribute() }}</td>
                                </tr>
                            @endforeach

                            @if ($incomingStocks->isEmpty())
                                <tr>
                                    <td class="border px-4 py-2 text-center" colspan="4">No incoming stocks found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $incomingStocks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
