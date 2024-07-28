<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sale Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold">Sale ID: {{ $sale->id }}</h3>
                    <p class="text-sm text-gray-600">Date: {{ $sale->created_at->format('d-m-Y') }}</p>
                    <p class="text-sm text-gray-600">Total Amount: {{ $sale->total_amount }}</p>
                    <table class="min-w-full mt-4">
                        <thead>
                            <tr class="bg-yellow-500 bg-opacity-50 text-black">
                                <th class="border px-4 py-2">Product</th>
                                <th class="border px-4 py-2">Shoe Size</th>
                                <th class="border px-4 py-2">Quantity</th>
                                <th class="border px-4 py-2">Price</th>
                                <th class="border px-4 py-2">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sale->items as $item)
                                <tr class="hover:bg-slate-50">
                                    <td class="border px-4 py-2">{{ $item->product->name }}</td>
                                    <td class="border px-4 py-2">{{ $item->shoeSize->size }}</td>
                                    <td class="border px-4 py-2">{{ $item->quantity }}</td>
                                    <td class="border px-4 py-2">{{ $item->price }}</td>
                                    <td class="border px-4 py-2">{{ $item->quantity * $item->price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        <a href="{{ route('sales.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to Sales List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
