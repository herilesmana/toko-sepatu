<x-app-layout>
    <x-slot name="header">Dahboard</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Selamat datang di aplikasi toko sepatu <strong>Glory Shoes</strong></h1>
                </div>
            </div>

            <h2 class="mt-8 mb-3 text-xl font-semibold">Summary Master</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold">Total Products</h2>
                    <p class="mt-2 text-3xl">{{ $totalProducts }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold">Total Brands</h2>
                    <p class="mt-2 text-3xl">{{ $totalBrands }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold">Total Categories</h2>
                    <p class="mt-2 text-3xl">{{ $totalCategories }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold">Total Shoe Sizes</h2>
                    <p class="mt-2 text-3xl">{{ $totalShoeSizes }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold">Total Stocks</h2>
                    <p class="mt-2 text-3xl">{{ $totalStocks }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold">Total Sales</h2>
                    <p class="mt-2 text-3xl">{{ $totalSales }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold">Sales Today</h2>
                    <p class="mt-2 text-3xl">{{ $totalSalesToday }}</p>
                </div>
            </div>
            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4">Recent Sales</h2>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-yellow-500 bg-opacity-50 text-black">
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">Total Amount</th>
                                <th class="border px-4 py-2">Date</th>
                                <th class="border px-4 py-2">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentSales as $sale)
                                <tr class="hover:bg-slate-50">
                                    <td class="border px-4 py-2">{{ $sale->id }}</td>
                                    <td class="border px-4 py-2">{{ $sale->total_amount }}</td>
                                    <td class="border px-4 py-2">{{ $sale->created_at->format('d-m-Y') }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('sales.show', $sale->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">View</a>
                                    </td>
                                </tr>
                            @endforeach
    
                            @if ($recentSales->isEmpty())
                                <tr>
                                    <td class="border px-4 py-2 text-center" colspan="4">No recent sales found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
